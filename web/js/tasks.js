$(document).ready(function(){

});


//CORRESPONDIENTES A INCORPORAR EJEMPLARES//
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


//CORRESPONDIENTES A REMOVER EJEMPLARES//
$(document).on('change','#selectSpecieRemove',function(){
    var data_id = $(this).val();
    $.ajax({
       url: "task-specimen/get-aquariums-r",
       type: "GET",
       data: {id : data_id},
       dataType: "html",
       success: function(response){
          $("#inputsRemove").html(response);
          $("#alertRemove").html('');
       },
       error:function(){
           $("#inputsRemove").html("Error. Contacte al administrador");
       }
     });
});



$(document).on('click','#removeBtn',function(){ 
    var inputsData = new Object();
    var selectedSpecie = '';
    var selectedSpecie = $('#selectSpecieRemove').val();
    $('.tsInput').each(function(){
        var aquariumID = $(this).attr('id');
        var aquariumValue = $(this).val();
        if(aquariumValue!=0){
        inputsData[aquariumID] = aquariumValue;
        }    
    });
    $.ajax({
        url: "task-specimen/remove-specimens",
        type: "POST",
        data: {data : JSON.stringify({quantities: JSON.stringify(inputsData),specie: selectedSpecie})},
        dataType: "html",
        success: function(response){
            $("#inputsRemove").html('');
            $("#alertRemove").html(response);
        },
        error: function(xhr,err){
            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            alert("responseText: "+xhr.responseText);
        }
      });
});
