$(document).on('ready pjax:success', function() {  // 'pjax:success' use if you have used pjax
    $('.inModal').click(function(e){
    e.preventDefault();      
    $('#pModal').modal('show')
                .find('.contenidoModal')
                .load($(this).attr('href'));  
    });
});



$('document').on('ready pjax:success',function(){ //para la búsqueda de acuarios
    $('#idacuario').on('pjax:end', function() {
        $.pjax.reload({container:'#acuarios'}); 
    });
});

