
<?php 



include("./pageparts/DateTime.php");




// echo "<h3> Hello </h3>";
$sql2="SELECT * FROM users WHERE id=".$useridPage;
$stm2=$conn->query($sql2);
$result=$stm2->fetch();



if(!$stm2 or !$result){
    echo"<center><h1 style='color:red'>Erreur servenue : No user Found </h1></center>";
    // echo "</div>";
}else{
$lastname=$result["Last_Name"];
$firstname=$result["First_Name"];
// $result=$stm2

$photo=$result["profile"];
$spec=$result["Specialite"];
    ?>
    <!-- <h1 class="title-h1"><?php echo "Welcome To ".$firstname." Page" ?></h1> -->
    
<div class="profile-info">
    <img src="./images/cover.jpg" class="cover-photo">
    <div class="company-logo">
        <img src="./images/<?php
            if($photo){
            echo $photo;
            // echo "HI";
            }else{
            echo "unknown.png";

    }

            
            
            ?>" class="logo-profile">
    </div>
    <div class="profile-details">
        <div class="profile-bio">
            <h3 class="profile-name"><?php echo $firstname." ".$lastname?></h3>
        </div>
    </div>
    <div class="desc">
        <div class="desc-1">
        Étudiant ingénieur en <?php echo $spec?> à l'Université de Technologies de Belfort-Montbéliard
        </div>
        <div  class="desc-2">
        <!-- Étudiersité de Technologies de Belfort-Montbéliard -->
        <img src="./images/UTBM.png" class="utbm">
        <p class="uni"><a href="https://www.utbm.fr/">Université de Technologie de Belfort-Montbéliard</a></p>
        </div>
    </div>
</div>
    <?php
    $sql="SELECT * FROM post WHERE user_id=".$useridPage." ORDER BY `date` DESC";
    echo "<div class='post-container'>";
    foreach($conn->query($sql) as $row2){
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

        if($stmLiked->rowCount()>0){
            $pressed=true;
        }
        ?>
        
<div class="post">
    <div class="post-header">
            <!-- <img class="post-avatar" src="https://via.placeholder.com/50x50" alt="Avatar"> -->
            <!-- <img class="post-avatar" src="./images/img23.jpg" alt="Avatar"> -->
            <!-- <img src="<?php /*echo base64_encode($photo); */?>" class="post-avatar" /> -->
            <img src="./images/<?php
            if($photo){
            echo $photo;
            // echo "HI";
            }else{
            echo "unknown.png";

             }

            
            
            ?>" class="post-avatar">
            <div>
                <div class="post-username"><?php echo $firstname." ".$lastname ?></div>
                <div class="post-handle"><span ><?php  echo "● ".getDateTimeDifferenceString($row2["date"]);?></span></div>
            
            </div>
    </div>
    <div class="post-body">
        <p style="word-wrap: break-word"><?php echo $content;/*echo $row2["date"];*/?></p>
        <?php if($post_photo){ ?>
        <img src="./images/<?php echo $post_photo;?>" alt="Tweet image" class="tweet-image">
        <?php ; }?>
    </div>
    <div class="like-edit-bar">
            <!-- <div class="like-button">Like</div>
            <div class="like-button">comments</div> -->
            <!-- <span class="like-text">Like</span> -->
            
            <form class="form-like">
                <input name="postid-<?php echo $row2["id"]?>" value=<?php echo $row2["id"]?> type="hidden">
                <input name="userid-<?php echo $row2["id"]?>" value=<?php echo $useridConnected ?> type="hidden">
                
                <span class="like-count" id="like-count-<?php echo $row2["id"]?>"><?php echo $Likes?></span>
                <button type="button" class="like-icon" id="like-button-<?php echo $row2["id"]?>" onclick="like(<?php echo $row2['id']?>)" 
                style="<?php if(!$pressed){echo "background-image: url(./images/unliked.png)";}
                    else{echo "background-image: url(./images/liked2.png);"
                     ;   }
                    ?>"></button>
            </form>
            <!-- <div class="like-button">comments</div>  -->


            
            <?php
            if ($useridConnected==$row2["user_id"]){
            ?>
            <form class="like-button" method="get" action="./pageparts/editPost.php">
                <input type="hidden" name="postID"value= <?php echo $row2["id"] ?>  >
                <button class="edit" >Edit</button>
            </form>
            <?php };?>
    </div>
        
        <hr>
    <div class="comments">
            <?php 
            
                $postid=$row2["id"];
                include("./pageparts/DisplayComments.php")
            ?>                
            <?php 
                $sqlforphotoandname="SELECT * FROM users WHERE id=".$useridConnected;
                $resultphotoandname=$conn->query($sqlforphotoandname);
                $resultjava=$resultphotoandname->fetch();
                $photoJava=$resultjava["profile"];
                $firstJava=$resultjava["First_Name"];
                $lastJava=$resultjava["Last_Name"];
                $firstandLast=$firstJava." ".$lastJava;
                if(!$photoJava){                   
                   $photoJava='unknown.png';

               }
            //    echo $firstandLast;
            //    echo $photoJava;
            //    echo $useridConnected;




                ?>   
            <div  class="post-comment" id="post-comment-<?php echo $row2["id"]?>" >
                        
            <!-- <input  name="comment" > -->
                        <small class="error" id="error-<?php echo $row2["id"]?>"></small>
                        <input  name="comment" id="cmnt-<?php echo $row2["id"]?>" >
                        <input name="post-id" value=<?php echo $row2["id"] ?> type="hidden">
                        <button type="submit" class="btn-cmnt" onclick="return validateComment(<?php echo $row2['id']?>,<?php echo $useridConnected?>,'<?php echo $firstandLast ?>','<?php echo $photoJava ?>') ">Post comment</button>
            </div>
    </div>
</div>
        
    
        <?php }if ($useridPage==$useridConnected){
            ?>
            <a class="sign-up a-add" href="./post.php"><button id="btn-add">Add Post</button></a>
            
            <?php }
echo "</div>";
} 
?>


<!-- echo "Titre:$titre <br>Content:$content <br>"; -->