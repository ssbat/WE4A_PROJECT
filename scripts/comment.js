function validateComment(index){
    console.log(index);
    var comment=document.getElementById('cmnt-'+index).value
    // var error=document.getElementById('error-'+index)

    // const comment = document.querySelector('input[name="cmnt-'+index+'"]').value;
    // const error = document.querySelector('input[name="error-'+index+'"]').value;


    // var error=document.getElementById("error")
    if(comment.length==0){
        alert("Comment can't be empty")
        return false
    }
    return true

}