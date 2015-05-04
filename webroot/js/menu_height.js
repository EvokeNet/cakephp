$(document).ready(function() {
    menuHeight();
});

function menuHeight(){
	$(".maincolumn").each(function() {
        $('.menucolumn').css("height", $(this).innerHeight());
        //alert($(this).innerHeight());
    });
}