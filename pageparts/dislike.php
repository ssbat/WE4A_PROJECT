<?php 
    // echo getcwd();
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
    $postId = $_POST['post_id'];
    $userId = $_POST['user_id'];
    $result=$conn->query("SELECT * from dislikes WHERE post_id=$postId");
    $oldLikes=$result->rowCount();
    $stm=$conn->prepare("INSERT INTO dislikes (post_id, user_id) VALUES (:pi, :ui)");
    $stm->bindParam("pi",$postId);
    $stm->bindParam("ui",$userId);
   try{
       $stm->execute();
       $result=$conn->query("SELECT * from dislikes WHERE post_id=$postId");
       if($result){
        $likes=$result->rowCount();
        echo '{"dislikes":'.$likes.',"pressed":true}';}   
    }catch(PDOException $e){
        $result=$conn->query("DELETE FROM `dislikes` WHERE `dislikes`.`post_id` =$postId AND `dislikes`.`user_id`=$userId");
        echo '{"dislikes":'.($oldLikes-1).',"pressed":false}';
    }
?>