<?php 
    //AJAX
    //supprimer un post

    //connexion BDD
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
    //recuper le id du post
    if(isset($_POST["post_id"])){
        $postid=$_POST["post_id"];
        if($postid){
            $sql="DELETE FROM `post` WHERE id=$postid";
            //suppression du post de la BDD
            if($conn->query($sql)){
                echo true;
            }
    //gestion des erreurs:
            else{
                echo "erreur sur la requete";
            }
        }
        else{echo "erreur post_id";}
    }
    else{
        echo "erreur Sur l'envoie du post_id";
    }
    
?>