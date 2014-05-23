$("#mine").click(function() {
		var hidden = true;
		if(hidden) {
  		$('.second-tabs').show();
  		$(".first-tabs").hide();

  		// $( "#showHistory>small" ).remove('');
  		// $( "#showHistory" ).append('<small>hide update history</small>');
  		hidden = false;
  	} 
});

$("#their").click(function() {
		var hidden = true;
		if(hidden) {
  		$('.first-tabs').show();
  		$(".second-tabs").hide();
  		// $( "#showHistory>small" ).remove('');
  		// $( "#showHistory" ).append('<small>hide update history</small>');
  		hidden = false;
  	} 
});