<?php 

    function verificationLogin(){
        global $conn,$FirstName,$useridConnected,$LastName; 
        $error=NULL;
        if (isset($_POST["email"]) and isset($_POST["password"])){
            
            $logAttempted=true;
            $email=SecurizeString( $_POST["email"]);
            $password=md5(SecurizeString($_POST["password"]));
        }
        elseif (isset($_COOKIE["email"]) and isset($_COOKIE["password"])){
            $logAttempted=true;
            $email=$_COOKIE["email"];
            $password=$_COOKIE["password"];
        }
        else{
            $logAttempted=false;
        }
        $logverif=false;
        if ($logAttempted){
   
            $sql="SELECT * FROM users WHERE Email=:E AND PASSWORD =:Pa";
            $stm=$conn->prepare($sql);
            $stm->bindParam("Pa",$password);
            $stm->bindParam("E",$email);
            $stm->execute();
            if ($stm->rowCount()){
                $logverif=true;
                setcookie('email', $email, time()+3600*24, '/', '', false, true);
                setcookie('password', $password, time()+3600*24, '/', '', false, true);
                $row = $stm->fetch();
                $FirstName=$row["First_Name"];
                $LastName=$row["Last_Name"];
                $useridConnected=$row["ID"];
                setcookie('LastName',$row["Last_Name"] , time()+3600*24, '/', '', false, true);
            }
            
            else{
                $logverif=false;
                $error="email or password is incorrect!";
            }
        }
        $infoArray=array("Successful"=>$logverif,"Attempted"=>$logAttempted,"Error"=>$error);
        return $infoArray;
    }

?>