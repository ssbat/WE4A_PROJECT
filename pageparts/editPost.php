<?php 

    //connexion BDD
    include("../classes/Dbconn.php");
    $db=new Dbconn();
    if(!$db->connSuccessful[0]){
        die($db->connSuccessful[1]);
    }
    $conn=$db->conn;
    include("login_verification.php");
    if (!isset($_POST["logout"])){
        $infoArray=verificationLogin();
        
        if ($infoArray["Successful"]==false){
            header("Location:index.php");
    }
    }else{
        if ($_POST["logout"]=="OK"){
          unset($_COOKIE['FirstName']); unset($_COOKIE['password']);unset($_COOKIE['Email']);unset($_COOKIE['LastName']);
          setcookie('FirstName', null, -1, '/'); 
          setcookie('LastName', null, -1, '/'); 
          setcookie('password', null, -1, '/'); 
          setcookie('email', null, -1, '/'); 
          header("Location:../index.php");
        }
    }
    if(isset($_POST["postIDMODIFIED"]))//si on va modifier le post
    {
        //recuperation des nouveaux donnes
        $post=$_POST["post"];
        $filename = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];
        $folder = "../images/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            echo "<h3>  Failed to upload image!</h3>";
            $filename=null;
        }
        //si le changement de la photo de post est parmi les modification
        if($filename){
            //modifer la bdd avec la photo
            $sql="UPDATE post SET content=:co,photo=:po WHERE id=:id";
            $stm=$conn->prepare($sql);
            $stm->bindParam("co",$post);
            $stm->bindParam("id",$_POST["postIDMODIFIED"]);
            $stm->bindParam("po",$filename);
        }
        else{
            //modifer la bdd sans la photo

            $sql="UPDATE post SET content=:co WHERE id=:id";
            $stm=$conn->prepare($sql);
            $stm->bindParam("co",$post);
            $stm->bindParam("id",$_POST["postIDMODIFIED"]);
        }
        $stm->execute();
        if(isset($_POST["remove-photo"])&& $_POST["remove-photo"]=="yes")//si l'utilisateur veut supprimer la photo
        {
            $photo_result=$conn->query("SELECT * FROM post WHERE id=".$_POST["postIDMODIFIED"]);
            $photo=$photo_result->fetch()["photo"];
            if($photo){
                if (!unlink("../images/$photo"))//supression de l'image de dossier
                    {
                    die("Error deleting $photo (verifier le path)");
                    }
                    else
                    {
                        echo ("Deleted $photo");
                    }
                    
            }
            //supression de l'image de la BDD
            $conn->query("UPDATE post SET photo=NULL WHERE id=".$_POST["postIDMODIFIED"]);
            // echo "$$$$$$$$$$$@";
        }
        
        header("Location:../home.php");

        // $conn->exec($sql);
        // echo $sql;
    }
    elseif (isset($_GET["postID"])){

        //recuperation du postid qu'on veut changer +les donnes concernant ce post
        $EditPostId= $_GET["postID"];
        $sql="SELECT * FROM post WHERE id=".$EditPostId;
        $result_edit=$conn->query($sql)->fetch();
        
        if ($result_edit){
            if($result_edit["user_id"]==$useridConnected){
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Posting</title>
                    <link href="../styles/style.css" rel="stylesheet">

                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <!-- font sur google -->
                    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
                </head>
                <body style="background-image: url('../images/bg.jpg');">
                <!-- navbar -->
                <nav class="nav-div">
                    <ul class="nav-ul">
                        <li class="nav-li logo"  style="color:white"><a href="../home.php">Home</a></li>
                        <li class="nav-li logo" style="color:white" ><a href="../myPage.php?userid=<?php echo $useridConnected?>"><?php echo $FirstName;?></a></li>
                        <li class="nav-li logo" style="color:white">About</li>
                        <li class="nav-li logo last" style="color:white"><img class="logo-img" src="../images/2.png" ></li>
                        <a><li class="nav-li" style="color:white">Want to sign-out?</li></a>
                        <form action="#" method="post">
                            <input type="hidden" name="logout" value="OK">
                            <button class="btn-signout" type="submit"><li class="nav-li sign-up" style="border: 0.2px solid white; color:white">Signout</li></button>
                        </form>
                    </ul>
                </nav>
                        <!-- formulaire pour modifier le post -->
                    <form action="#" method="post" class="sign-in-form" enctype="multipart/form-data">
                        <input name="postIDMODIFIED" value=<?php echo $EditPostId?> type="hidden">
                        <!-- content -->
                        <div class="info-div div-con">
                            <label for="Content" class="title-h3 ">Content:</label>
                            <textarea type="text"  name="post"  class="sign-in-input post-input post-area"  required><?php echo $result_edit["content"] ?></textarea>
                        </div>
                        <!-- //removephoto -->
                        <div class="remove-div">
                            <label for="remove-photo" class="title-h3 remove">Remove Photo</span>
                            <input type="checkbox" name="remove-photo" value="yes">
                        </div>
                        <!-- modifier la photo                         -->
                        <div class="info-div">
                            <label for="Update photo" class="title-h3 update">Update Photo:</label>
                            <input type="file" name="photo">
                        </div>

                        <button class="btn-submit" type="submit">Modifier</button>
                    </form>

                </body>
                </html>
            <?php

            }//si une personne essaye de modifier un post qui ne l'appartient pas en changant le idpost dans le url
            
            else{
                echo "<h1>Dont Even Try!!</h1>";
            }
        }
    
    
    }

    
?>