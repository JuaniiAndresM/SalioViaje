
function editarPerfil(){
    $.ajax({ 
        url: "/SalioViaje/PHP/editarPerfil.php",
        success: function(response){
            $('#header').load('/SalioViaje/web/header.php');
        }
    });
}