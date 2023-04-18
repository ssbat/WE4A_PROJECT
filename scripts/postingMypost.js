async function loadMoreMyPosts(numberOfPostsAlready) {

    const element = document.getElementById('morePosts');
    if (element != null ) {element.remove();}

    var AJAXresult = await fetch("./pageparts/DisplayMyPost.php?firstPost=" + numberOfPostsAlready);
    // console.log("./pageparts/DisplayHome.php?firstPost=" + numberOfPostsAlready);
    writearea = document.getElementById("posts");
    console.log(writearea);
    writearea.innerHTML = writearea.innerHTML + await AJAXresult.text();

}


window.onload = loadMoreMyPosts(0);
