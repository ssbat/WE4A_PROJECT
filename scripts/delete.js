// suppresion d'un post
//AJAX
function trash(post_id){
    console.log(post_id);
    // recuperer le div du post à supprimer
    post_div=document.getElementById(post_id);
    console.log(post_div);
    // AJAX
    var xml=new XMLHttpRequest();
    xml.open("POST","./pageparts/delete.php",true);
    xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xml.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200){
            // Gestion des erreurs
            if (this.responseText==true){
                post_div.remove();
                alert("Post Deleted!");
            }
            else{
                alert(this.responseText);
            }

        }
    }
    // envoyer le post_id pour modifier la bdd
  xml.send(`post_id=${post_id}`);

}