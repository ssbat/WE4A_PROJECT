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

    $useridPage=$_GET["userid"];

    
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
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Source+Sans+Pro:wght@300;700&display=swap" rel="stylesheet">
    <script src="scripts/like.js"></script>
    <script src="scripts/sidebar.js"></script>

    
    <body>
<nav class="nav-div">
            <ul class="nav-ul">
                <li class="nav-li logo"><a href="home.php">Home</a></li>
                <li class="nav-li logo" ><a href="./myPage.php?userid=<?php echo $useridConnected?>"><?php echo $FirstName;?></a></li>
                <li class="nav-li logo">About</li>
                
                <li class="nav-li logo last"><img class="logo-img" src="./images/2.png" ></li>
                <a><li class="nav-li">Want to sign-out?</li></a>
                <form action="#" method="post">
                    <input type="hidden" name="logout" value="OK">
                    <button class="btn-signout" type="submit"><li class="nav-li sign-up">Signout</li></button>
                </form>
            </ul>
    </nav>
    <div class="main" >
        <div class="left-bar">
            <?php include("./pageparts/right-sidebar.php")?>
        </div>
        <div class="middle">
            <?php include("pageparts/DisplayMyPost.php") ?>
        </div>

        <div class="side-bar" style=" width:100%;height:100%">
            <div class="container">
                <div>
                        
                    <div class="user-container" id="user-container">
                        <h3>Members</h3>    
                        <form class="search-form">
                            <input type="text" class="search" id="search-input" onkeyup="searchS()" placeholder="Search...">
                        </form> 
                        <div id="result-search" >
                            <?php/* include("./pageparts/sidebar.php") */?>

                        </div>
                    </div>
                </div>
                    
            </div>
           
            
        </div>

    </div>
      
        
</body>
</html>
