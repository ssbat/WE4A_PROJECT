
      <?php 
          include("connect.php");
          $conn=connect_db();
          include("login_verification.php");
          $infoArray=verificationLogin();
      
          if ($infoArray["Successful"]==false){
                  header("Location:index.php");
          }
          $searchWord=$_POST["similar"];
          
        
          // https://www.bootdey.com/snippets/view/light-user-list#html     
          // $_POST["similar"]
          $sql="SELECT * FROM `users` WHERE LOWER(`First_Name`) LIKE '".$searchWord."%' or LOWER(`Last_Name`) LIKE '".$searchWord."%' ";
          // echo $sql;

          // $sql="SELECT * FROM users";
          $result_side=$conn->query($sql);
          foreach($result_side as $row4){
            if($row4['profile']){$photo=$row4['profile'];}else{$photo='avatar7.png';};
            
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

 




