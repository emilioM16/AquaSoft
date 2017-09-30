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