$(document).ready(function() {

    // Add http:// prefix to href links
    $('.companyLink').each(function() {
        var href = $(this).attr('href');
        if (href.substring(0, 4) != 'http') {
            $(this).attr('href', 'http://' + href);
        } else if (href == 'N/A') {
            $(this).removeAttr('href')
        }
    });

});