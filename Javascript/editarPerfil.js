
function editarPerfil(){
    $.ajax({ 
        url: "/PHP/editarPerfil.php",
        success: function(response){
            $('#header').load('/web/header.php');
        }
    });
}