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
            <div class="post-header">
                <img src="./images/<?php 
                 if($result['profile']){
                     echo $result['profile'];
                     // echo "HI";
                    }else{
                    echo "unknown.png";
    
                }
                // echo $result['profile'];
                ?>" class="post-avatar comment-avatar">
                    <div class="post-username comment-username"><?php echo $first_name." ".$last_name."<br><span class='content'>$comment</span><br>" ?>
                </div>
                    <!-- <div class="post-handle"><span ><?php  /*echo "●4min ago"*/?></span></div> -->
            </div>
                <!-- <p class="author comment-user"><?php /*echo $first_name." ".$last_name."<span class='time'>●3min ago</span>"*/?></p> -->
                <!-- <h3 class="title-post"><?php /*echo $titre*/?></h3> -->
                <!-- <p class="content"><?php //echo $comment?></p> -->
        <?php }

?>
