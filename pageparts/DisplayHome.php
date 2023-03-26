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
    ?>
    
    <div class="post">
        <div class="post-header">
            <!-- <img class="post-avatar" src="https://via.placeholder.com/50x50" alt="Avatar"> -->
            <img class="post-avatar" src="./images/img23.jpg" alt="Avatar">

            <div>
            <div class="post-username"><?php echo $firstname." ".$lastname ?></div>
            <div class="post-handle"><span ><?php  echo "● ".getDateTimeDifferenceString($row2["date"]);?></span></div>
            
            </div>
        </div>
       <div class="post-body">
            <?php echo $content;/*echo $row2["date"];*/?>
        </div>
        <div class="like-edit-bar">
            <div class="like-button">Like</div>
            <div class="like-button">comments</div>
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