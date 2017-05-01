$(document).ready(function() {

    // Set active navigation li
    var activePill = $(".nav-link[href='" + window.location.pathname + "']").parent();
    activePill.addClass('active');
    var dataPill = $("#data").parent();
    dataPill.addClass('active');


    // Toggle company description

        // On search page
    $('.searchInfo').click(function(e) {
        event.preventDefault();
        $(this).siblings('.shortDescription').toggle('slow');
    });

        // on Favorites page
    $('.favoriteInfo').click(function(e) {
        event.preventDefault();
        $(this).parent().siblings('.shortDescription').toggle('slow');
    });


});