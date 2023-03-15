<?php 

    function verificationLogin(){
        $error=NULL;
        if (isset($_POST["username"]) and isset($_POST["password"])){
            
            $logAttempted=true;
            $username=$_POST["username"];
            $password=md5($_POST["password"]);
        }
        elseif (isset($_COOKIE["username"]) and isset($_COOKIE["password"])){
            $logAttempted=true;
            $username=$_COOKIE["username"];
            $password=$_COOKIE["password"];
        }
        else{
            $logAttempted=false;
        }
        $logverif=false;
        if ($logAttempted){
            if($username=="saad" and $password==md5("FuckyouBenoit")){
                $logverif=true;
                setcookie('username', $username, time()+3600*24, '/', '', false, true);
                setcookie('password', $password, time()+3600*24, '/', '', false, true);
            } 
            else{
                $logverif=false;
                $error="Username or password is incorrect!";
            }
        }
        $infoArray=array("Successful"=>$logverif,"Attempted"=>$logAttempted,"Error"=>$error);
        return $infoArray;
    }

?>