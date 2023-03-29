<?php 
    // echo getcwd();
    include("..\pageparts\connect.php");
    $conn=connect_db();
    include("..\pageparts\login_verification.php");
    $infoArray=verificationLogin();

    if ($infoArray["Successful"]==false){
            header("Location:index.php");
    }
    
    $postId = $_POST['post_id'];
    $userId = $_POST['user_id'];
    
    $result=$conn->query("SELECT * from likes WHERE post_id=$postId");
    $oldLikes=$result->rowCount();
    
    $stm=$conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (:pi, :ui)");
    $stm->bindParam("pi",$postId);
    $stm->bindParam("ui",$userId);
   try{
       
       $stm->execute();
       $result=$conn->query("SELECT * from likes WHERE post_id=$postId");
       if($result){
        $likes=$result->rowCount();
        echo '{"likes":'.$likes.',"pressed":true}';}
       
       
    }catch(PDOException $e){
        $result=$conn->query("DELETE FROM `likes` WHERE `likes`.`post_id` =$postId AND `likes`.`user_id`=$userId");

        echo '{"likes":'.($oldLikes-1).',"pressed":false}';
    }


    // echo "hello";
    // echo 2;
    



?>