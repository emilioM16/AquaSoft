$(document).on('ready pjax:success', function() {  // 'pjax:success' use if you have used pjax
$('.inModal').click(function(e){
e.preventDefault();      
$('#newSpecialistModal').modal('show')
            .find('.contenidoModal')
            .load($(this).attr('href'));  
});
});