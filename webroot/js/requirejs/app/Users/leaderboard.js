require(['../requirejs/bootstrap'], function () {
	require(['jquery','chartjs'], function ($) {
		
		//--------------------------------------------//
		//Line chart
		//--------------------------------------------//
		$(document).ready(function() {
			var lineChartData = {
				labels: ["January", "February", "March", "April", "May", "June", "July"],
				datasets: [
					{
						label: "My First dataset",
						fillColor: "rgba(151,187,205,0.5)",
						strokeColor: "rgba(151,187,205,1)",
						pointColor: "rgba(151,187,205,1)",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						data: [65, 59, 80, 81, 56, 55, 40]
					},
					{
						label: "My Second dataset",
						fillColor: "rgba(151,187,205,0.5)",
						strokeColor: "rgba(151,187,205,1)",
						pointColor: "rgba(151,187,205,1)",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(151,187,205,1)",
						data: [28, 48, 40, 19, 86, 27, 90]
					}
				]
			}

			var lineChart = new Chart(document.getElementById("performance-chart").getContext("2d")).Line(lineChartData,
			{
				maintainAspectRatio: false,
				pointLabelFontColor: "#26dee0",
				pointLabelFontFamily : "'Orbitron'",
				pointLabelFontSize : 14,
				responsive: true,
				scaleLineColor: "#555",
				scaleFontColor: "#fff",
				scaleShowLabels : true,
				tooltipYPadding: 0,
				tooltipXPadding: 0
			});
		});
	});
});