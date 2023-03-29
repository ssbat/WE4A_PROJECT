




// Get the like button element
// const likeButton = document.getElementById('like-button');
// Add a click event listener to the like button

function like(postid){
  const postId = document.querySelector('input[name="postid-'+postid+'"]').value;
  const userId = document.querySelector('input[name="userid-'+postid+'"]').value;
  console.log(postId);
  console.log(userId);
  // Send an AJAX request to the PHP script
  const xhr = new XMLHttpRequest();
  xhr.open('POST', './scripts/like.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  console.log(xhr);
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      // Update the like count
      const likeCount = document.getElementById('like-count-'+postid);
      jsonDetails=JSON.parse(xhr.responseText)
      likeCount.textContent = jsonDetails['likes'];
      const icon = document.getElementById('like-button-'+postid);
      console.log(icon);
      if(jsonDetails["pressed"]){
        icon.style.cssText+='background-image: url(./images/liked2.png)'
        // icon.setattribute('style',')
  
      }
      else{
        // icon.setattribute('style','background-image: url(./images/unliked.png)')
        icon.style.cssText+='background-image: url(./images/unliked.png)'

      }
      console.log(jsonDetails);

    }
  };
  xhr.send(`post_id=${postId}&user_id=${userId}`);
}









