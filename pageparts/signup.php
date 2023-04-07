<?php 

    function CheckNewAccountForm(){
        global $conn;

        $signAttempted=false;
        //The java script did the verification 
        if(isset($_POST["firstname"]))//pas besoin de tester les autres info
        {
            $signAttempted=true;
            $first_name=$_POST["firstname"];
            $first_name=ucwords(strtolower($first_name));
            $last_name=$_POST["lastname"];
            $last_name=ucwords(strtolower($last_name));

            $email=$_POST["email"];
            $password=md5($_POST["password"]);
        
            
            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "./images/" . $filename;
            if (move_uploaded_file($tempname, $folder)) {
                echo "<h3>  Image uploaded successfully!</h3>";
            } else {
                echo "<h3>  Failed to upload image!</h3>";
            }
            $gender=$_POST["gender"];
            $specialite=$_POST["spec"];


            
            
            
            
            
                // Insert image content into database 
                    // $insert = $db->query("INSERT into images (image, created) VALUES ('$imgContent', NOW())"); 
                    
                //     if($insert){ 
                //         $status = 'success'; 
                //         $statusMsg = "File uploaded successfully."; 
                //     }else{ 
                //         $statusMsg = "File upload failed, please try again."; 
                //     }  
                // }else{ 
                //     $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
                // } 
            
            $data = [
                'First_Name' => $first_name,
                'Last_Name' => $last_name,
                'Email' => $email,
                'Password' => $password,
                'po'=>$filename,
                'gender'=>$gender,
                'spec'=>$specialite
            ];
        
        try{
        $sql="INSERT INTO users (First_Name,Last_Name,Email,PASSWORD,profile,Gender,Specialite)VALUES(:First_Name,:Last_Name,:Email,:Password,:po,:gender,:spec)";
        $stmt= $conn->prepare($sql);
        $stmt->execute($data);
            return [true,"Succesfully Created"];
        }
        catch (Exception $e){
            return [false,"Already Used Email"];
        }
        }
        return "";

    }


    
        

?>