<?php 
//section de profil dans la page personnel

//checher tous les donnes de la BDD
$sql2="SELECT * FROM users WHERE id=".$useridPage;
$stm2=$conn->query($sql2);
$result=$stm2->fetch();


//si il y' a pas de resulat
if(!$stm2 or !$result){
    die("<center><h1 style='color:red'>Erreur servenue : No user Found </h1></center>");
    // echo "</div>";
}else{

$lastname=$result["Last_Name"];
$firstname=$result["First_Name"];
$photo=$result["profile"];
$spec=$result["Specialite"];
    ?>
<!-- //titre -->
<?php }?>
    

<div class="profile-info">
    <!-- cover photo -->
    <img src="./images/cover.jpg" class="cover-photo">
    <!-- image de profil -->
    <div class="company-logo">
        <img src="./images/<?php
            if($photo){
            echo $photo;
            }else{
            echo "unknown.png";

    }

            
            
            ?>" class="logo-profile">
    </div>
    <div class="profile-details">
        <div class="profile-bio">
            <h3 class="profile-name"><?php echo $firstname." ".$lastname?></h3>
           <form action="./editprofile.php">
                <!-- pour modifer le nom ou la photo -->
               <button class='edit' >Edit</button>
           </form>

        </div>
    </div>
    <div class="desc">
        <div class="desc-1">
        <!-- affichage de laa specialite -->
        Étudiant ingénieur en <?php echo $spec?> à l'Université de Technologies de Belfort-Montbéliard
        </div>
        <div  class="desc-2">
        <!-- logo UTBM  -->
        <img src="./images/UTBM.png" class="utbm">
        <p class="uni"><a href="https://www.utbm.fr/">Université de Technologie de Belfort-Montbéliard</a></p>
        </div>
    </div>
</div>