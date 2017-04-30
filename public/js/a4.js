$(document).ready(function() {

    // Set active navigation li
    var activePill = $(".nav-link[href='" + window.location.pathname + "']").parent();
    activePill.addClass('active');
    var dataPill = $("#data").parent();
    dataPill.addClass('active');


    // Toggle company description
    $('.infoButton').click(function(e) {
        event.preventDefault();
        $(this).parent().siblings('.shortDescription').toggle('slow');
    })


});