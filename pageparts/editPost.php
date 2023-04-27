<?php 
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
    if(isset($_POST["postIDMODIFIED"]))
    {
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

        if($filename){
            // echo "$$$$$$$$";
            $sql="UPDATE post SET content=:co,photo=:po WHERE id=:id";
            $stm=$conn->prepare($sql);
            $stm->bindParam("co",$post);
            $stm->bindParam("id",$_POST["postIDMODIFIED"]);
            $stm->bindParam("po",$filename);
        }
        else{
            $sql="UPDATE post SET content=:co WHERE id=:id";
            $stm=$conn->prepare($sql);
            $stm->bindParam("co",$post);
            $stm->bindParam("id",$_POST["postIDMODIFIED"]);
            // $stm->bindParam("po",$filename);
        }
        $stm->execute();
        if(isset($_POST["remove-photo"])&& $_POST["remove-photo"]=="yes"){
            $photo_result=$conn->query("SELECT * FROM post WHERE id=".$_POST["postIDMODIFIED"]);
            $photo=$photo_result->fetch()["photo"];
            if($photo){
                if (!unlink("../images/$photo"))
                    {
                    die("Error deleting $photo (verifier le path)");
                    }
                    else
                    {
                        echo ("Deleted $photo");
                    }
            }
            $conn->query("UPDATE post SET photo=NULL WHERE id=".$_POST["postIDMODIFIED"]);
            // echo "$$$$$$$$$$$@";
        }
        
        header("Location:../home.php");

        // $conn->exec($sql);
        // echo $sql;
    }
    elseif (isset($_GET["postID"])){

        $EditPostId= $_GET["postID"];
        // echo $useridConnected."\n";
        $sql="SELECT * FROM post WHERE id=".$EditPostId;
        
        $result_edit=$conn->query($sql)->fetch();
        // echo $result_edit["id"];
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
                    
                    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
                </head>
                <body style="background-image: url('../images/bg.jpg');">
                <nav class="nav-div">
                    <ul class="nav-ul">
                        <li class="nav-li logo"  style="color:white"><a href="../home.php">Home</a></li>
                        <li class="nav-li logo" style="color:white" ><a href="../myPage.php?userid=<?php echo $useridConnected?>"><?php echo $FirstName;?></a></li>
                        <li class="nav-li logo" style="color:white">About</li>
                        
                        <li class="nav-li logo last" style="color:white"><img class="logo-img" src="../images/2.png" ></li>

                        <!-- <li class="nav-li center">Home</li> -->
                        <!-- <li class="nav-li center">Home</li> -->

                        
                        <a><li class="nav-li" style="color:white">Want to sign-out?</li></a>
                        <form action="#" method="post">
                            <input type="hidden" name="logout" value="OK">
                            <button class="btn-signout" type="submit"><li class="nav-li sign-up" style="border: 0.2px solid white; color:white">Signout</li></button>
                        </form>
                    </ul>
                 </nav>
                    <form action="#" method="post" class="sign-in-form" enctype="multipart/form-data">
                        <input name="postIDMODIFIED" value=<?php echo $EditPostId?> type="hidden">

                        <div class="info-div div-con">
                            <label for="Content" class="title-h3 ">Content:</label>
                            <textarea type="text"  name="post"  class="sign-in-input post-input post-area"  required><?php echo $result_edit["content"] ?></textarea>
                        </div>
                        <div class="remove-div">
                            <label for="remove-photo" class="title-h3 remove">Remove Photo</span>
                            <input type="checkbox" name="remove-photo" value="yes">
                        </div>
                        <div class="info-div">
                            <label for="Update photo" class="title-h3 update">Update Photo:</label>
                            <input type="file" name="photo">
                        </div>

                        <button class="btn-submit" type="submit">Modifier</button>
                    </form>

                </body>
                </html>
            <?php

            }
            else{
                echo "<h1>Dont Even Try!!</h1>";
            }
        }
    
    
    }

    
?>