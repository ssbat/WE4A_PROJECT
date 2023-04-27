function trash(post_id){
    console.log(post_id);
    post_div=document.getElementById(post_id);
    console.log(post_div);
    var xml=new XMLHttpRequest();
    xml.open("POST","./pageparts/delete.php",true);
    xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xml.onreadystatechange=function(){
        if (this.readyState==4 && this.status==200){
            if (this.responseText==true){
                post_div.remove();
                alert("Post Deleted!");
            }
            else{
                alert(this.responseText);
            }

        }
    }
  xml.send(`post_id=${post_id}`);

}