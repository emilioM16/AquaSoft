$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="tooltip"]').on('shown.bs.tooltip', function () {
        $('.tooltip').addClass('animated rubberBand');
    })
})

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
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
            document.getElementById('modalHeader').innerHTML = '<h4 class="modalTitle">' + $(this).attr('title') + '</h4>';
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