<?php 
    // include("connect.php");
    // $conn=connect_db();
    // include("login_verification.php");
    // $infoArray=verificationLogin();
    // if ($infoArray["Successful"]==false){
    //         header("Location:index.php");
    // }
    echo "<div id='comments-div-".$row2["id"]."'>";
    $sql="SELECT * FROM comments WHERE post_id=".$postid;
    foreach($conn->query($sql) as $row3){
        $sql2="SELECT * FROM users WHERE id=".$row3["user_id"];
        $stm2=$conn->query($sql2);
        $result=$stm2->fetch();
        $last_name=$result["Last_Name"];
        $first_name=$result["First_Name"];
        $comment=$row3["content"];
        ?>
        
            <div class='post-header'>
                <img src="./images/<?php 
                 if($result['profile']){
                     echo $result['profile'];
                    }else{
                    echo 'unknown.png';
    
                }
                ?>" class='post-avatar comment-avatar'>
                    <div class='post-username comment-username'><?php echo $first_name.' '.$last_name."<br><span class='content'>$comment</span><br>" ?>
                </div>
            </div>

        <?php }
        echo "</div>"

?>
