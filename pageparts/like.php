<?php 
    //connexion DBB
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
    //recuperation de post liké avec le userid de la personne qui a fait le like
    $postId = $_POST['post_id'];
    $userId = $_POST['user_id'];
    //insertion du like dans la BDD
    $result=$conn->query("SELECT * from likes WHERE post_id=$postId");
    $oldLikes=$result->rowCount();
    $stm=$conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (:pi, :ui)");
    $stm->bindParam("pi",$postId);
    $stm->bindParam("ui",$userId);
   try{//si le like est nouveau
       $stm->execute();
       $result=$conn->query("SELECT * from likes WHERE post_id=$postId");
       if($result){
        $likes=$result->rowCount();
        echo '{"likes":'.$likes.',"pressed":true}';}   
    }catch(PDOException $e){//si l'utilisateur a deja liker puis il a appuyer sur le like alors ca veut dire que il veut enlever lelike
        //supprimer le like de la bdd
        $result=$conn->query("DELETE FROM `likes` WHERE `likes`.`post_id` =$postId AND `likes`.`user_id`=$userId");
        //reduire le nombre des likes sur le post
        echo '{"likes":'.($oldLikes-1).',"pressed":false}';
    }
?>