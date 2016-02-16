require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','jqueryui'], function ($) {
		$(document).ready(function(){
			setTimeout(function () {
					document.getElementById('image-header').style.display = "table";
					document.getElementById('side-menu').style.display = "inline";
					document.getElementById('panel-content').style.display = "inline";
			},50);

			$("li#<?=$this->params['controller']?>").addClass("active");

		});
	});
});
