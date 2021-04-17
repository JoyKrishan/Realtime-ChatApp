
const users_list= document.querySelector(".users .users-list");
const user_name = document.querySelector(".users .content .details span");

setInterval(function(){
    let xhr= new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);
    xhr.onload = function(){
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
               let data = xhr.response;
               users_list.innerHTML = data;
            }
        }
    };
    xhr.send();
}, 500);