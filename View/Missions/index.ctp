<?php
	//echo $this->Html->css('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->css('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->css('jcarousel');
	//echo $this->Html->css('/components/jcarousel/examples/responsive/jcarousel.responsive');

	echo $this->Html->css('/components/tinyscrollbar/examples/responsive/tinyscrollbar');

	echo $this->Html->css('breadcrumb');

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));

	$this->end(); 
?>

<section class="evoke default-background">
	<div class="evoke default row full-width-alternate">
	  <div class="small-12 small-centered columns">

	  	<h3 class = "evoke padding top-2"> <?= strtoupper(__('Choose a mission')) ?> </h3>
			
			<?php foreach($missions as $mission): ?>
				<div class = "evoke missions index">

					<img src = '<?= $this->webroot.'img/E01G01P02.jpg' ?>'>
				
				</div>
			<?php endforeach; ?>

		  	<!-- <div class = "issues">
				<?php foreach($issues as $i):?>

					<h1><?php echo __('Mission Under Issues: ').$i['Issue']['name'];?></h1>
					<?php foreach($missionIssues as $m):
					if($i['Issue']['id'] == $m['Issue']['id']):?>
						<h2><?php echo $this->Html->link($m['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $m['Mission']['id'], 1)); ?></h2>
						<p><?php echo $m['Mission']['description'];?></p>
						<hr class="sexy_line" />

				<?php endif; endforeach; endforeach; ?>
			</div> -->

		</div>
	</div>
</section>

<?php
	echo $this->Html->script('image_hover', array('inline' => false));
?>