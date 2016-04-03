require([webroot+'js/requirejs/bootstrap'], function () {
	require(['jquery','chartjs'], function ($) {
		
		//--------------------------------------------//
		//Progress line chart
		//--------------------------------------------//
		$(document).ready(function() {
			var lineChartData = {
				labels: ["02/2014", "04/2014", "06/2014", "08/2014", "10/2014", "12/2014", "02/2015"],
				datasets: [
					{
						label: "My progress",
						strokeColor: "#26dee0",
						pointColor: "rgba(151,187,205,1)",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						data: [65, 59, 80, 81, 56, 55, 40]
					},
					{
						label: "General evoke progress",
						strokeColor: "#ccc",
						pointColor: "#ccc",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(151,187,205,1)",
						data: [28, 48, 40, 19, 86, 27, 90]
					}
				]
			};

			var lineChart = new Chart(document.getElementById("performance-chart").getContext("2d")).Line(lineChartData,
			{
				datasetFill: false,
				maintainAspectRatio: false,
				pointLabelFontColor: "#26dee0",
				pointLabelFontFamily : "'Orbitron'",
				pointLabelFontSize : 14,
				responsive: true,
				scaleLineColor: "#555",
				scaleFontColor: "#fff",
				scaleShowLabels : true,
				showTooltips: true,
				tooltipYPadding: 0,
				tooltipXPadding: 0
			});
		});
	});
});