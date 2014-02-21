<h1><?php echo __('Mission: '); echo h($mission['Mission']['title']); ?></h1>

<h2><?php echo __('Mission Brief'); ?></h2>
<h4><?php echo h($mission['Mission']['description']); ?></h4>

<h2><?php echo __('Quests: '); echo h($mission['Mission']['title']); ?></h2>

<?php foreach ($mission['Quest'] as $quest): ?>

	<div class = "missionblock"><a href="" data-reveal-id="<?= $quest['id'] ?>" data-reveal><?php echo $quest['title'];?></a></div>

	<div id="<?= $quest['id'] ?>" class="reveal-modal small" data-reveal>
	  <h2><?php echo $quest['title'];?></h2>
	  <p class="lead"><?php echo $quest['description'];?></p>
	  <!-- <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
	  <a class="close-reveal-modal">&#215;</a>
	</div>

<?php endforeach; ?>

<h2><?php echo __('Discussions: '); echo h($mission['Mission']['title']); ?></h2>

<dl class="tabs" data-tab>
  <dd class="active"><a href="#panel2-1"><?php echo __('Most Voted');?></a></dd>
  <dd><a href="#panel2-2"><?php echo __('Most Recent');?></a></dd>
</dl>
<div class="tabs-content">
  <div class="content active" id="panel2-1">
    <p>First panel content goes here...</p>
  </div>
  <div class="content" id="panel2-2">
    <?php foreach ($mission['Evidence'] as $evidence): ?>
		<h4><?php echo $this->Html->link(($evidence['title']), array('controller' => 'evidences', 'action' => 'view', $evidence['id'])); ?></h4>
	<?php endforeach; ?>
  </div>
</div>