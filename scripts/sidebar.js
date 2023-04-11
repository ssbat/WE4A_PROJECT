
console.log("hi");
function searchS()
{
    var side_div=document.getElementById('result-search')
    var search=document.getElementById('search-input');

    value=(search.value).toLowerCase();
    var xhr=new XMLHttpRequest();
    xhr.open('POST', './pageparts/sidebar.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            side_div.innerHTML=xhr.responseText;
        }
    }
    xhr.send(`similar=${value}`);
}
window.onload=searchS;