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
if(isset($_REQUEST['post'])){
    $titre="hi";

    
    // $filename = $_FILES['file']['name'];
    $content=$_REQUEST['post'];
    if(isset($_FILES['file'])){
        $date=date('Y-m-d H:i:s');
        $filename = $_FILES['file']['name'];
        $tempname = $_FILES['file']["tmp_name"];
        $folder = "../images/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            // echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            // echo "<h3>  Failed to upload image!</h3>";
            $filename=null;
        }
    }
    // echo $time;
    $sql="INSERT INTO post(Titre,content,user_id,photo)VALUES(
        :ti,:co,:id,:po
    )";
    $stm=$conn->prepare($sql);
    $stm->bindParam("ti",$titre);
    $stm->bindParam("co",$content);
    $stm->bindParam("id",$useridConnected);
    $stm->bindParam('po',$filename);

    $stm->execute();
    $last_id = $conn->lastInsertId();
    // echo $last_id;
    // $stm->bindParam("da",$date);
    $sql2='SELECT * FROM users WHERE id='.$useridConnected;
    // echo $sql2;
    $stm2=$conn->query($sql2);
    $result=$stm2->fetch();
    $lastname=$result['Last_Name'];
    // echo $lastname;
    $firstname=$result['First_Name'];
    
    // $titre=$row2['Titre'];
    // $content=$row2['content'];
    $post_photo=$filename;
    // if($row2['photo']){$post_photo=$row2['photo'];};


    $sqlLikes='SELECT * FROM likes WHERE post_id='.$last_id;
    $stmLikes=$conn->query($sqlLikes);
    $Likes=$stmLikes->rowCount();
    
    $sqlLiked='SELECT * FROM likes WHERE post_id='.$last_id.' AND user_id='.$useridConnected.';';
    $stmLiked=$conn->query($sqlLiked);
    $pressed=false;

    $sqlDisLikes='SELECT * FROM dislikes WHERE post_id='.$last_id;
    $stmDisLikes=$conn->query($sqlDisLikes);
    $disLikes=$stmDisLikes->rowCount();
    
    $sqlDisLiked='SELECT * FROM dislikes WHERE post_id='.$last_id.' AND user_id='.$useridConnected.';';
    $stmDisLiked=$conn->query($sqlDisLiked);
    $pressed_dislike=false;


    if($stmLiked->rowCount()>0){
        $pressed=true;
    }
    if($stmDisLiked->rowCount()>0){
        $pressed_dislike=true;
    }
    // $result->rowCount()
    // $resultLikes=$stmLikes->fetch();

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
                <div class='post-username'>".$FirstName.' '.$LastName." </div>
                <div class='post-handle'><span > ● now</span></div>
            
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
                
                echo "<input name='postid-".$last_id."' value=".$last_id." type='hidden'>
                <input name='userid-".$last_id."' value=".$useridConnected." type='hidden'>
                
                <span class='like-count' id='like-count-".$last_id."'>".$Likes."</span>
                <button type='button' class='like-icon' id='like-button-".$last_id."' onclick='like(". $last_id.")' 
                style='".$like_etat."'></button>
            </form>
            <form class='form-like'>";
            
                $dislike_etat=null;
            if(!$pressed_dislike){$dislike_etat='background-image: url(./images/dislike.png)';}
                    else{$dislike_etat='background-image: url(./images/dislike-red.png);'
                     ;   }
                    
                
                echo "<input name='postid-".$last_id."' value='".$last_id."' type='hidden'>
                <input name='userid-".$last_id."' value=".$useridConnected."' type='hidden'>
                
                <span class='like-count' id='dislike-count-".$last_id."'>".$disLikes."</span>
                <button type='button' class='like-icon dislike' id='dislike-button-".$last_id."' onclick='dislike(".$last_id.")' 
                style= '".$dislike_etat."' ></button>
            </form>";
            
            
            // if ($useridConnected==$row2['user_id']){
            
            echo "<form class='like-button' method='get' action='./pageparts/editPost.php'>
                <input type='hidden' name='postID'value=".$last_id.">
                <button class='edit' >Edit</button>
            </form>";
             
        echo "</div>
        <hr>
        <div class='comments' id='comments-".$last_id."'>";
              
                $postid=$last_id;
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
             
            echo "<div  class='post-comment' id='post-comment-".$last_id."' >
                        
            <!-- <input  name='comment' > -->
                        <small class='error' id='error-".$last_id."'></small>
                        <input  name='comment' id='cmnt-".$last_id."' >
                        <input name='post-id' value=".$last_id." type='hidden'>
                        <button type='submit' class='btn-cmnt' onclick=\"";echo "return validateComment("; echo $last_id.",";echo $useridConnected.",'";echo $firstandLast;echo "','";echo $photoJava."')\">Post comment</button>
            </div>
        </div>
    </div>" 
        ;
    // header("Location:../myPage.php?userid=".$useridConnected);
}
else{
    echo "Erreriefe";
    // header("Location:../myPage.php?userid=".$useridConnected);

}

?>