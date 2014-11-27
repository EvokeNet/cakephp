require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','chartjs'], function ($) {
		
		//--------------------------------------------//
		//Radar chart
		//--------------------------------------------//
		$(document).ready(function() {
			var radarChartData = {
				labels : ["Activism","Connecting Ideas","Creativity","Data Analysis","Entrepreneurship","Knowledge Building","Local Insight","Problem Solving"],
				datasets : [
					{
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
						pointColor : "rgba(151,187,205,1)",
						pointStrokeColor : "#fff",
						data : [28,48,40,19,96,27,100,50]
					}
				]
			}

			var myRadar = new Chart(document.getElementById("radar-graph").getContext("2d")).Radar(radarChartData,
			{
				maintainAspectRatio: false,
				pointLabelFontColor: "#26dee0",
				pointLabelFontFamily : "'Orbitron'",
				pointLabelFontSize : 10,
				responsive: true,
				scaleLineColor: "#555",
				scaleShowLabels : false,
				tooltipYPadding: 0,
				tooltipXPadding: 0
			});
		});
	});
});