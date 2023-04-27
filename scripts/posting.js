

// INSERTION D'un post
// AJAX

// Liens utiles:
// https://stackoverflow.com/questions/29156417/how-do-i-add-additional-post-parameters-to-ajax-file-upload
//https://www.theserverside.com/blog/Coffee-Talk-Java-News-Stories-and-Opinions/Ajax-JavaScript-file-upload-example

function validatePosting(author,authorname,authorphoto){ 
    // je recupere le contenu
    var content=document.getElementById('postContent').value;
    let formData = new FormData(); 
    if(fileupload.files[0])//si y'a un file ajouté
    {formData.append("file", fileupload.files[0]);}
    formData.append('post',content);
    form=document.getElementById("posting-form");
    form.reset();//je recupere les donnes puis je fais un reset
    var posts_div=document.getElementById('posts')
    if(content.length==0){//un post ne pas pas etre vide
        alert("Post can't be empty")
        return false
    }
    post(author,posts_div,content,authorname,authorphoto,formData);
    return true;
}
//AJAX
function post(author,posts_div,content,authorname,authorphoto,formData){
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './pageparts/processposting.php', true);   
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            div=xhr.responseText;
            posts_div.innerHTML=div+posts_div.innerHTML;            
        }
    }
  xhr.send(formData);
}
