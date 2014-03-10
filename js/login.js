jQuery( document ).ready(function( ) {
    jQuery('#loginEmail').focus(function(){
        $('#loginEmail').val("");
    });
    jQuery('#loginPass').focus(function(){
        $('#loginPass').val("");
    });
    jQuery('#recoverEmail').focus(function(){
        $('#recoverEmail').val("");
    });
});