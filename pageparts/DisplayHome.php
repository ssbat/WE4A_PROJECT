<?php
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
            <p class="author"><?php echo $firstname." ".$lastname ?></p>
            <h3 class="title-post"><?php echo $titre?></h3>
            <p class="content"><?php echo $content?></p>
            <div class="comments">
            <?php 
            
                $postid=$row2["id"];
                include("./pageparts/DisplayComments.php")
            ?>                
                <!-- <div >Old comments</div>
                    <div class="comment-info">

                    </div>
                    <div class="comment-content">

                </div> -->
                <form method="post" class="post-comment" action="./pageparts/processing_comment.php">
                    <input  name="comment" >
                    <input name="post-id" value=<?php echo $row2["id"] ?> type="hidden">
                    <button type="submit">Post comment</button>
                </form>
            </div>
        </div>
        
        <?php }
       





?>