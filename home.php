<?php
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Holtwood+One+SC&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="scripts/like.js"></script>
    <script src="scripts/comment.js"></script>
    <script src="scripts/posting.js"></script>
    <script src="scripts/loadmore.js"></script>
    <script src="scripts/sidebar.js"></script>
    



</head>
    <nav class="nav-div">
            <ul class="nav-ul">
                <li class="nav-li logo"><a href="home.php">Home</a></li>
                <li class="nav-li logo" ><a href="./myPage.php?userid=<?php echo $useridConnected?>"><?php echo $FirstName;?></a></li>
                <li class="nav-li logo">About</li>
                
                <li class="nav-li logo last"><img class="logo-img" src="./images/2.png" ></li>

                <!-- <li class="nav-li center">Home</li> -->
                <!-- <li class="nav-li center">Home</li> -->

                
                <a><li class="nav-li">Want to sign-out?</li></a>
                <form action="#" method="post">
                    <input type="hidden" name="logout" value="OK">
                    <button class="btn-signout" type="submit"><li class="nav-li sign-up">Signout</li></button>
                </form>
            </ul>
    </nav>
    <!-- <h1 class="title-h1">Home Page</h1> -->
    <div class="main" >
        <div class="left-bar">
            <?php include("./pageparts/right-sidebar.php")?>
        </div>
        <div >
        <div class="post-container">
            <div class="post-form">
                <form id="posting-form" enctype="multipart/form-data">
                <textarea placeholder="What's happening?" id="postContent"></textarea>
                    <input id="fileupload" type="file" name="fileupload" /> 
                </form>

                <button onclick="return validatePosting(<?php echo $useridConnected?>,'<?php echo $FirstName.' '.$LastName;?>','<?php echo $photoUser?>')">Post</button>
        </div>
         </div>
            <div class="posts" id="posts">
                 <?php //include("./pageparts/DisplayHome.php")/*?>

            </div>
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


                        </div>
                    </div>
                </div>
                    
            </div>
           
            
        </div>

    </div>
        



</body>
</html>