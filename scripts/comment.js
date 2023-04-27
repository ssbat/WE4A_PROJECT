function validateComment(post_id,author,authorname,authorphoto){
    console.log(post_id);
    console.log(author);
    console.log(authorname);
    console.log(authorphoto);

    var content=document.getElementById('cmnt-'+post_id).value
    document.getElementById('cmnt-'+post_id).value=""
    
    var comments_div=document.getElementById('comments-div-'+post_id)
    console.log(comments_div);
    if(content.length==0){
        alert("Comment can't be empty")
        return false
    }
    comment(post_id,author,comments_div,content,authorname,authorphoto)
    return true
}
function comment(post_id,author,comments_div,content,authorname,authorphoto){
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './pageparts/processing_comment.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    var btn_cmnt=document.getElementById('post-comment-'+post_id)
   
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
    div="<div class='post-header'><img src='./images/"+authorphoto+"' class='post-avatar comment-avatar'><div class='post-username comment-username'><a href='./myPage.php?userid="+author+"'>"+authorname+"</a><br><span class='content'>"+content+"</span><br>"+"</div> </div>";
    comments_div.innerHTML+=div
        }
    }
  xhr.send(`post-id=${post_id}&comment=${content}`);
}

