<?php
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

    if (isset($_POST["comment"])){
        $id_post=$_POST["post-id"];
        echo $id_post;
        $comment=$_POST["comment"];
        $id_user_comment=$useridConnected;

        $sql="INSERT INTO comments(id,user_id,post_id,content)VALUES(NULL,
            :u,:p,:c
        )";
        $stm=$conn->prepare($sql);
        $stm->bindParam("u",$id_user_comment);
        $stm->bindParam("p",$id_post);
        $stm->bindParam("c",$comment);
        $stm->execute();
        header("Location:../home.php");




    }





?>
