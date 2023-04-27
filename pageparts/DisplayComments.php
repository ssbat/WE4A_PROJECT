<?php 

    //le id de div contient le id du post auquels les commentaires appartiennent (utile pour ajax)
    echo "<div id='comments-div-".$last_id."'>";
    $sql="SELECT * FROM comments WHERE post_id=".$postid;
    foreach($conn->query($sql) as $commentdetail){//parcourir les commentaire liés au post
        $sql2="SELECT * FROM users WHERE id=".$commentdetail["user_id"];
        $stm2=$conn->query($sql2);
        $result=$stm2->fetch();
        //recuperation des donnes
        $last_name=$result["Last_Name"];
        $first_name=$result["First_Name"];
        $comment=$commentdetail["content"];
        
        //affichage du avatar de la personne qui a commentée
            echo "<div class='post-header'>
                <img src='./images/";
                 if($result['profile']){
                     echo $result['profile'];
                    }else{
                    echo 'unknown.png';
                }
                //affichage de contenu du commentaire
                echo "' class='post-avatar comment-avatar'>
                    <div class='post-username comment-username'><a href='./myPage.php?userid=".$result["ID"]."'>".$first_name.' '.$last_name."</a><br><span class='content'>$comment</span><br>
                </div>
            </div>";

        }
        echo "</div>"

?>
