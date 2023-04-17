<?php 
    // include("connect.php");
    // $conn=connect_db();
    // include("login_verification.php");
    // $infoArray=verificationLogin();
    // if ($infoArray["Successful"]==false){
    //         header("Location:index.php");
    // }
    echo "<div id='comments-div-".$last_id."'>";
    $sql="SELECT * FROM comments WHERE post_id=".$postid;
    foreach($conn->query($sql) as $row3){
        $sql2="SELECT * FROM users WHERE id=".$row3["user_id"];
        $stm2=$conn->query($sql2);
        $result=$stm2->fetch();
        $last_name=$result["Last_Name"];
        $first_name=$result["First_Name"];
        $comment=$row3["content"];
        
        
            echo "<div class='post-header'>
                <img src='./images/";
                 if($result['profile']){
                     echo $result['profile'];
                    }else{
                    echo 'unknown.png';
    
                }
                echo "' class='post-avatar comment-avatar'>
                    <div class='post-username comment-username'>".$first_name.' '.$last_name."<br><span class='content'>$comment</span><br>
                </div>
            </div>";

        }
        echo "</div>"

?>
