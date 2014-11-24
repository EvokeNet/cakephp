require(['../requirejs/bootstrap'], function () {
	require(['jquery', 'froala', '../js/requirejs/modules/facebook_share'], function ($) {
		$(document).ready(function(){			
			//--------------------------------------------//
			//FROALA EDITOR
			//--------------------------------------------//
			$('#newCommentForm').editable({
				inlineMode: false,
				tabSpaces: true,
				theme: 'dark'
			});
		});
	});
});