<?php 
    // include("connect.php");
    // $conn=connect_db();
    // include("login_verification.php");
    // $infoArray=verificationLogin();

    // if ($infoArray["Successful"]==false){
    //         header("Location:index.php");
    // }

    $sql="SELECT * FROM comments WHERE post_id=".$postid;
    foreach($conn->query($sql) as $row3){
        $sql2="SELECT * FROM users WHERE id=".$row3["user_id"];
        $stm2=$conn->query($sql2);
        $result=$stm2->fetch();
        $last_name=$result["Last_Name"];
        $first_name=$result["First_Name"];
        // $titre=$row["user"];
        $comment=$row3["content"];
        ?>
        
            <div class="comment">
                <p class="author"><?php echo $first_name." ".$last_name ?></p>
                <!-- <h3 class="title-post"><?php echo $titre?></h3> -->
                <p class="content"><?php echo $comment?></p>
            </div>
        <?php }

?>
