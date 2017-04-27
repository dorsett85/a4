$(document).ready(function() {

    $('.infoButton').click(function(e) {
        event.preventDefault();
        $(this).parent().siblings('.shortDescription').toggle('slow');
    })
})