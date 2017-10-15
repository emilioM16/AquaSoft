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
       },
       error:function(){
           $("#inputs").append("Error. Contacte al administrador");
       }
     });
})