$(document).on('change','#selectCensusAquarium',function(){
    var selectedAquarium = $(this).val();
    $("#acceptBtn").prop("disabled",false);
});

$(document).on('click','#acceptBtn',function(){ 
    var selectedAquarium = $('#selectCensusAquarium').val();
    $.ajax({
        url: "census/get-census-data",
        type: "GET",
        data: {idAquarium: selectedAquarium},
        dataType: "html",
        success: function(response){
            alert('funciona');
        },
        error: function(xhr,err){
            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            alert("responseText: "+xhr.responseText);
        }
      });
});