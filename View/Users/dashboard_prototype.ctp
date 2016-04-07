<?php echo $this->element('topbar'); ?>

<div class="alchemy" id="alchemy"></div>  


  <script type="text/javascript">

    var width = $(window).width();
    var height = $(window).height() - 45;
    var svgWidth = 0;
    var svgHeight = 0;
    var selectedNode = -1;


    function accessibleNodes(node){
      acessibleNodes = [];
      adjacentEdges = node._adjacentEdges;
      for(x = 0; x < adjacentEdges.length; x++){
        if(adjacentEdges[x]._properties.source == node.id){
          acessibleNodes.push(adjacentEdges[x]._properties.target);
        }else{
          acessibleNodes.push(adjacentEdges[x]._properties.source);
        }
      }
      return acessibleNodes;
    }

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

        // Unabled deselect
        if(node._state == "selected"){
          //nodeClick toggles the node state, then 'selected' parameter must be inverted
          return node.setSelected(!true);
        }

        allNodes = alchemy.get.nodes().all();

        // if something is selected
        if(selectedNode >= 0){
          accessibleNodesList = accessibleNodes(allNodes[selectedNode]);

          // if node isn't accessible
          if($.inArray(node.id, accessibleNodesList) < 0){
            swal("You can't access here.");
            //nodeClick toggles the node state, then 'selected' parameter must be inverted
            return node.setSelected(!false);
          }

          allNodes[selectedNode].setSelected(false);
        }

        selectedNode = node.id;

        if(node._nodeType != ""){
          problemName = node._nodeType.charAt(0).toUpperCase() + node._nodeType.slice(1);
          swal("Let's start this mission!",problemName+": "+node._properties.problem_points+" problem points.");
        }else{
          swal("There's no mission here");
        }
        
      },
      fixNodes: true,
      fixRootNodes: true,  
      linkDistance: function(){ return 40; },
      nodeCaption: function(node){ 
        if(node.caption > 0){
          return node.caption;
        }else{
          return "";
        }  
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
