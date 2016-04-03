<?php echo $this->element('topbar'); echo $this->Html->script("/webroot/components/sigma/build/sigma.min.js");?>

<!-- START SIGMA IMPORTS -->

<!-- END SIGMA IMPORTS -->
<style type="text/css">
    body {
      margin: 0;
    }
    #container {
      position: absolute;
      width: 100%;
      height: 100%;
    }
  </style>
<div id="container">
</div>

<script>
    // Let's first initialize sigma:
    var s = new sigma({
        container: 'container',
        immutable: true,
        zoomMin: 1,
        zoommax: 1
    });

    // Then, let's add some data to display:
    s.graph.addNode({
      // Main attributes:
      id: 'n0',
      label: 'Hello',
      // Display attributes:
      x: 0,
      y: 0,
      size: 1,
      color: '#f00'
    }).addNode({
      // Main attributes:
      id: 'n1',
      label: 'World !',
      // Display attributes:
      x: 1,
      y: 1,
      size: 1,
      color: '#00f'
    }).addEdge({
      id: 'e0',
      // Reference extremities:
      source: 'n0',
      target: 'n1'
    });

    // Finally, let's ask our sigma instance to refresh:
    s.refresh();
  </script>
