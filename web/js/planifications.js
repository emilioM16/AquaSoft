// $('#accept').click(function(){
//     $('#pCalendar').css({
//         "visibility":"visible",
//     })
//     var monthYear = $('#monthYearSelect').val();
//     var date = new Date(monthYear);
//     var month = date.getMonth() + 1 ;
//     var year = date.getFullYear();
//     $('#calendar').fullCalendar('gotoDate', new Date(year,month));
// });


$('#checkRepeat').change(function() {
    // this will contain a reference to the checkbox
    if (this.checked) {
        $('#checkboxDays').css({
            "visibility":"visible",
        })
    } else {
        $('#checkboxDays').css({
            "visibility":"hidden",
        })
    }
});


// $.fn.extend({
//     animateCss: function (animationName) {
//         var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
//         this.addClass('animated ' + animationName).one(animationEnd, function() {
//             $(this).removeClass('animated ' + animationName);
//         });
//         return this;
//     }
// });


// $("#pModal").click(function(){
//     $("#pModal").animateCss('fadeIn');
// });

// $(document).ready(function(){
//     $('.modal').removeClass('fade');
// });

// $('.modal').on('show.bs.modal', function (e) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog  fadeIn  animated');
//  })
