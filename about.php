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


    <!-- Des fonts importer de google font -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Source+Sans+Pro:wght@300;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;900&display=swap" rel="stylesheet">

    <script src="scripts/sidebar.js"></script>



    <script>
    </script>
    <body>
        <!-- navbar -->
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
    <!-- div about main information -->
    <div style="width: 80%; margin:0 auto"  >
        <div class="intro">
             <p>Bienvenue sur le UTBMask ! Notre mission est de fournir une plate-forme permettant aux étudiants de se connecter, de partager leurs connaissances et de s'engager dans des discussions significatives sur une variété de sujets. Nous nous efforçons de créer un espace sûr et inclusif où tous les étudiants peuvent se sentir les bienvenus et valorisés.</p>
        </div>
        <div class="features">
            <div>
                <h3>Réfléchissez d'abord, puis poser la question</h3>
                <p>les questions peuvent servir à recentrer, à encadrer, à clarifier, à vérifier, à appuyer et à rediriger</p>
            </div>
            <img src="./images/think_first.gif">
            
        </div>
        <div class="features">
            <img src="./images/good_ideas.gif" class="left">
            <div>
                <h3 class="left">De bonnes idées pour de bonnes causes</h3>
                <p>Nous aimons créer des choses qui ont un impact positif sur l'UTBM. Nous appelons cela résoudre un problème avec un but.</p>
            </div>
            
        </div>
        <div class="features">
            <div>
                <h3 class="right">Créé par Saad Sbat.</h3>
                <p>Je suis actuellement étudiant à l’Université de Technologie de Belfort-Montbéliard en première année cycle ingénieur (BAC +3), en vue d'obtenir le diplôme d'ingénieur en informatique.</p>

            </div>
            <img class="me "src="./images/img23.jpg">
            
        </div>
    </div>
      
</body>
</html>
