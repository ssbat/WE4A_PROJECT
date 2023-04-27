


// SYSTEME DE LIKE
//AJAX
function like(postid){
  // recuperer le postid et le userid de la personne qui a liké
  const postId = document.querySelector('input[name="postid-'+postid+'"]').value;
  const userId = document.querySelector('input[name="userid-'+postid+'"]').value;
  console.log(postId);
  console.log(userId);
  // Send an AJAX request to the PHP script
  const xhr = new XMLHttpRequest();
  xhr.open('POST', './pageparts/like.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  console.log(xhr);
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // modifier le nombre des like
      const likeCount = document.getElementById('like-count-'+postid);
      jsonDetails=JSON.parse(xhr.responseText)
      likeCount.textContent = jsonDetails['likes'];
      const icon = document.getElementById('like-button-'+postid);
      console.log(icon);
      // changement du couleur de like si c'est pressed
      if(jsonDetails["pressed"]){
        icon.style.cssText+='background-image: url(./images/liked2.png)'
        // icon.setattribute('style',')
  
      }
      // changement du couleur de like si c'est unpressed
      else{
        icon.style.cssText+='background-image: url(./images/unliked.png)'

      }
      console.log(jsonDetails);

    }
  };
  xhr.send(`post_id=${postId}&user_id=${userId}`);
}




function dislike(postid){
  const postId = document.querySelector('input[name="postid-'+postid+'"]').value;
  const userId = document.querySelector('input[name="userid-'+postid+'"]').value;
  const xhr = new XMLHttpRequest();
  xhr.open('POST', './pageparts/dislike.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  console.log(xhr);
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Update the like count
      const likeCount = document.getElementById('dislike-count-'+postid);
      jsonDetails=JSON.parse(xhr.responseText)
      likeCount.textContent = jsonDetails['dislikes'];
      const icon2 = document.getElementById('dislike-button-'+postid);
      console.log(icon2);
      if(jsonDetails["pressed"]){
        icon2.style.cssText+='background-image: url(./images/dislike-red.png)'
        // icon.setattribute('style',')
  
      }
      else{
        // icon.setattribute('style','background-image: url(./images/unliked.png)')
        icon2.style.cssText+='background-image: url(./images/dislike.png)'

      }
      console.log(jsonDetails);

    }
  };
  xhr.send(`post_id=${postId}&user_id=${userId}`);
}




