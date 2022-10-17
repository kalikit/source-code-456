var btn_login = document.querySelector(".btn_login");
var container = document.querySelector(".form_main");
var alert = document.querySelector(".alert");
btn_login.addEventListener("click", myclick)

function myclick(){
container.classList.add("hideContainer");
alert.classList.remove("alert");
alert.style.display = 'block';
}