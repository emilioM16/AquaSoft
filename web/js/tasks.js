$(document).ready(function(){

});

$(document).on("hidden.bs.modal", "#modal", function () {
    $(this).find("#modalContent").css('height', 'auto');
  });


//CORRESPONDIENTES A INCORPORAR EJEMPLARES//
$(document).on('change','#selectSpecieAdd',function(){
    var data_id = $(this).val();
    $.ajax({
       url: "../task-specimen/get-aquariums",
       type: "GET",
       data: {id : data_id,taskType:'add'},
       dataType: "html",
       success: function(response){
          $("#inputs").html(response);
          var totalHeight = $("#inputs").height() + 90;
          $("#alert").html('');          
          $("#modalContent").animate({"height":totalHeight+'px'},200,'linear');
       },
       error: function(xhr,err){
        alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
        alert("responseText: "+xhr.responseText);
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
    if(Object.keys(inputsData).length != 0){
        $.ajax({
            url: "../task-specimen/add-specimens",
            type: "POST",
            data: {data : JSON.stringify({quantities: JSON.stringify(inputsData),specie: selectedSpecie})},
            dataType: "html",
            success: function(response){
                var totalHeight = $("#alert").height() + 220;
                $("#inputs").html('');
                $("#alert").html(response);
                $("#modalContent").animate({"height":totalHeight+'px'},200,'linear');
            },
            error: function(xhr,err){
                alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
                alert("responseText: "+xhr.responseText);
            }
        });
    }else{
        $("#alert").html('<div class="alert alert-warning" role="alert">Por favor ingrese la cantidad de ejemplares a incorporar</div>');
        var totalHeight = $("#alert").height() + $("#inputs").height() + 100; 
        $("#modalContent").animate({"height":totalHeight+'px'},200,'linear');
    }
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
        var totalHeight = $("#inputs").height() + 90;
        $("#alert").html('');          
        $("#modalContent").animate({"height":totalHeight+'px'},200,'linear');
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
    if(Object.keys(inputsData).length != 0){
        $.ajax({
        url: "task-specimen/remove-specimens",
        type: "POST",
        data: {data : JSON.stringify({quantities: JSON.stringify(inputsData),specie: selectedSpecie})},
        dataType: "html",
        success: function(response){
            var totalHeight = $("#alert").height() + 220;
            $("#inputs").html('');
            $("#alert").html(response);
            $("#modalContent").animate({"height":totalHeight+'px'},200,'linear');
        },
        error: function(xhr,err){
            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            alert("responseText: "+xhr.responseText);
        }
      });  
    }else{
        $("#alert").html('<div class="alert alert-warning" role="alert">Por favor ingrese la cantidad de ejemplares a remover</div>');
        var totalHeight = $("#alert").height() + $("#inputs").height() + 100; 
        $("#modalContent").animate({"height":totalHeight+'px'},200,'linear');
    }

});





//CORRESPONDIENTES A TRANSFERIR EJEMPLARES//
$(document).on('change','#selectDestinationAquarium',function(){
    var selectedSpecieId = $('#selectSpecie').val();
    var originAquariumId = $('#selectOriginAquarium').val();
    var destinationAquariumId = $(this).val();
    $.ajax({
       url: "task-specimen/get-destination-aquarium-data",
       type: "GET",
       data: {originId: originAquariumId, destinationId : destinationAquariumId, specieId:selectedSpecieId},
       dataType: "html",
       success: function(response){
        $("#inputs").html(response);
        var totalHeight = $("#inputs").height() + 208;
        $("#alert").html('');          
        $("#modalContent").animate({"height":totalHeight+'px'},200,'linear');
       },
    //    error:function(){
    //        $("#inputs").html("Error. Contacte al administrador");
    //    }
    error: function(xhr,err){
        alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
        alert("responseText: "+xhr.responseText);
    }
     });
});



$(document).on('click','#transferBtn',function(){ 
    var inputsData = new Object();
    var selectedSpecie = $('#selectSpecie').val();
    var originAquariumId = $('#selectOriginAquarium').val();
    var aquariumID = $('.tsInput').attr('id');
    var aquariumValue = $('.tsInput').val();
    if(aquariumValue!=0){
    inputsData[aquariumID] = aquariumValue;
    $.ajax({
        url: "task-specimen/transfer-specimens",
        type: "POST",
        data: {data : JSON.stringify({quantities: JSON.stringify(inputsData),specie: selectedSpecie, originId: originAquariumId})},
        dataType: "html",
        success: function(response){
            var totalHeight = $("#alert").height() + 330;
            $("#inputs").html('');
            $("#alert").html(response);
            $("#modalContent").animate({"height":totalHeight+'px'},200,'linear');
        },
        error: function(xhr,err){
            alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            alert("responseText: "+xhr.responseText);
        }
      });    
    }else{
        $("#alert").html('<div class="alert alert-warning" role="alert">Por favor ingrese la cantidad de ejemplares a transferir</div>');
        var totalHeight = $("#alert").height() + $("#inputs").height() + 210; 
        $("#modalContent").animate({"height":totalHeight+'px'},200,'linear');
    }
});