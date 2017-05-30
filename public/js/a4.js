$(document).ready(function () {

    // Set active navigation li
    var subPath = window.location.pathname;
    if (subPath.substring(0, 5) === '/data') {
        $('#data').parent().addClass('active');
    } else {
        var activePill = $(".nav-link[href='" + subPath + "']").parent();
        activePill.addClass('active');
    }

    // Toggle company description

    // On Landing Page
    $('.landingInfo').click(function (e) {
        event.preventDefault();
        $(this).siblings('.shortDescription').toggle('slow');
    });

    // On search page
    $('.searchInfo').click(function (e) {
        event.preventDefault();
        $(this).siblings('.shortDescription').toggle('slow');
    });

    // on Favorites page
    $('.favoriteInfo').click(function (e) {
        event.preventDefault();
        $(this).parent().siblings('.shortDescription').toggle('slow');
    });


});