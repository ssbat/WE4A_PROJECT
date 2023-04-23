<?php 
$sql2="SELECT * FROM users WHERE id=".$useridPage;
$stm2=$conn->query($sql2);
$result=$stm2->fetch();



if(!$stm2 or !$result){
    die("<center><h1 style='color:red'>Erreur servenue : No user Found </h1></center>");
    // echo "</div>";
}else{
$lastname=$result["Last_Name"];
$firstname=$result["First_Name"];
// $result=$stm2

$photo=$result["profile"];
$spec=$result["Specialite"];
    ?>
    <!-- <h1 class="title-h1"><?php echo "Welcome To ".$firstname." Page";}?></h1> -->
    

<div class="profile-info">
    <img src="./images/cover.jpg" class="cover-photo">
    <div class="company-logo">
        <img src="./images/<?php
            if($photo){
            echo $photo;
            // echo "HI";
            }else{
            echo "unknown.png";

    }

            
            
            ?>" class="logo-profile">
    </div>
    <div class="profile-details">
        <div class="profile-bio">
            <h3 class="profile-name"><?php echo $firstname." ".$lastname?></h3>
           <form action="./editprofile.php">
               <button class='edit' >Edit</button>
           </form>

        </div>
    </div>
    <div class="desc">
        <div class="desc-1">
        Étudiant ingénieur en <?php echo $spec?> à l'Université de Technologies de Belfort-Montbéliard
        </div>
        <div  class="desc-2">
        <!-- Étudiersité de Technologies de Belfort-Montbéliard -->
        <img src="./images/UTBM.png" class="utbm">
        <p class="uni"><a href="https://www.utbm.fr/">Université de Technologie de Belfort-Montbéliard</a></p>
        </div>
    </div>
</div>