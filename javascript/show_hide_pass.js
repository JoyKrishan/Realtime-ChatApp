const passwrd = document.querySelector(".form .field input[type='password']");
const toggleBtn = document.querySelector(".form .field i")

toggleBtn.onclick = () =>{
    if(passwrd.type == "password"){
        passwrd.type = "text";
    }else{
        passwrd.type="password";
    }
}


