async function loadMoreMyPosts(numberOfPostsAlready,userid) {

    const element = document.getElementById('morePosts');
    if (element != null ) {element.remove();}

    var AJAXresult = await fetch("./pageparts/DisplayMyPost.php?firstPost=" + numberOfPostsAlready+"&userid="+userid);
    // console.log("./pageparts/DisplayHome.php?firstPost=" + numberOfPostsAlready);
    writearea = document.getElementById("posts");
    console.log(writearea);
    writearea.innerHTML = writearea.innerHTML + await AJAXresult.text();

}


function go(userid){

    window.onload = loadMoreMyPosts(0,userid);
}
