$(document).ready(function() {

    // Set active navigation li
    var activeTab = $("#sidebar ul li a[href='" + window.location.pathname + "']").parent();
    activeTab.addClass('active');
    var activeTab = $("#sidebar ul li a[id='data']").parent();
    activeTab.addClass('active');


    // Toggle company description
    $('.infoButton').click(function(e) {
        event.preventDefault();
        $(this).parent().siblings('.shortDescription').toggle('slow');
    })


})