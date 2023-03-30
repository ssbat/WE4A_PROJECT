
<?php 
// echo "ho";
$sql="SELECT * FROM users";

$result_side=$conn->query($sql);
// echo $result_side->rowC
// echo $result_side->rowCount();
foreach($result_side as $row4){
    ?>
    <div class="sidebar">
    <div class="user">
      <!-- <img src="" alt="Profile Picture"> -->
      <img src="./images/<?php
            if($row4['profile']){
            echo $row4['profile'];
            // echo "HI";
            }else{
            echo "unknown.png";
            }

    ?>">

      <h2><?php echo $row4["First_Name"]." ".$row4["Last_Name"] ?></h2>
    </div>
    <?php 
}

?>

      
        
    <!-- <div class="user">
      <img src="profile-pic-2.jpg" alt="Profile Picture">
      <h2>Jane Smith</h2>
    </div>
  
    <div class="user">
      <img src="profile-pic-3.jpg" alt="Profile Picture">
      <h2>Bob Johnson</h2>
    </div> -->
  </div>