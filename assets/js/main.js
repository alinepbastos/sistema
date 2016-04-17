$(document).ready(function(){
    
    $('.excluir').css('cursor', 'pointer');
    
    $('.excluir').click(function(){
        var r = confirm($(this).attr('data-mensagem'));
        
        if(r == true) {
            window.location.href = $(this).attr('data-href');
        }
        
    });
});
