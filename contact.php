<?php
    //connextion DBB+login verification
    include("classes/Dbconn.php");
    $db=new Dbconn();
    if(!$db->connSuccessful[0]){
        die($db->connSuccessful[1]);
    }
    $conn=$db->conn;
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
    <title>Home</title>
    <link href="styles/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  
  <!-- appeler la fonction search (pour afficher les users à droite) -->
    <script src="scripts/sidebar.js"></script> 
    <script>window.onload=searchS;</script>

    



</head>
    <!-- nav-bar -->
    <nav class="nav-div">
            <ul class="nav-ul">
                <li class="nav-li logo"><a href="home.php">Home</a></li>
                <li class="nav-li logo" ><a href="./myPage.php?userid=<?php echo $useridConnected?>"><?php echo $FirstName;?></a></li>
                <li class="nav-li logo"><a href="about.php">About</a></li>
                <li class="nav-li logo last"><img class="logo-img" src="./images/2.png" ></li>
                <a><li class="nav-li">Want to sign-out?</li></a>
                <form action="#" method="post">
                    <input type="hidden" name="logout" value="OK">
                    <button class="btn-signout" type="submit"><li class="nav-li sign-up">Signout</li></button>
                </form>
            </ul>
    </nav>
    <div class="main" >
        <!-- (affichage d'un bar à gauche avec different liens)left-bar -->

        <div class="left-bar">
            <?php include("./pageparts/right-sidebar.php")?>
        </div>
        <div class="post wrapper">
            <header>Send us a Message</header>
            <!-- formulaire pour envoyer un mail vers mon compte -->
            <form action="#" id="formcontact">
                <div class="dbl-field">
                    <div class="field">
                      <input type="text" name="name" placeholder="Enter your name">
                      <i class='fas fa-user'></i>
                    </div>
                    <div class="field">
                      <input type="text" name="email" placeholder="Enter your email">
                      <i class='fas fa-envelope'></i>
                    </div>
                </div>
                <div class="dbl-field">
                    <div class="field">
                      <input type="text" name="phone" placeholder="Enter your phone">
                      <i class='fas fa-phone-alt'></i>
                    </div>
                    <div class="field">
                      <input type="text" name="website" placeholder="Enter your website">
                      <i class='fas fa-globe'></i>
                    </div>
                </div>
                <div class="message">
                    <textarea placeholder="Write your message" name="message"></textarea>
                    <i class="material-icons">message</i>
                </div>
                <div class="button-area">
                    <button type="submit">Send Message</button>
                    <spa id="spancontact"></span>
                </div>
            </form>
  </div>
        <!-- Affichage des utilisateurs à gauche -->

        <div class="side-bar" style=" width:100%;height:100%">
            <div class="container">
                <div>
                        
                    <div class="user-container" id="user-container">
                        <h3>Members</h3>   
                        <!-- systeme de (search)pour le nom/prenom de l'etudiant! :-) -->

                        <form class="search-form">
                            <input type="text" class="search" id="search-input" onkeyup="searchS()" placeholder="Search...">
                        </form> 
                        <div id="result-search" >


                        </div>
                    </div>
                </div>
                    
            </div>
           
            
        </div>

    </div>
        


    <script src="scripts/contact.js"></script>

</body>
</html>