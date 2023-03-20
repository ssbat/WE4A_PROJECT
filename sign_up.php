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
<body>
    <nav class="nav-div">
        <ul class="nav-ul">
            <li class="nav-li logo">IFORUM</li>
            <li class="nav-li center">Home</li>
            
            <a><li class="nav-li">Already a member?</li></a>
            <a href="index.php"><li class="nav-li sign-up">Sign-in</li></a>
        </ul>
    </nav>
    <form class="sign-in-form" name="Form" method="post" action="#"  onsubmit="return validateForm()">
        <h3 class="title-h3">
            Sign up with your username and password
        </h3> 
        <?php if($inserted){
            ?>
            <p> <?php echo "<p class='success'>$inserted </p>"?></p>
        <?php }?> 
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
        <button class="btn-submit" type="submit">Submit</button>
    </form>
    <script src="scripts/main.js"></script>

</body>
</html>