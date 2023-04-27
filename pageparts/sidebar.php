
      <!-- Systeme de "search" pour trouver les etudiants (right bar) -->
      
      <?php 
        //connexion DBB
          include("../classes/Dbconn.php");
          $db=new Dbconn();
          if(!$db->connSuccessful[0]){
              die($db->connSuccessful[1]);
          }
          $conn=$db->conn;
          include("login_verification.php");
          $infoArray=verificationLogin();
      
          if ($infoArray["Successful"]==false){
                  header("Location:index.php");
          }
          //mot inserer pour faire le recherche
          $searchWord=$_POST["similar"];
          
          //requete LIKE
          $sql="SELECT * FROM `users` WHERE LOWER(`First_Name`) LIKE '".$searchWord."%' or LOWER(`Last_Name`) LIKE '".$searchWord."%' ";
          // echo $sql;

          $result_side=$conn->query($sql);
          foreach($result_side as $row4){
            //si l'utilisateur a un profil afficher la photo sinon afficher l'avatar unknown
            if($row4['profile']){$photo=$row4['profile'];}else{$photo='avatar7.png';};
            //afficher le nom d'utilisateur avec la photo et la specialite
            echo "
            <a href='./myPage.php?userid=".$row4['ID']."'>
              <div class='user'>
                  <div class='case'>
                    <div >
                      <img class='profile-photo-lg' src='./images/".$photo."'>
                    </div>
                    <div >
                      <h5 class='h5-test'>".$row4['First_Name'].' '.$row4['Last_Name']." Page</h5>
                      <p>".$row4["Specialite"]."</p>
                    </div>

                  </div>
              </div>
            </a>
            " ;}
      // <?php ?>

 




