<?php 

    //importation du classe Dbconn et vérification du log-in
    include("classes/Dbconn.php");
    
    $db=new Dbconn();
    if(!$db->connSuccessful[0]){
        die($db->connSuccessful[1]);//arretez le programme avec l'affichage de l'erreur 
    }
    $conn=$db->conn;
    include(".\pageparts\login_verification.php");
    if (!isset($_POST["logout"])){
        $infoArray=verificationLogin();
        
        if ($infoArray["Successful"]==false){//si le log-in est faux,redirection vers la page de log-in
            header("Location:index.php");
    
        
    }
    }else{//si le boutton login est appuyé
        if ($_POST["logout"]=="OK"){
          unset($_COOKIE['FirstName']); unset($_COOKIE['password']);unset($_COOKIE['Email']);unset($_COOKIE['LastName']);
          setcookie('FirstName', null, -1, '/'); 
          setcookie('LastName', null, -1, '/'); 
          setcookie('password', null, -1, '/'); 
          setcookie('email', null, -1, '/'); 
          header("Location:index.php");
        }
    }

    //recuperation de l'id de la personne concernée 
    $useridPage=$_GET["userid"];
    //des donnes à recupere pour appeler la fonction qui va faire l'ajax pour publier un post
    
    $sqlforphoto='SELECT * FROM users WHERE id='.$useridConnected;
    $resultphoto=$conn->query($sqlforphoto);
    $resultjava=$resultphoto->fetch();
    $photoUser=$resultjava['profile'];
    if(!$photoUser){                   
        $photoUser='unknown.png';

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
    <!-- Les scrips pour commenter/liker/poster/faire un search/supprimer un post/loadmore -->
   
    <script src="scripts/like.js"></script>
    <script src="scripts/comment.js"></script>
    <script src="scripts/posting.js"></script>
    <script src="scripts/loadmoreMypost.js"></script>
    <script src="scripts/delete.js"></script>
    <script src="scripts/sidebar.js"></script>
    <!-- appeler la fonction search (pour afficher les users à droite) -->



    <script>
    go(<?php echo $useridPage?>)//load pour 10 post on windows.onload
    // appeler la fonction search (pour afficher les users à droite) 
    window.onload=searchS;
   
   
   </script>
</head>
    <!-- NAVBAR -->

    <body>
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
        <div class="middle">
            <?php include("pageparts/profileInfo.php")?>
            <?php if ($useridConnected==$useridPage){?>
        <!-- div ajouter un post(AJAX) -->

            <div class="post-container">
                <div class="post-form">
                     <!-- formulaire traité en javascript pour ajouter un post avec/sans une photo (AJAX) -->
                    <form id="posting-form" enctype="multipart/form-data">
                    <textarea placeholder="What are you thinking about??" id="postContent"></textarea>
                        <input id="fileupload" type="file" name="fileupload" /> 
                    </form>

                    <button onclick="return validatePosting(<?php echo $useridConnected?>,'<?php echo $FirstName.' '.$LastName;?>','<?php echo $photoUser?>')">Post</button>
                </div>
            </div>
            <?php }?>
            <div class="posts" id="posts">
                 <!-- les post sont afficher grace à Ajax car il y'a le bouton loadmore -->
                 <!-- Voir le fichier DisplayMyPost dans le dossier pageparts -->

                <?php ?>
            </div>
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
      
</body>
</html>
