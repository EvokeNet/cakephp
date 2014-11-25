require(['../requirejs/bootstrap'], function () {
	require(['jquery', 'froala', 'sweetalert', '../js/requirejs/modules/facebook_share'], function ($) {
		$(document).ready(function(){			
			//--------------------------------------------//
			//FROALA EDITOR
			//--------------------------------------------//
			$('#newCommentForm').editable({
				inlineMode: false,
				tabSpaces: true,
				theme: 'dark'
			});

			//--------------------------------------------//
			//CONFIRMATION ALERT BOX
			//--------------------------------------------//
			$('#buttonDeleteEvidence').click(function(event){
				swal({
					title: "Are you sure?",
					text: "You will not be able to recover your evidence.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, delete it!",
					closeOnConfirm: false
				},
				function(){
					//actually perform the action
					$.ajax({
					  url: $('#buttonDeleteEvidence').attr('href')+'/true',
					  success: function() {
					    //Confirm deleted
						swal("Deleted!", "Your evidence has been deleted.", "success");
						
						//RELOAD WINDOW
						window.location.reload(true);
					  },
					  error: function() {
					  	//Error message
						swal("Error", "Sorry, your evidence could not be deleted.", "error");
					  }
					});
				});
				event.preventDefault();
			});

			//--------------------------------------------//
			//LOAD EDIT ELEMENT VIA AJAX
			//--------------------------------------------//
			$('#buttonEditEvidence').click(function(event){
				$('#evidenceContentWrapper').load($(this).attr('href')+'/true', function(){

				});
				event.preventDefault();
			});
		});
	});
});