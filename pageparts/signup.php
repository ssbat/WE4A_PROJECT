<?php 

    function CheckNewAccountForm(){
        global $conn;

        $signAttempted=false;
        //The java script did the verification 
        if(isset($_POST["firstname"]))//pas besoin de tester les autres info
        {
            $signAttempted=true;
            $first_name=$_POST["firstname"];
            $last_name=$_POST["lastname"];
            $email=$_POST["email"];
            $password=md5($_POST["password"]);
        
            $data = [
                'First_Name' => $first_name,
                'Last_Name' => $last_name,
                'Email' => $email,
                'Password' => $password
        ];
       $sql="INSERT INTO users (First_Name,Last_Name,Email,PASSWORD)VALUES(:First_Name,:Last_Name,:Email,:Password)";
       $stmt= $conn->prepare($sql);
       $stmt->execute($data);
        return "Succesfully Created";
       }
       return "";

    }


    
        

?>