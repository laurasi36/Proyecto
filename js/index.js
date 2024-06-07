//Seleccionamos los DOM que necesitamos
var btnAbrir = document.getElementById('user_icon');
var btnCerrar = document.getElementById('close_icon');
var menu = document.getElementById('menu');

//Al darle clic se llamara a esta funcion que te abrira el submenu
function abrir(){
    btnAbrir.style.visibility='hidden';
    btnCerrar.style.visibility='visible';
    menu.style.visibility='visible';
}
//Al darle al boton de cerrar se ocultara el submenu
function cerrar(){
    btnAbrir.style.visibility='visible';
    btnCerrar.style.visibility='hidden';
    menu.style.visibility='hidden';
}
cerrar();