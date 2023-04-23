<?php 
    include("./classes/Dbconn.php");


    $db=new Dbconn();
    if(!$db->connSuccessful[0]){
        die($db->connSuccessful[1]);
    }
    $conn=$db->conn;
    include("./pageparts/login_verification.php");
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
    if(isset($_POST["first_name"]) or isset($_POST["last_name"]) or isset($_FILES["photo"]))
    {
        $first_name=$_POST["first_name"];
        $last_name=$_POST["last_name"];
        // $major=$_POST["major"];
        $filename = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];
        $folder = "./images/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            echo "<h3>  Failed to upload image!</h3>";
            $filename=null;
        }

        if($filename){
            // echo "$$$$$$$$";
            $photo_result=$conn->query("SELECT * FROM users WHERE id=$useridConnected");
            $photo=$photo_result->fetch()["profile"];
            if($photo){
                if (!unlink("./images/$photo"))
                    {
                    die("Error deleting $photo (verifier le path)");
                    }
                    else
                    {
                        echo ("Deleted $photo");
                    }
            }
            $sql="UPDATE users SET First_Name=:fn,Last_Name=:ln,profile=:po WHERE ID=$useridConnected";
            $stm=$conn->prepare($sql);
            $stm->bindParam("fn",$first_name);
            $stm->bindParam("ln",$last_name);
            $stm->bindParam("po",$filename);
            // $stm->bindParam("sp",$spe);

            // $stm->bindParam("id",$_POST["postIDMODIFIED"]);
        }
        else{
            $sql="UPDATE users SET First_Name=:fn,Last_Name=:ln WHERE ID=$useridConnected";
            $stm=$conn->prepare($sql);
            $stm->bindParam("fn",$first_name);
            $stm->bindParam("ln",$last_name);
            // $stm->bindParam("id",$_POST["postIDMODIFIED"]);
            // $stm->bindParam("po",$filename);
        }
        $stm->execute();
        if(isset($_POST["remove-photo"])&& $_POST["remove-photo"]=="yes"){
            $photo_result=$conn->query("SELECT * FROM users WHERE id=$useridConnected");
            $photo=$photo_result->fetch()["profile"];
            if($photo){
                if (!unlink("./images/$photo"))
                    {
                    die("Error deleting $photo (verifier le path)");
                    }
                    else
                    {
                        echo ("Deleted $photo");
                    }
            }
            $conn->query("UPDATE users SET profile=NULL WHERE id=$useridConnected");
            // echo "$$$$$$$$$$$@";
        }
        
        header("Location:./myPage.php?userid=$useridConnected");

        // $conn->exec($sql);
        // echo $sql;
    }
    else{

        $EditUserID=$useridConnected;
        // echo $useridConnected."\n";
        $sql="SELECT * FROM users WHERE ID=".$EditUserID;
        
        $result_edit=$conn->query($sql)->fetch();
        // echo $result_edit["id"];
        if ($result_edit){
            {
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Posting</title>
                    <link href="./styles/style.css" rel="stylesheet">

                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    
                    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
                    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
                </head>
                <body style="background-image: url('./images/bg.jpg');">
                <nav class="nav-div">
                    <ul class="nav-ul">
                        <li class="nav-li logo"  style="color:white"><a href="./home.php">Home</a></li>
                        <li class="nav-li logo" style="color:white" ><a href="./myPage.php?userid=<?php echo $useridConnected?>"><?php echo $FirstName;?></a></li>
                        <li class="nav-li logo" style="color:white">About</li>
                        
                        <li class="nav-li logo last" style="color:white"><img class="logo-img" src="./images/2.png" ></li>

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
                        <input name="userIDMODIFIED" value=<?php echo $EditUserID?> type="hidden">
                        <div class="info-div">
                            <label for="Titre" class="title-h3">First Name</label>
                            <input type="text" placeholder="Titre" name="first_name" class="sign-in-input post-input" value=<?php echo $result_edit["First_Name"] ?> required>
                        </div>
                        <div class="info-div">
                            <label for="Titre" class="title-h3">Last Name</label>
                            <input type="text"  name="last_name"  class="sign-in-input post-input "  value=<?php echo $result_edit["Last_Name"] ?> required>
                        </div>
                        <div class="remove-div">
                            <label for="Titre" class="title-h3 remove">Remove Photo</span>
                            <input type="checkbox" name="remove-photo" value="yes">
                        </div>
                        <div class="info-div">
                            <label for="Titre" class="title-h3 update">Update Photo:</label>
                            <input type="file" name="photo">
                        </div>

                        <button class="btn-submit" type="submit">Modifier</button>


                    </form>
                </body>
                </html>
            <?php

            }
            // else{
            //     echo "<h1>Dont Even Try!!</h1>";
            // }
        }
    
    
    }

    
?>