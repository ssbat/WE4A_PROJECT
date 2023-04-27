<?php
    //importation du classe Dbconn et vérification du log-in
    include("../classes/Dbconn.php");
    $db=new Dbconn();
    if(!$db->connSuccessful[0]){//si il y'a une erreur
        die($db->connSuccessful[1]);//arretez le programme avec l'affichage de l'erreur 
    }
    $conn=$db->conn;
    include("login_verification.php");
    $infoArray=verificationLogin();

    if ($infoArray["Successful"]==false){//si le log-in est faux,redirection vers la page de log-in
            header("Location:index.php");
    }
include('./DateTime.php');//Importation Des fonctions utiles pour le temps et les dates des postes


$postNumber = $_GET['firstPost'];//savoir le offset pour afficher 3 postes différents à chaque appuie sur le bouton loadmore 


$sql="SELECT * FROM `post` ORDER BY `post`.`date` DESC LIMIT 3 OFFSET ".$postNumber;//requete pour récuper 10 postes (de plus récents au plus anciens)
$stm=$conn->query($sql);//execution de la requete
if(!$stm){//au cas d'erreur
    die("Erreur requete des pages!");
}
//pour faire disparaitre le bouton "load more" quand il y'a plus des postes dans la DB
$nopost=false;
//pour enlever la bouton automatiquement quand il y'a plus des postes
if($stm->rowCount()==0 or $stm->rowCount()<3){
    $nopost=true;//il y'a plus des postes
}
foreach($stm as $postdetail){//parcourir les postes
    //pour chaque poste on recupere le id de l'auteur et le contenu du post et la date et le nombre des like/dislike
   
   //de id de l'auteur on recupere son nom/prenom 
    $last_id=$postdetail['id'];
    $sql2='SELECT * FROM users WHERE id='.$postdetail['user_id'];
    $stm2=$conn->query($sql2);
    $result=$stm2->fetch();
    $lastname=$result['Last_Name'];
    $firstname=$result['First_Name'];
   
    //recuperation du contenu du post et de la photo si y'en a
    $content=$postdetail['content'];
    $post_photo=null;
    if($postdetail['photo']){$post_photo=$postdetail['photo'];};

    
    //recuperation du nombre des likes du post 
    $sqlLikes='SELECT * FROM likes WHERE post_id='.$postdetail['id'];
    $stmLikes=$conn->query($sqlLikes);
    $Likes=$stmLikes->rowCount();
    //cette requete est pour savoir si la personne connectée à liker ou non (car le couleur du like va changer)
    $sqlLiked='SELECT * FROM likes WHERE post_id='.$postdetail['id'].' AND user_id='.$useridConnected.';';
    $stmLiked=$conn->query($sqlLiked);
    $pressed=false;
    if($stmLiked->rowCount()>0){//si le rowCount() est 1 alors qu'il y'a un résultat pour la requete => la personne connecté à liker
        $pressed=true;
    }

   //meme chose pour le dislike
    $sqlDisLikes='SELECT * FROM dislikes WHERE post_id='.$postdetail['id'];
    $stmDisLikes=$conn->query($sqlDisLikes);
    $disLikes=$stmDisLikes->rowCount();
    
    $sqlDisLiked='SELECT * FROM dislikes WHERE post_id='.$postdetail['id'].' AND user_id='.$useridConnected.';';
    $stmDisLiked=$conn->query($sqlDisLiked);
    $pressed_dislike=false;


    if($stmDisLiked->rowCount()>0){
        $pressed_dislike=true;
    }

    //la div post:
    echo "<div class='post' id=".$postdetail['id'].">
        <div class='post-header'>";
        //affichage de l'avatar   
        echo "<img src='./images/";
            if($result['profile']){
            echo $result['profile'];//l'avatar si le user en a
            }else{
            echo 'unknown.png';//sinon la photo unknown
    }
            echo"' class='post-avatar'>";
           
            //affichage du nom/prenom et le temps ecoulé depuis la publication de ce post(getdateTimedifferenceString)
            echo "<div>
                <div class='post-username'><a href='./myPage.php?userid=".$postdetail['user_id']."'>".$firstname.' '.$lastname."</a> </div>
                <div class='post-handle'><span > ● ".getDateTimeDifferenceString($postdetail['date'])."</span></div>
            
            </div>
        </div>";
        //affichage du contenue avec la photo si y'en a 
       echo "<div class='post-body'>
            <p style='word-wrap: break-word'>".$content."</p>";
             if($post_photo){ 
            echo "<img src='./images/".$post_photo."' alt='Tweet image' class='tweet-image'>"
             ;}
        echo "</div>
        <div class='like-edit-bar'>
            <form class='form-like'>";
                
            //affichage du nombre des likes et changement du couleur de like au cas ou c'est liker par la personne connectée
                $like_etat=null;
                if(!$pressed){$like_etat='background-image: url(./images/unliked.png)';}
                    else{$like_etat='background-image: url(./images/liked2.png);'
                     ;   }
                //des données utile pour ajax car le systeme de post et du commentaire et du likes est avec AJAX,PAS BESOIN DE rafraichir  LA PAGE !!! :-)
                echo "<input name='postid-".$postdetail['id']."' value=".$postdetail['id']." type='hidden'>
                <input name='userid-".$postdetail['id']."' value=".$useridConnected." type='hidden'>";
                
                //affichage du nombre de likes
                echo "<span class='like-count' id='like-count-".$postdetail['id']."'>".$Likes."</span>
                <button type='button' class='like-icon' id='like-button-".$postdetail['id']."' onclick='like(". $postdetail['id'].")' 
                style='".$like_etat."'></button>
            </form>";
            //pour le dislike c'est pareil
            echo "<form class='form-like'>";
            
                $dislike_etat=null;
            if(!$pressed_dislike){$dislike_etat='background-image: url(./images/dislike.png)';}
                    else{$dislike_etat='background-image: url(./images/dislike-red.png);'
                     ;   }
                    
                
                echo "<input name='postid-".$postdetail['id']."' value='".$postdetail['id']."' type='hidden'>
                <input name='userid-".$postdetail['id']."' value=".$useridConnected."' type='hidden'>
                
                <span class='like-count' id='dislike-count-".$postdetail['id']."'>".$disLikes."</span>
                <button type='button' class='like-icon dislike' id='dislike-button-".$postdetail['id']."' onclick='dislike(".$postdetail["id"].")' 
                style= '".$dislike_etat."' ></button>
            </form>";
           

        //un bouton edit pour modifier le post qui s'affiche seulement si l'auteur du post est celui qui est connecté
            if ($useridConnected==$postdetail['user_id']){
            
            echo "<form class='like-button' method='get' action='./pageparts/editPost.php'>";
            //des input "hidden" pour la processus de modification,postdetail[id]c'est le id du post
            echo" <input type='hidden' name='postID'value=".$postdetail['id'].">
                <button class='edit' >Edit</button>
            </form>";
            //supprimer un post (encore avec AJAX)
            echo "<button type='button' class='like-icon trash' id='trash-button-".$postdetail['id']."' onclick='trash(".$postdetail["id"].")'></button>"; };
        echo "</div><hr>";

        //Les commentaires/reponses du post
        echo "<div class='comments' id='comments-".$postdetail['id']."'>";
              
                $postid=$postdetail['id'];
                include('./DisplayComments.php');
                //après l'affichage des commentaires
                //la section d'ecrire un commentaire(AJAX):
                //des donnes à recupere pour appeler la fonction qui va faire l'ajax de commenter
                $sqlforphotoandname='SELECT * FROM users WHERE id='.$useridConnected;
                $resultphotoandname=$conn->query($sqlforphotoandname);
                $resultjava=$resultphotoandname->fetch();
                $firstJava=$resultjava['First_Name'];
                $lastJava=$resultjava['Last_Name'];
                $firstandLast=$firstJava.' '.$lastJava;
                $photoJava=$resultjava['profile'];
                if(!$photoJava){                   
                   $photoJava='unknown.png';

               }
             //section ecrire un commentaire
            echo "<div  class='post-comment' id='post-comment-".$postdetail['id']."' >
                <small class='error' id='error-".$postdetail['id']."'></small>
                <input  name='comment' id='cmnt-".$postdetail['id']."' >
                <input name='post-id' value=".$postdetail['id']." type='hidden'>";
                //boutton qui appelle la fonction validatecomment qui verifie la commentaire puis elle fait l'AJAX necessaire
                echo "<button type='submit' class='btn-cmnt' onclick=\"";echo "return validateComment("; echo $postdetail['id'].",";echo $useridConnected.",'";echo $firstandLast;echo "','";echo $photoJava."')\">Post comment</button>
            </div>
        </div>
    </div>" 
        ; $postNumber++;;//j'increment le nombre de postes (pour le loadmore)
            ;}
            if(!$nopost){//si il y'a encore des post,afficher le boutton loadmore
            echo '<button id="morePosts" class="btn-add sign-up a-add" onclick="loadMorePosts('.$postNumber.')">Load More</button></a>';
            ;}
            ?>
            <!-- <a class='sign-up a-add' href='./post.php'><button id='btn-add'>Add Post</button></a> -->
            
            <?php 
?>
    