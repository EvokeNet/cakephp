// define(['jquery','froala'], function($) {
// 	function commentBox() {}

// 	commentBox.startEditor = function() {
// 		$('.newCommentForm')
		
// 	}

// 	return commentBox;
// });

		

require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery', 'foundation'], function ($) {
		//FROALA EDITOR
		$('.newCommentForm').editable({
			inlineMode: false,
			minHeight: 200,
			tabSpaces: true,
			theme: 'dark'
		});
	});
});