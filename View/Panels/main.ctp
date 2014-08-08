<?php
	echo $this->Html->css(array('evoke-new','panels-new'));
?>

<div class="sticky">
	<nav class="top-bar" data-topbar data-options="sticky_on: large">
	  <ul class="title-area">
	    <li class="name">
	      <h1><a href="#">My Site</a></h1>
	    </li>
	     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
	    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	  </ul>

	  <section class="top-bar-section">
	    <!-- Right Nav Section -->
	    <ul class="right">
	      <li class="active"><a href="#">Right Button Active</a></li>
	      <li class="has-dropdown">
	        <a href="#">Right Button Dropdown</a>
	        <ul class="dropdown">
	          <li><a href="#">First link in dropdown</a></li>
	        </ul>
	      </li>
	    </ul>

	    <!-- Left Nav Section -->
	    <ul class="left">
	      <li><a href="#">Left Nav Button</a></li>
	    </ul>
	  </section>
	</nav>
</div>

<div class="row">
  <div class="large-12 columns">

  	<h1 class = "text-align-center"><?= _('Choose an organization') ?></h1>

	<ul class="small-block-grid-3">
	 	<?php foreach($organizations as $o): ?>
	  		<li class = "text-align-center">
	  			<a href = "<?= $this->Html->url(array('controller' => 'panels', 'action' => 'dashboard', $o['Organization']['id'])) ?>">
	  				<i class="fa fa-university fa-5x"></i>
	  				<h2><?= $o['Organization']['name'] ?></h2>
	  			</a>
  			</li>
		<?php endforeach; ?>
	</ul>

  </div>
</div>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');
?>