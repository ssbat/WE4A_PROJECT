
<?php 


include("../classes/Dbconn.php");
$db=new Dbconn();
if(!$db->connSuccessful[0]){
    die($db->connSuccessful[1]);
}
$conn=$db->conn;
include("login_verification.php");
$infoArray=verificationLogin();

if ($infoArray["Successful"]==false){
        header("Location:index.php");
}
include('./DateTime.php');



$postNumber = $_GET['firstPost'];
$useridPage=$_GET["userid"];

$sql2="SELECT * FROM users WHERE id=".$useridPage;

$stm2=$conn->query($sql2);
$result=$stm2->fetch();

$lastname=$result["Last_Name"];
$firstname=$result["First_Name"];
// $result=$stm2

$photo=$result["profile"];
$spec=$result["Specialite"];









// echo "<h3> Hello </h3>";


    $sql="SELECT * FROM post WHERE user_id=$useridPage ORDER BY `date` DESC LIMIT 10 OFFSET ".$postNumber;
    $stm=$conn->query($sql);
    $nopost=false;
    //pour enlever la bouton automatiquement quand il y'a plus des postes
    if($stm->rowCount()==0 or $stm->rowCount()<10){
        $nopost=true;
    }

    foreach($stm as $row2){
       $last_id=$row2['id'];

        $titre=$row2["Titre"];
        $content=$row2["content"];
        $post_photo=null;
        if($row2['photo']){$post_photo=$row2['photo'];};

        $sqlLikes="SELECT * FROM likes WHERE post_id=".$row2["id"];
        $stmLikes=$conn->query($sqlLikes);
        $Likes=$stmLikes->rowCount();
        
        $sqlLiked="SELECT * FROM likes WHERE post_id=".$row2["id"].' AND user_id='.$useridConnected.';';
        $stmLiked=$conn->query($sqlLiked);
        $pressed=false;


        $sqlDisLikes="SELECT * FROM dislikes WHERE post_id=".$row2["id"];
        $stmDisLikes=$conn->query($sqlDisLikes);
        $disLikes=$stmDisLikes->rowCount();
        
        $sqlDisLiked="SELECT * FROM dislikes WHERE post_id=".$row2["id"].' AND user_id='.$useridConnected.';';
        $stmDisLiked=$conn->query($sqlDisLiked);
        $pressed_dislike=false;
    

        if($stmDisLiked->rowCount()>0){
            $pressed_dislike=true;
        }

        if($stmLiked->rowCount()>0){
            $pressed=true;
        }
        
        
        echo "<div class='post'>
        <div class='post-header'>
            <img src='./images/";
            if($result['profile']){
            echo $result['profile'];
            }else{
            echo 'unknown.png';
    }
            echo"' class='post-avatar'>
            <div>
                <div class='post-username'>".$firstname.' '.$lastname." </div>
                <div class='post-handle'><span > ● ".getDateTimeDifferenceString($row2['date'])."</span></div>
            
            </div>
        </div>
       <div class='post-body'>
            <p style='word-wrap: break-word'>".$content."</p>";
             if($post_photo){ 
            echo "<img src='./images/".$post_photo."' alt='Tweet image' class='tweet-image'>"
             ;}
        echo "</div>
        <div class='like-edit-bar'>
            <form class='form-like'>";
                
            
                $like_etat=null;
                if(!$pressed){$like_etat='background-image: url(./images/unliked.png)';}
                    else{$like_etat='background-image: url(./images/liked2.png);'
                     ;   }
                
                echo "<input name='postid-".$row2['id']."' value=".$row2['id']." type='hidden'>
                <input name='userid-".$row2['id']."' value=".$useridConnected." type='hidden'>
                
                <span class='like-count' id='like-count-".$row2['id']."'>".$Likes."</span>
                <button type='button' class='like-icon' id='like-button-".$row2['id']."' onclick='like(". $row2['id'].")' 
                style='".$like_etat."'></button>
            </form>
            <form class='form-like'>";
            
                $dislike_etat=null;
            if(!$pressed_dislike){$dislike_etat='background-image: url(./images/dislike.png)';}
                    else{$dislike_etat='background-image: url(./images/dislike-red.png);'
                     ;   }
                    
                
                echo "<input name='postid-".$row2['id']."' value='".$row2['id']."' type='hidden'>
                <input name='userid-".$row2['id']."' value=".$useridConnected."' type='hidden'>
                
                <span class='like-count' id='dislike-count-".$row2['id']."'>".$disLikes."</span>
                <button type='button' class='like-icon dislike' id='dislike-button-".$row2['id']."' onclick='dislike(".$row2["id"].")' 
                style= '".$dislike_etat."' ></button>
            </form>";

            
    
            if ($useridConnected==$row2['user_id']){
            
                echo "<form class='like-button' method='get' action='./pageparts/editPost.php'>
                    <input type='hidden' name='postID'value=".$row2['id'].">
                    <button class='edit' >Edit</button>
                </form>";
                 };
            echo "</div>
            <hr>
            <div class='comments' id='comments-".$row2['id']."'>";
                  
                    $postid=$row2['id'];
                    include('./DisplayComments.php');
                    
                    $sqlforphotoandname='SELECT * FROM users WHERE id='.$useridConnected;
                    $resultphotoandname=$conn->query($sqlforphotoandname);
                    $resultjava=$resultphotoandname->fetch();
                    $photoJava=$resultjava['profile'];
                    $firstJava=$resultjava['First_Name'];
                    $lastJava=$resultjava['Last_Name'];
                    $firstandLast=$firstJava.' '.$lastJava;
                    if(!$photoJava){                   
                       $photoJava='unknown.png';
    
                   }
                 
                echo "<div  class='post-comment' id='post-comment-".$row2['id']."' >
                            
                <!-- <input  name='comment' > -->
                            <small class='error' id='error-".$row2['id']."'></small>
                            <input  name='comment' id='cmnt-".$row2['id']."' >
                            <input name='post-id' value=".$row2['id']." type='hidden'>
                            <button type='submit' class='btn-cmnt' onclick=\"";echo "return validateComment("; echo $row2['id'].",";echo $useridConnected.",'";echo $firstandLast;echo "','";echo $photoJava."')\">Post comment</button>
                </div>
            </div>
        </div>" 
            ; $postNumber++;;
                ;}
                if(!$nopost){
                echo '<button id="morePosts" class="btn-add sign-up a-add" onclick="loadMoreMyPosts('.$postNumber.','.$useridPage.')">Load More</button></a>';
                ;}
                ?>
                <!-- <a class='sign-up a-add' href='./post.php'><button id='btn-add'>Add Post</button></a> -->
                
                <?php 
    ?>
        