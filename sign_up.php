<?php 

//importation du classe Dbconn 
    include("classes/Dbconn.php");
    $db=new Dbconn();
    if(!$db->connSuccessful[0]){
        die($db->connSuccessful[1]);
    }
    $conn=$db->conn;
    include("pageparts/signup.php");
    $inserted=CheckNewAccountForm();//fonction qui vérifie(+ javascript) et crée le compte
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign-up</title>
    <link href="styles/style.css" rel="stylesheet">
    <!-- Des fonts importer de google font -->

    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">



</head>
<body style="background-image: url('./images/bg.jpg');">
    <!-- Le navbar -->
    <nav class="nav-div">
            <ul class="nav-ul">
                <li class="nav-li logo"  style="color:white">Welcome!</li>
                <li class="nav-li logo"  style="color:white"><a href="index.php">Sign-in</a></li>                
                <li class="nav-li logo last" style="color:white"><img class="logo-img" src="./images/2.png" ></li>
                <a><li class="nav-li"  style="color:white">Already a member?</li></a>
                <a href="index.php"><li class="nav-li sign-up" style="border: 0.2px solid white; color:white">Sign-in</li></a>
            </ul>
    </nav>
    <!-- Le formulaire de la creation d'un compte -->
    <!-- verification du formulaire avec javascript (validateForm) -->
    <form class="sign-in-form" name="Form" method="post" action="#"  onsubmit="return validateForm()" enctype="multipart/form-data">
        <h3 class="title-h3">
            Sign up with your username and password
        </h3> 
        <?php if(!empty($inserted) && $inserted[0]==true){//afficher un message success si la creation est faite
            ?>
            <p> <?php echo "<p class='success'>$inserted[1] </p>"?></p>
        <?php }
        else if(!empty($inserted) && $inserted[0]==false ) {//sinon erreur
            ?>
            <p> <?php echo "<p class='error'>$inserted[1] </p>"?></p>
            <?php };?>
            <!-- nom+prenom -->
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
        <!-- email -->
        <!-- le EMAIL est un champ unique dans la BDD -->
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
        <p class="note">Password must be at least 6 characters</p>
        <!-- specialite -->
        <div class="info-div">
            <label for="password">Spécialité</label>
            <select  name="spec" class="sign-in-input" required>
                <option disabled selected value> -- select an option -- </option>

                <option value="Génie informatique">Génie informatique</option>
                <option value="Génie mécanique">Génie mécanique</option>
                <option value="Génie industriel">Génie industriel</option>
                <option value="Génie énergie">Génie énergie</option>
          </select>
        </div>
            <!-- gendre -->
        <div class="info-div">
        <label for="Gender">Gender:</label>
        <input type="radio" id="gender" name="gender" value="male" required/> Male  
        <br>
        <input type="radio" id="gender" name="gender" value="female"/> Female <br/>
        
        <!-- ajouter une photo profile -->
        <div class="info-div">
            <label for="Photo">Profile Picture</label>            
            <input type="file" name="image" id="fileUpload">
        
        </div>
        <button class="btn-submit" type="submit">Submit</button>
    </form>
    <!-- JS -->
    <script src="scripts/main.js"></script>

</body>
</html>