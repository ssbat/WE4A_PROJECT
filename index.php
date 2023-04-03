<?php 
    include("pageparts/connect.php");
    $conn=connect_db();
    include(".\pageparts\login_verification.php");
    $infoArray=verificationLogin();
    if ($infoArray["Successful"]==true){
        // header("Location:myPage.php?userid=".$useridConnected);
        header("Location:home.php");

        
    };
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="styles/style.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body style="background-image: url('./images/bg.jpg');">
    <!-- <nav class="nav-div">
        <ul class="nav-ul">
            <li class="nav-li logo">IFORUM</li>
            <li class="nav-li center">Home</li>
            
            <a><li class="nav-li">Not a member?</li></a>
            <a href="sign_up.php"><li class="nav-li sign-up">Join UTBM</li></a>
        </ul>
    </nav> -->
    <nav class="nav-div">
            <ul class="nav-ul">
                <li class="nav-li logo"  style="color:white"><a href="home.php">Home</a></li>
                <li class="nav-li logo"  style="color:white"><a> Contact</a></li>
                <li class="nav-li logo" style="color:white">About</li>
                
                <li class="nav-li logo last" style="color:white"><img class="logo-img" src="./images/2.png" ></li>

                <!-- <li class="nav-li center">Home</li> -->
                <!-- <li class="nav-li center">Home</li> -->

                
                <a><li class="nav-li"  style="color:white">Not a member?</li></a>
                <a href="sign_up.php"><li class="nav-li sign-up" style="border: 0.2px solid white; color:white">Join UTBM</li></a>
            </ul>
    </nav>
    <!-- <h1 class="title-h1">UTBM PROJECT</h1> -->
    <form class="sign-in-form" method="post">
        <h3 class="title-h3">
            Sign in with your username and password
        </h3>
        <?php if($infoArray["Attempted"]){
            ?>
            <p> <?php echo "<small class='error'>".$infoArray['Error']." </small>"?></p>
        <?php }?>
        <input type="text" placeholder="Username" name="email" for="username" class="sign-in-input">
        <input  type="password" placeholder="Password" name="password"  class="sign-in-input">
        <p class="note">Password must be at least 8 characters</p>
        <button class="btn-submit" type="submit">Submit</button>
    </form>

    
</body>
</html>