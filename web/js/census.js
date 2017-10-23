$(document).on('change','#selectCensusAquarium',function(){
    var selectedAquarium = $(this).val();
    $("#acceptBtn").prop("disabled",false);
});

$(document).on('click','#acceptBtn',function(){ 
    var selectedAquarium = $('#selectCensusAquarium').val();
    alert(selectedAquarium);
});