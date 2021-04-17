
const form = document.querySelector(".signup form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-txt");

form.onsubmit= function(e){
    e.preventDefault(e); // preventing the form from submitting
};

continueBtn.onclick = function(){
    let xml_req = new XMLHttpRequest(); 
    xml_req.open("POST", "php/signup.php", true );
    xml_req.onload = function(){
        if(xml_req.readyState === XMLHttpRequest.DONE ){
            if (xml_req.status === 200){
                let data = xml_req.response;
      
                if(data.trim() === "success"){
                    console.log("working");
                    location.href = "users.php";}
                else{
                    console.log(data);
                    errorText.style.display ="block";
                    errorText.textContent = data;
                    console.log("not working");
                }
            }
        }
    };
    let formData = new FormData(form);
    xml_req.send(formData);
};

