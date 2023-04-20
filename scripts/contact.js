 form2 = document.getElementById("formcontact");
statusTxt =document.getElementById("spancontact");
form2.onsubmit = (e)=>{
  e.preventDefault();
  statusTxt.style.color = "#0D6EFD";
  statusTxt.style.display = "block";
  statusTxt.innerText = "Sending your message...";
  form2.classList.add("disabled");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./pageparts/message.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState == 4 && xhr.status == 200){
      let response = xhr.response;
      if(response.indexOf("required") != -1 || response.indexOf("valid") != -1 || response.indexOf("failed") != -1){
        statusTxt.style.color = "red";
      }else{
        form2.reset();
        setTimeout(()=>{
          statusTxt.style.display = "none";
        }, 3000);
      }
      statusTxt.innerText = response;
      form2.classList.remove("disabled");
    }
  }
  let formData = new FormData(form2);
  xhr.send(formData);
}