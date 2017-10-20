$(document).ready(function(){

});


//CORRESPONDIENTES A INCORPORAR EJEMPLARES//
$(document).on('change','#selectSpecieAdd',function(){
    var data_id = $(this).val();
    $.ajax({
       url: "task-specimen/get-aquariums",
       type: "GET",
       data: {id : data_id,taskType:'add'},
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
    var selectedSpecie = $('#selectSpecieAdd').val();
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
       url: "task-specimen/get-aquariums",
       type: "GET",
       data: {id : data_id,taskType:'remove'},
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
            $("#inputs").html('');
            $("#alert").html(response);
        },
        error: function(xhr,err){
            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            alert("responseText: "+xhr.responseText);
        }
      });
});





//CORRESPONDIENTES A TRANSFERIR EJEMPLARES//
$(document).on('change','#selectOriginAquarium',function(){
    var data_id = $(this).val();
    $.ajax({
       url: "task-specimen/get-aquariums",
       type: "GET",
       data: {id : data_id,taskType:'transfer'},
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



$(document).on('click','#transferBtn',function(){ 
    var inputsData = new Object();
    var selectedSpecie = '';
    var selectedSpecie = $('#selectSpecieAdd').val();
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