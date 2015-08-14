require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','missionpanels', 'sweetalert'], function ($,missionPanels,swal) {

		//--------------------------------------------//
		//REMOVE GROUP MEMBER CONFIRMATION ALERT BOX
		//--------------------------------------------//
		$(".buttonRemoveMember").click(function(){
			var remove_url = $(this).attr('href');

			swal({
				title: "Are you sure?",
				text: "This user will no longer be part of your group.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, I'm sure",
				closeOnConfirm: false
			}, function() {
				$.ajax({
				  url: remove_url+'/true',
				  success: function() {
					swal({
						title: "Done!",
						text: "The user has been removed from your group.",
						type: "success"
					}, function(){
						missionPanels.reloadMainContent();
					});
				  },
				  error: function() {
					swal("Error", "Sorry, this user could not be removed.", "error");
				  }
				});
			});

			event.preventDefault();
		});
		
		//--------------------------------------------//
		// ACCEPT GROUP REQUEST VIA AJAX
		//--------------------------------------------//
		$(".buttonAcceptRequest").click(function(){
			$.ajax({
				type: 'POST',
				url: $(this).attr('href'),
				success: function(response) {
					swal("Done!", "Request accepted!", "success");
					missionPanels.reloadMainContent();
				}
			});
			event.preventDefault();
		});

		//--------------------------------------------//
		// DECLINE GROUP REQUEST VIA AJAX
		//--------------------------------------------//
		$(".buttonDeclineRequest").click(function(){
			$.ajax({
				type: 'POST',
				url: $(this).attr('href'),
				success: function(response) {
					swal("Done!", "Request denied.", "success");
					missionPanels.reloadMainContent();
				}
			});
			event.preventDefault();
		});
	});
});