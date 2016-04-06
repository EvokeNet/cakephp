<?php echo $this->element('topbar'); ?>

<div class="alchemy" id="alchemy"></div>  


  <script type="text/javascript">

    var width = 1366;
    var height = 590;
    var svgWidth = 0;
    var svgHeight = 0;

    function resize() {
	 	  svg = document.getElementsByTagName("svg")[0];
	 	  
	 	  if(typeof svg !== 'undefined' && (svgWidth!=width || svgHeight!=height)) {
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
      dataSource: '<?= $this->Html->url(array('controller' => 'users', 'action' => 'gameboard_layout', 'admin' => false)) ?>',
      forceLocked: true,
      graphHeight: function(){ return height; },
      afterLoad: resize(),
      graphWidth: function(){ return width; },
      initialScale: 1,
      curvedEdges: false,
      nodeClick: function(node){
        allNodes = alchemy.get.nodes().all();

        for(n = 0; n < allNodes.length; n++){
            
            if(allNodes[n]!=node){
              allNodes[n].toggleSelected(false);
            }
        }

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
      scaleExtent: [1, 1],
      edgeStyle: {
        "all" : {
          "width": 3,
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
        "all" : {
          "radius": 12,
          "color"  : "blue",
          "borderColor": "white",
              "selected": {
                "color" : "green",
                "borderColor": "white"
              },
        },
      	"opression": {
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
