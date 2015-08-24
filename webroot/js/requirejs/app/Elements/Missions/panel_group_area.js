require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','missionpanels', 'sweetalert'], function ($,missionPanels,swal) {

		//--------------------------------------------//
		//REMOVE GROUP MEMBER CONFIRMATION ALERT BOX
		//--------------------------------------------//
		$(".buttonRemoveMember").click(function(){
			var remove_url = $(this).attr('href');

			swal({
				title: "Estas seguro?",
				text: "Este usuario ya no sera parte de su grupo.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si, estoy seguro",
				closeOnConfirm: false
			}, function() {
				$.ajax({
				  url: remove_url+'/true',
				  success: function() {
					swal({
						title: "Hecho!",
						text: "El usuario ha sido removido de su grupo.",
						type: "success"
					}, function(){
						missionPanels.reloadMainContent();
					});
				  },
				  error: function() {
					swal("Error", "Lo sentimos, este usuario no puede ser eliminado.", "error");
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
					swal("Hecho!", "Solicitud aceptada!", "success");
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
					swal("Hecho!", "Solicitud rechazada.", "success");
					missionPanels.reloadMainContent();
				}
			});
			event.preventDefault();
		});
	});
});