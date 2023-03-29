<?php

include("connect.php");
$conn=connect_db();
include("login_verification.php");
$infoArray=verificationLogin();

if ($infoArray["Successful"]==false){
        header("Location:index.php");
}

// Get post ID and user ID from request
$postId = $_POST['post_id'];
// $userId =$_POST['user_id']; // Replace with actual user ID

// Insert new like into database
// $conn = mysqli_connect('localhost', 'username', 'password', 'database');
// $stm=$conn->prepare("INSERT INTO likes (post_id, user_id) VALUES ($postId, $userId)");
$stm=$conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (:pi, 17)");
$stm->bindParam("pi",$postId);
// $stm->bindParam("ui",$userId);
$stm->execute();
echo 2;

// Get like count for post
// $result = mysqli_query($conn, "SELECT COUNT(*) FROM likes WHERE post_id = $postId");
// $row = mysqli_fetch_row($result);
// $likeCount = $row[0];

// Return like count as response
// echo $likeCount;
?>