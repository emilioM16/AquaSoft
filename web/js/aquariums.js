$('document').on('ready pjax:success',function(){ //para la búsqueda de acuarios
    $('#idAcuario').on('pjax:end', function() {
        $.pjax.reload({container:'#acuarios'}); 
    });
});



$(document).on('change','[id$=-idinsumo]',function(){
   var id = $(this).attr('id');
   var tsId= id.replace('idinsumo','quantity');
   var supplyId = $(this).val();
   var supplyName = $("#"+id + " option:selected").text();

   if (supplyName != 'Ninguno'){
    $('#'+tsId).prop('disabled',false);
        $.ajax({
            url: "../supply/get-stock",
            type: "GET",
            data: {supplyId : supplyId},
            dataType: "html",
            success: function(response){
                $('#'+tsId).trigger("touchspin.updatesettings", {max: response});
            },
            error:function(){
                alert("Error. Contacte al administrador");
            }
        });
    }else{
        $('#'+tsId).prop('disabled',true);
    }
});