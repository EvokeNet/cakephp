<?php echo $this->element('topbar'); ?>

<div class="alchemy" id="alchemy"></div>


  <script src="http://cdn.graphalchemist.com/alchemy.min.js"></script>

      <script type="text/javascript">

      var width = 1920;
      var height = 905;
      var svgWidth = 0;
      var svgHeight = 0;


     function resize() {
	 	svg = document.getElementsByTagName("svg")[0];
	 	console.log("interval");
	 	if(typeof svg !== 'undefined' && (svgWidth!=width || svgHeight!=height)) {
	 		console.log("teste");
	 		svgWidth = width;
	 		svgHeight = height;
		 	svg.style.width = svgWidth.toString()+"px";
		 	svg.style.height = svgHeight.toString()+"px";
		 	clearInterval(checkSize);
		 	nodes = document.getElementsByClassName("node");
	 	}
	}

	var checkSize = setInterval(function() {
	  		resize();
		}, 50);

	

    var config = {
      dataSource: '<?= $this->webroot.'charlize.json' ?>',
      forceLocked: true,
      graphHeight: function(){ return height; },
      afterLoad: resize(),
      graphWidth: function(){ return width; },    
      fixNodes: true,
      fixRootNodes: true,  
      linkDistance: function(){ return 40; },
      nodeCaption: function(node){ 
        return node.caption + " " + node.fun_fact;},
      nodeStyle: {
      	"all": {
      		"radius": 20,
      		"color"  : "#68B9FE",
            "borderColor": "white",
			"captionColor": "gray",
			"captionSize": 20,
            "selected": {
                "color" : "#68B9FE",
                "borderColor": "white"
            },
            "highlighted": {
                "color" : "#EEEEFF",
                "borderColor": "#127DC1"
            },
            "hidden": {
                "color": "none",
                "borderColor": "none"
            }
      	}
      }};

    alchemy = new Alchemy(config);

	

  </script>



<style>
  circle {
          fill: white;
          fill-opacity: .5;
          stroke-width: 3;
          stroke-opacity: 1;
          stroke: black;
      }

      circle.root {
          stroke-width: 5;
          fill: lightblue;
          fill-opacity: 1;
      }

      circle.award {
          stroke: yellow;
          stroke-width: 1;
      }

      circle.person {
          stroke: lightblue;
          stroke-width: 1;
      }
      .selected circle{
          fill-opacity: 1;
          stroke-width: 4;
          stroke: lightblue;
      }

      .edge {
          stroke-linecap: round;
          stroke: lightblue;
          stroke-opacity: 0.4;
          stroke-width: 2;
      }

      .edge.NOMINATED {
          stroke: lightblue;
      }

      .edge.RECEIVED {
          stroke-dasharray: 10,5,2,2,2,5;
          stroke: yellow;
          stroke-opacity: 1;
      }

      .edge.ACTED_IN {
          stroke: green;
      }

      .edge.selected {
          stroke: lightblue;
          stroke-opacity: 1;
          stroke-dasharray: none;
      }
</style>
