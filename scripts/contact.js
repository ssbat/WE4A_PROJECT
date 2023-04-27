
//pour envoyer un mail 
// PAGE contact

  // Pour la page contact-me je me suis renseigné sur internet pour savoir commment créer



// selection des forms
form2 = document.getElementById("formcontact");
statusTxt =document.getElementById("spancontact");
//si le bouton submit est appuyé
form2.onsubmit = (e)=>{
  e.preventDefault();//je bloque le submit
  //je change le style et le text pour simuler l'emvoie
  statusTxt.style.color = "#0D6EFD";
  statusTxt.style.display = "block";
  statusTxt.innerText = "Sending your message...";
  // je desactive le bouton
  form2.classList.add("disabled");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./pageparts/message.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState == 4 && xhr.status == 200){
      let response = xhr.response;
      //cas d'une erreur
      if(response.indexOf("required") != -1 || response.indexOf("valid") != -1 || response.indexOf("failed") != -1){
        statusTxt.style.color = "red";
      }else{//message bien envoyé
        form2.reset();
        setTimeout(()=>{
          statusTxt.style.display = "none";
        }, 3000);
      }
      statusTxt.innerText = response;
      form2.classList.remove("disabled");
    }
  }
  let formData = new FormData(form2);//formulaire de données
  // methode_post
  xhr.send(formData);
}