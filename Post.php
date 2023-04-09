<?php 
    include("pageparts/connect.php");
    $conn=connect_db();
    include(".\pageparts\login_verification.php");
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
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting</title>
    <link href="styles/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body style="background-image: url('./images/bg.jpg');">
<nav class="nav-div">
            <ul class="nav-ul">
                <li class="nav-li logo"  style="color:white"><a href="home.php">Home</a></li>
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
    <form action="./pageparts/processposting.php" method="post" class="sign-in-form ">
        <div class="info-div">
            <label for="Titre" class="title-h3">Titre</label>
            <input type="text" placeholder="Titre" name="titre" class="sign-in-input post-input" required>
        </div>
        <div class="info-div">
            <label for="Titre" class="title-h3">Titre</label>
            <textarea type="text" placeholder="Titre" name="post"  class="sign-in-input post-input post-area" required></textarea>
        </div>
        <button class="btn-submit" type="submit">Submit</button>

    </form>
</body>
</html>