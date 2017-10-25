$('document').on('ready pjax:success',function(){ //para la búsqueda de acuarios
    $('#idAcuario').on('pjax:end', function() {
        $.pjax.reload({container:'#acuarios'}); 
    });
});

