const form = document.querySelector(".login form");
const   btnLogin = form.querySelector(".button input");
const errorText = form.querySelector(".error-txt");

form.onsubmit= function(e){
    e.preventDefault();
};

btnLogin.onclick = function(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/con_login.php", true);
    xhr.onload = function(){
       if(xhr.readyState === XMLHttpRequest.DONE ){
          if (xhr.status === 200){
  
            let data = xhr.response;
      
            if(data.trim() === "success"){
                    console.log("working");
                    location.href = "users.php";
                    
              }else{
                    console.log(data);
                    errorText.style.display ="block";
                    errorText.textContent = data.trim();
                    console.log("not working");
                }
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
};

