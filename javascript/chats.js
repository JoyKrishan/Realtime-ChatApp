/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

const form = document.querySelector(".typing-area");
const inputfield = form.querySelector(".input-field");
const sendBtn = form.querySelector("button");
const chatbox = document.querySelector(".chat-area .chat-box");


form.onsubmit= function(e){
    e.preventDefault(e); // preventing the form from submitting
};

sendBtn.onclick = function(){
    let xml_req = new XMLHttpRequest(); 
    xml_req.open("POST", "php/chat-insert.php", true );
    xml_req.onload = function(){
        if(xml_req.readyState === XMLHttpRequest.DONE ){
            if (xml_req.status === 200){
                let data = xml_req.response;
                inputfield.value="";
                }
            }
    };
    let formData = new FormData(form);
    xml_req.send(formData);
};


setInterval(function(){
    let xhr= new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = function(){
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
               let data = xhr.response;
               console.log(data);
               chatbox.innerHTML = data;
            }
        }
    };
    let formdata = new FormData(form);
    xhr.send(formdata);
}, 500);