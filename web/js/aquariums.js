// $(document).on('ready pjax:success', function() {  // 'pjax:success' use if you have used pjax

// $('.viewAquarium').click(function(e){
//     e.preventDefault();      
//     $('#viewAquariumModal').modal('show')
//                 .find('.contenidoModal')
//                 .load($(this).attr('href'));  
//     });

// $('.addAquarium').click(function(e){
//     e.preventDefault();      
//     $('#addAquariumModal').modal('show')
//                 .find('.contenidoModal')
//                 .load($(this).attr('href'));  
// });
    
// $('.updateAquarium').click(function(e){
//     e.preventDefault();      
//     $('#updateAquariumModal').modal('show')
//                 .find('.contenidoModal')
//                 .load($(this).attr('href'));  
// });

// });




$('document').on('ready pjax:success',function(){ //para la búsqueda de acuarios
    $('#idacuario').on('pjax:end', function() {
        $.pjax.reload({container:'#acuarios'}); 
    });
});

