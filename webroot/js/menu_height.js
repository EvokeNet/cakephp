$(document).ready(function() {
    $(".maincolumn").each(function() {
        $('.menucolumn').css("height",$(this).innerHeight());
        // alert($(this).innerHeight());
    });
});