<?php 

    function verificationLogin(){
        global $conn;
        $error=NULL;
        if (isset($_POST["email"]) and isset($_POST["password"])){
            
            $logAttempted=true;
            $email=$_POST["email"];
            $password=md5($_POST["password"]);
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
            // if($email=="saad" and $password==md5("FuckyouBenoit")){
            //     $logverif=true;
            //     setcookie('email', $email, time()+3600*24, '/', '', false, true);
            //     setcookie('password', $password, time()+3600*24, '/', '', false, true);
            // } 
            // $conn
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
                setcookie('FirstName',$row["First_Name"] , time()+3600*24, '/', '', false, true);
                setcookie('LastName',$row["Last_Name"] , time()+3600*24, '/', '', false, true);
                // setcookie('LastName',$row["Last_Name"] , time()+3600*24, '/', '', false, true);


                // setcookie('password', $password, time()+3600*24, '/', '', false, true);

            }
            // $stm->bindParam(':ln', $_POST['Lastname']);
            
            else{
                $logverif=false;
                $error="email or password is incorrect!";
            }
        }
        $infoArray=array("Successful"=>$logverif,"Attempted"=>$logAttempted,"Error"=>$error);
        return $infoArray;
    }

?>