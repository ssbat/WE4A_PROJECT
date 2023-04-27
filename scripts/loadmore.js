
// LOADMOREPAGE
// Je me suis renseigné du TD5
async function loadMorePosts(numberOfPostsAlready) {

    const element = document.getElementById('morePosts');
    if (element != null ) {element.remove();}

    var AJAXresult = await fetch("./pageparts/DisplayHome.php?firstPost=" + numberOfPostsAlready);
    console.log("./pageparts/DisplayHome.php?firstPost=" + numberOfPostsAlready);
    writearea = document.getElementById("posts");
    console.log(writearea);
    writearea.innerHTML = writearea.innerHTML + await AJAXresult.text();

}


window.onload = loadMorePosts(0);
console.log("hi");