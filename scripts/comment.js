function validateComment(post_id,author){
    console.log(post_id);
    console.log(author);
    var content=document.getElementById('cmnt-'+post_id).value
    var comments_div=document.getElementById('comments-'+post_id)
    // var error=document.getElementById('error-'+post_id)
    // let form = document.getElementById("mySelect").lastChild.text;

    console.log(comments_div);
    // const comment = document.querySelector('input[name="cmnt-'+post_id+'"]').value;
    // const error = document.querySelector('input[name="error-'+post_id+'"]').value;
    // var error=document.getElementById("error")
    if(content.length==0){
        alert("Comment can't be empty")
        return false
    }
    return true
}
function comment(post_id){
    

}