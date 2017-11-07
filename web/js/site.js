$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="tooltip"]').on('shown.bs.tooltip', function () {
        $('.tooltip').addClass('animated rubberBand');
    })
})

$('#modal').removeAttr('tabindex');

$(document).ready(function() {
    $('.carousel').carousel({
      interval: 6000
    })
  });

  $(function(){
      $(document).on('click', '.showModalButton', function(){
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            document.getElementById('modalTitle').innerHTML = $(this).attr('title');
        } else {
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
            document.getElementById('modalTitle').innerHTML = $(this).attr('title') ;
        }
    });
});


/**
 * Override the default yii confirm dialog. This function is
 * called by yii when a confirmation is requested.
 *
 * @param message the message to display
 * @param okCallback triggered when confirmation is true
 * @param cancelCallback callback triggered when cancelled
 */
yii.confirm = function (message, okCallback, cancelCallback) {
    swal({
        title: message,
        type: 'warning',
        showCancelButton: true,
        closeOnConfirm: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: 'rgb(87.8%, 7.8%, 7.8%)',
        cancelButtonText:'Cancelar',
        dangerMode: true,
        allowOutsideClick: true,
    }, okCallback);
};

$('#notificationButton').on('click', function(){
     $.ajax({
       url: "site/search-notification",
       type: "GET",
       dataType: "html",
       success: function(response){
          $("#notifix").html(response);
       },
       error: function(xhr,err){
        alert("Ocurrió un error al obtener las notificaciones");
       }
     });
});