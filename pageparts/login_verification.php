<?php 
    //verification LOGIN
    function verificationLogin(){
        global $conn,$FirstName,$useridConnected,$LastName; 
        $error=NULL;
        if (isset($_POST["email"]) and isset($_POST["password"])){//deja le formulaire est envoyé
            
            $logAttempted=true;
            $email=SecurizeString( $_POST["email"]);//securiser les string
            $password=md5(SecurizeString($_POST["password"]));//hashage du mot de passe pour la securite
        }
        elseif (isset($_COOKIE["email"]) and isset($_COOKIE["password"])){//connexion à travers les cookies
            $logAttempted=true;
            $email=$_COOKIE["email"];
            $password=$_COOKIE["password"];
        }
        else{//sinon il y'a un pas un login attempted
            $logAttempted=false;
        }
        $logverif=false;
        //verification du login
        if ($logAttempted){

            $sql="SELECT * FROM users WHERE Email=:E AND PASSWORD =:Pa";
            $stm=$conn->prepare($sql);
            $stm->bindParam("Pa",$password);
            $stm->bindParam("E",$email);
            $stm->execute();
            if ($stm->rowCount())//login bon
            {
                $logverif=true;
                setcookie('email', $email, time()+3600*24, '/', '', false, true);//creation des cookies
                setcookie('password', $password, time()+3600*24, '/', '', false, true);
                $row = $stm->fetch();
                $FirstName=$row["First_Name"];
                $LastName=$row["Last_Name"];
                $useridConnected=$row["ID"];
                setcookie('LastName',$row["Last_Name"] , time()+3600*24, '/', '', false, true);
            }
            
            else{//email ou mot de passe faux
                $logverif=false;
                $error="email or password is incorrect!";
            }
        }
        $infoArray=array("Successful"=>$logverif,"Attempted"=>$logAttempted,"Error"=>$error);//Des infos sur le login
        return $infoArray;
    }

?>