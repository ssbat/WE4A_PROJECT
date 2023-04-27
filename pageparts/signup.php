<?php 
    //pour ajouter un compte
    function CheckNewAccountForm(){
        global $conn;

        //The java script did the verification for the length etc...
        //si l'utilisateur essaye de desactiver 
        if(isset($_POST["firstname"]))
        {

            $first_name=SecurizeString($_POST["firstname"]);//securiser le string
            $first_name=ucwords(strtolower($first_name));//mettre seulememt la premiere lettre en majuscule
            $last_name=SecurizeString($_POST["lastname"]);//pareil
            $last_name=ucwords(strtolower($last_name));
            $email=SecurizeString($_POST["email"]);
            $password=md5(SecurizeString($_POST["password"]));
            $filename=NULL;

            //si il y'a un avatar
            if(isset($_FILES['image']) &&  ($_FILES["image"]["type"] == "image/gif" OR $_FILES["image"]["type"]== "image/png" OR $_FILES["image"]["type"]== "image/jpeg" OR $_FILES["image"]["type"]== "image/JPEG" OR $_FILES["image"]["type"]== "image/PNG" OR $_FILES["image"]["type"]== "image/GIF")){
                
                $filename = $_FILES["image"]["name"];
                $tempname = $_FILES["image"]["tmp_name"];
                
                $folder = "./images/" . $filename;
                if (move_uploaded_file($tempname, $folder)) {//remplace
                    // echo "<h3>  Image uploaded successfully!</h3>";
                } else {
                    // echo "<h3>  Failed to upload image!</h3>";
                }
            }
            else{
                // echo "<h3>  No image inserted or invalid type!</h3>";

            }
            $gender=$_POST["gender"];
            $specialite=$_POST["spec"];
            
            
            //remplir une liste des données à inserer
            $data = [
                'First_Name' => $first_name,
                'Last_Name' => $last_name,
                'Email' => $email,
                'Password' => $password,
                'po'=>$filename,
                'gender'=>$gender,
                'spec'=>$specialite
            ];
        //inserer les donnees dans la bdd
        try{
        $sql="INSERT INTO users (First_Name,Last_Name,Email,PASSWORD,profile,Gender,Specialite)VALUES(:First_Name,:Last_Name,:Email,:Password,:po,:gender,:spec)";
        $stmt= $conn->prepare($sql);
        $stmt->execute($data);
            return [true,"Succesfully Created"];
        }
        // le mail est deja utilise
        catch (Exception $e){
            return [false,"Already Used Email"];
        }
        }
        return "";

    }


    
        

?>