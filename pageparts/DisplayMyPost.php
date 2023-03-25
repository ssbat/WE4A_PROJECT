<?php 

// echo "<h3> Hello </h3>";
$sql2="SELECT * FROM users WHERE id=".$useridPage;
$stm2=$conn->query($sql2);
$result=$stm2->fetch();
$lastname=$result["Last_Name"];
$firstname=$result["First_Name"];
// $result=$stm2


$sql="SELECT * FROM post WHERE user_id=".$useridPage;

if(!$conn->query($sql)){
    echo"Erreur servenue";
}else{
    ?><h1 class="title-h1"><?php echo "Welcome To ".$firstname." Page" ?></h1><?php

    echo "<div class='post-container'>";
    foreach($conn->query($sql) as $row){
        $titre=$row["Titre"];
        $content=$row["content"];
        ?>
        
            <div class="post">
                <p class="author"><?php echo $firstname." ".$lastname ?></p>
                <h3 class="title-post"><?php echo $titre?></h3>
                <p class="content"><?php echo $content?></p>
            </div>
            
            <?php }
            if ($useridPage==$useridConnected){
            ?>
            <a class="sign-up a-add" href="./post.php"><button id="btn-add">Add Post</button></a>
            
            <?php }

echo "</div>";
}

?>


<!-- echo "Titre:$titre <br>Content:$content <br>"; -->