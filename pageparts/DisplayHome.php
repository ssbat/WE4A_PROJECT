<?php
include("./pageparts/DateTime.php");
$sql="SELECT * FROM post LIMIT 20";
$stm=$conn->query($sql);
foreach($stm as $row2){
    $sql2="SELECT * FROM users WHERE id=".$row2["user_id"];
    $stm2=$conn->query($sql2);
    $result=$stm2->fetch();
    $lastname=$result["Last_Name"];
    $firstname=$result["First_Name"];
    
    $titre=$row2["Titre"];
    $content=$row2["content"];

    $sqlLikes="SELECT * FROM likes WHERE post_id=".$row2["id"];
    $stmLikes=$conn->query($sqlLikes);
    $Likes=$stmLikes->rowCount();
    
    $sqlLiked="SELECT * FROM likes WHERE post_id=".$row2["id"].' AND user_id='.$useridConnected.';';
    $stmLiked=$conn->query($sqlLiked);
    $pressed=false;

    if($stmLiked->rowCount()>0){
        $pressed=true;
    }


    // $result->rowCount()
    // $resultLikes=$stmLikes->fetch();

    ?>
    
    <div class="post">
        <div class="post-header">
            <!-- <img class="post-avatar" src="https://via.placeholder.com/50x50" alt="Avatar"> -->
            <!-- <img class="post-avatar" src="./images/img23.jpg" alt="Avatar"> -->
            <!-- <img src="<?php /*echo base64_encode($result['profile']); */?>" class="post-avatar" /> -->
            <img src="./images/<?php echo $result['profile'];?>" class="post-avatar">
            <div>
                <div class="post-username"><?php echo $firstname." ".$lastname ?></div>
                <div class="post-handle"><span ><?php  echo "● ".getDateTimeDifferenceString($row2["date"]);?></span></div>
            
            </div>
        </div>
       <div class="post-body">
            <?php echo $content;/*echo $row2["date"];*/?>
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
            <form method="post" class="post-comment" action="./pageparts/processing_comment.php">
                        <input  name="comment" >
                        <input name="post-id" value=<?php echo $row2["id"] ?> type="hidden">
                        <button type="submit">Post comment</button>
            </form>
        </div>
    </div>
        <?php }
?>