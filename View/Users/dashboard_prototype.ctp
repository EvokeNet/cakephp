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
      dataSource: '<?= $this->webroot.'dashboard.json' ?>',
      forceLocked: true,
      graphHeight: function(){ return height; },
      afterLoad: resize(),
      graphWidth: function(){ return width; },
      nodeClick: function(node){
        problemName = node._nodeType;
        swal("Let's start this mission!",problemName);
      },
      fixNodes: true,
      fixRootNodes: true,  
      linkDistance: function(){ return 40; },
      nodeCaption: function(node){ 
        return node.caption;
      },
      nodeTypes: { "role": 
          ["opression", "conflict", "apathy", "misunderstanding"] 
      }, 
      edgeStyle: {
        "all" : {
          "width": 4,
          "color": "#CCC",
          "opacity": 0.5,
          "selected": {
              "opacity": 0.5
          },
          "highlighted": {
              "opacity": 0.5
          },
          "hidden": {
              "opacity": 0
          }
        }
      },
      nodeStyle: {
      	"opression": {
        		"radius": 20,
        		"color"  : "yellow",
            "borderColor": "white",
              "selected": {
                "color" : "green",
                "borderColor": "white"
              },
            "highlighted": {
                "color" : "white",
                "borderColor": "white"
              },
            "hidden": {
                "color": "none",
                "borderColor": "none"
              }
      	},
        "conflict": {
            "radius": 20,
            "color"  : "red",
            "borderColor": "white",
              "selected": {
                "color" : "green",
                "borderColor": "white"
              },
            "highlighted": {
                "color" : "white",
                "borderColor": "white"
              },
            "hidden": {
                "color": "none",
                "borderColor": "none"
              }
        },
        "apathy": {
            "radius": 20,
            "color"  : "black",
            "borderColor": "white",
              "selected": {
                "color" : "green",
                "borderColor": "white"
              },
            "highlighted": {
                "color" : "white",
                "borderColor": "white"
              },
            "hidden": {
                "color": "none",
                "borderColor": "none"
              }
        },
        "misunderstanding": {
            "radius": 20,
            "color"  : "white",
            "borderColor": "gray",
              "selected": {
                "color" : "green",
                "borderColor": "white"
              },
            "highlighted": {
                "color" : "white",
                "borderColor": "white"
              },
            "hidden": {
                "color": "none",
                "borderColor": "none"
              }
        }
      }
    };

    alchemy = new Alchemy(config);
  </script>



<style>

  .node{
    font-size: 24px;
    cursor: pointer;
  }

  .node.opression{
    fill: black;
  }

  .node.conflict{
    fill: white;
  }

  .node.conflict:hover{
    fill: black;
  }

  .node.apathy{
    fill: white;
  } 

  .node.apathy:hover{
    fill: black;
  } 

  .node.misunderstanding{
    fill: black;
  }

</style>
