function validateForm(){

    const first_name = document.forms["Form"]["firstname"].value;
    const  last_name= document.forms["Form"]["lastname"].value;
    const email = document.forms["Form"]["email"].value;
    const password= document.forms["Form"]["password"].value;
    const password2= document.forms["Form"]["password2"].value;
    
    formIsVerified=true;
    
    if (containsNumbers(first_name)){
        document.getElementById("first-name").innerText="A name cannot contain numbers."
        formIsVerified=false;
    }
    if (containsNumbers(last_name)){
        document.getElementById("last-name").innerText="A name cannot contain numbers."
        formIsVerified=false;
    
    }

    if(passError(password,password2)){
        console.log("!!!");
        formIsVerified=false;
        error=passError(password,password2);
        document.getElementById("password").innerText=error
    }
    console.log(first_name);
    console.log(last_name);
    console.log(email);
    console.log(password);
    console.log(password2);
    console.log(formIsVerified);
    return formIsVerified;
}

/*To check if a string contains numbers in JavaScript, 
call the test() method on this regex: /\d/. test() 
will return true if the string 
contains numbers. Otherwise, it will return false.*/
function containsNumbers(str){
    return /\d/.test(str);
  }
function passError(password,password2){
    if (6>password.length || password.length>40){
        return "Password length must be between 6 ans 40 characters";
    };
    if(password!=password2){
        return "Passwords do not matched";
    }
    return false;//the pass does not contain errors
}
// console.log(containsNumbers("saad2"));