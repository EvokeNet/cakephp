$("#filters :checkbox").click(function() {
   	$("#filters :checkbox").each(function() {
       	if($(this).is(':checked')) {
            $("." + $(this).val()).fadeTo("slow", 1);
		} else {
            //$("." + $(this).val()).fadeTo("slow", 0);
            $("." + $(this).val()).hide();
        }
 	});
});