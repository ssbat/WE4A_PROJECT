<?php 
    include("connect.php");
    $conn=connect_db();
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
          header("Location:index.php");
        }
    }
    if(isset($_POST["postIDMODIFIED"]))
    {
        $titre=$_POST["titre"];
        $post=$_POST["post"];
        
        $sql="UPDATE post SET Titre=:ti,content=:co WHERE id=:id";
        $stm=$conn->prepare($sql);
        $stm->bindParam("ti",$titre);
        $stm->bindParam("co",$post);
        $stm->bindParam("id",$_POST["postIDMODIFIED"]);
        $stm->execute();
        // $conn->exec($sql);
        // echo $sql;
        header("Location:../home.php");
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
                <body>
                    <nav class="nav-div">
                        <ul class="nav-ul">
                            <li class="nav-li logo">IFORUM</li>
                            <li class="nav-li center">Home</li>
                            
                            <a><li class="nav-li">Want to sign-out?</li></a>
                            <form action="#" method="post">
                                <input type="hidden" name="logout" value="OK">
                                <button class="btn-signout" type="submit"><li class="nav-li sign-up">Signout</li></button>
                            </form>
                        </ul>
                    </nav>
                    <form action="#" method="post" class="sign-in-form ">
                        <input name="postIDMODIFIED" value=<?php echo $EditPostId?> type="hidden">
                        <div class="info-div">
                            <label for="Titre" class="title-h3">Titre</label>
                            <input type="text" placeholder="Titre" name="titre" class="sign-in-input post-input" value=<?php echo $result_edit["Titre"] ?> required>
                        </div>
                        <div class="info-div">
                            <label for="Titre" class="title-h3">Titre</label>
                            <textarea type="text"  name="post"  class="sign-in-input post-input post-area"  required><?php echo $result_edit["content"] ?></textarea>
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