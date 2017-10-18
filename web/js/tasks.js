$(document).ready(function(){

});


$(document).on('change','#selectSpecie',function(){
    var data_id = $(this).val();
    $.ajax({
       url: "task-specimen/get-aquariums",
       type: "GET",
       data: {id : data_id},
       dataType: "html",
       success: function(response){
          $("#inputs").html(response);
          $("#alert").html('');
       },
       error:function(){
           $("#inputs").html("Error. Contacte al administrador");
       }
     });
});


$(document).on('click','#addBtn',function(){
    var inputsData = new Object();
    var selectedSpecie = '';
    var selectedSpecie = $('#selectSpecie').val();
    $('.tsInput').each(function(){
        var aquariumID = $(this).attr('id');
        var aquariumValue = $(this).val();
        if(aquariumValue!=0){
        inputsData[aquariumID] = aquariumValue;
        }    
    });
    $.ajax({
        url: "task-specimen/add-specimens",
        type: "POST",
        data: {data : JSON.stringify({quantities: JSON.stringify(inputsData),specie: selectedSpecie})},
        dataType: "html",
        success: function(response){
            $("#inputs").html('');
            $("#alert").html(response);
        },
        error: function(xhr,err){
            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            alert("responseText: "+xhr.responseText);
        }
      });
});