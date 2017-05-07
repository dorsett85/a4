$(document).ready(function() {

    // Add http:// prefix to href links
    $('.companyLink').each(function() {
        var href = $(this).attr('href');
        if (href.substring(0, 3) == 'www') {
            $(this).attr('href', 'http://' + href);
            console.log($(this).attr('href'));
        } else if (href == 'N/A') {
            $(this).removeAttr('href')
        }
    });

});