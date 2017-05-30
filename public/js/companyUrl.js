$(document).ready(function() {

    // Add http:// prefix to href links
    $('.companyLink').each(function() {
        var href = $(this).attr('href');
        if (href.substring(0, 3) == 'www' | href.substring(0, 2) === 'ir') {
            $(this).attr('href', 'http://' + href);
        } else if (href == 'N/A') {
            $(this).removeAttr('href')
        }
    });

});