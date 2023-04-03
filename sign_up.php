<?php 
    include("pageparts/connect.php");
    $conn=connect_db();
    include("pageparts/signup.php");
    $inserted=CheckNewAccountForm();
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign-up</title>
    <link href="styles/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">



</head>
<body style="background-image: url('./images/bg.jpg');">
    
    <nav class="nav-div">
            <ul class="nav-ul">
                <li class="nav-li logo"  style="color:white"><a href="home.php">Home</a></li>
                <li class="nav-li logo"  style="color:white"><a> Contact</a></li>
                
                <li class="nav-li logo" style="color:white">About</li>
                
                <li class="nav-li logo last" style="color:white"><img class="logo-img" src="./images/2.png" ></li>

                <!-- <li class="nav-li center">Home</li> -->
                <!-- <li class="nav-li center">Home</li> -->

                
                <a><li class="nav-li"  style="color:white">Already a member?</li></a>
                <a href="index.php"><li class="nav-li sign-up" style="border: 0.2px solid white; color:white">Sign-in</li></a>
            </ul>
    </nav>
    <form class="sign-in-form" name="Form" method="post" action="#"  onsubmit="return validateForm()" enctype="multipart/form-data">
        <h3 class="title-h3">
            Sign up with your username and password
        </h3> 
        <?php if($inserted[0]){
            ?>
            <p> <?php echo "<p class='success'>$inserted[1] </p>"?></p>
        <?php }
        else {
            ?>
            <p> <?php echo "<p class='error'>$inserted[1] </p>"?></p>
            <?php };?>
        <div class="info-div">
            <label for="First Name">First Name</label>
            <input type="text" placeholder="First Name" name="firstname"class="sign-in-input" required>
            <small class="first-name" id="first-name" ></small>
        
        </div>
        <div class="info-div">
            <label for="Last Name">Last Name</label>
            <input type="text" placeholder="Last Name" name="lastname"  class="sign-in-input" required>
            <small class="last-name" id="last-name"></small>
        </div>
        <div class="info-div">
            <label for="email">Email</label>
            <input type="email" placeholder="Email" name="email" for="username" class="sign-in-input" required>
        </div>
        <div class="info-div">
            <label for="password">Password</label>
            <input  type="password" placeholder="Password" name="password"  class="sign-in-input" required>
        </div>
        <div class="info-div">
            <label for="password">Password Verification</label>
            <input  type="password" placeholder="Password Verification" name="password2"  class="sign-in-input" require>
        </div>
        
        <small id="password"></small>
        <p class="note">Password must be at least 8 characters</p>
        
        <div class="info-div">
            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday"  class="sign-in-input">
        </div>
        <div class="info-div">
            <!-- <label for="birthday">Birthday:</label> -->
            <!-- <input type="date" id="birthday" name="birthday"  class="sign-in-input"> -->
            <label for="Photo">Profile Picture</label>
            
            <input type="file" name="image">
        
        </div>
        <button class="btn-submit" type="submit">Submit</button>
    </form>
    <script src="scripts/main.js"></script>

</body>
</html>