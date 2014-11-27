require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'froala'], function ($) {
		$(document).ready(function(){			
			//--------------------------------------------//
			//FROALA EDITOR
			//--------------------------------------------//
			$('#evidenceContentForm').editable({
				inlineMode: false,
				minHeight: 200,
				tabSpaces: true,
				theme: 'dark'
			});
		});
	});
});