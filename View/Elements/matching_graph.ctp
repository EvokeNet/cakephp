<canvas id="radar-graph" height="<?= (isset($height) ? $height : '450') ?>" width="<?= (isset($width) ? $width : '500') ?>" ></canvas>

<?php
	/* Script */
	$this->start('script');

	//CHARTJS
	echo $this->Html->script('/components/chartjs/Chart.js');
?>
	<script type="text/javascript">
		//Radar chart
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
				scaleShowLabels : false,
				tooltipYPadding: 0,
				tooltipXPadding: 0,
				pointLabelFontColor: "#26dee0",
				pointLabelFontFamily : "'Orbitron'",
				pointLabelFontSize : 10,
				scaleLineColor: "#555"
			});
		});
	</script>
	<?php $this->end(); ?>