<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<!-- <h1><?php echo $user['User']['name']; ?></h1> -->
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<!-- <li><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></li> -->
					<li><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<!-- <li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?></li> -->
		</ul>
	</section>
</nav>

<?php $this->end(); ?>


<section class="margin top">
	<div class="row full-width">

		<aside>
			<div class="small-2 medium-2 large-2 columns toolbar">
				<h6 class="subheader"><?php echo __('MEMBERS'); ?></h6>
				<ul class="no-bullet">
					<?php foreach ($users as $usr): ?>
						<?php if ($usr['User']['facebook_id']): ?>
							
							<div class="image circle">
								<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $usr['User']['id'])) ?>">
									<img src="https://graph.facebook.com/<?php echo $usr['User']['facebook_id']; ?>/picture?type=large" />
								</a>
							</div>
							
						<?php endif ?>
						<li><?php $test = explode(' ', $usr['User']['name']); echo $test[0]; ?></li>
					<?php endforeach ?>

					<?php if ($user['User']['facebook_id']): ?>
							
						<div class="image circle">
							<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])) ?>">
								<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" />
							</a>
						</div>
							
					<?php endif ?>
					<li><?php $test = explode(' ', $user['User']['name']); echo $test[0]; ?></li>

				</ul>


				<H6 class="subheader"><?php echo __('ACTIONS'); ?></H6>
				<button class="button expand" id="evokation_draft_button"><?php echo __('Publish to Network'); ?></button>
				<button class="button expand disabled"><?php echo __('Send Final Evokation'); ?></button>

				<h6 class="subheader"><?php echo __('EVOKATION PARTS'); ?></h6>
				<ul class="no-bullet">
					<li><a href="#">Document</a></li>
					<li><a href="#">Document</a></li>
					<li><a href="#">Document</a></li>
					<li><a href="#">Document</a></li>
				</ul>

			</div>
		</aside>


		<div class="small-8 medium-8 large-8 columns">
			<h1 class="typeface strong" id="groupname"><small><?php echo __('Group'); ?> </small><?php echo $group['Group']['title']; ?></h1>

			<!-- The Evokation project, with data from de DB and from Google Drive -->
			<?php
				// The field Evokation.id will exist after the project is created
				echo $this->Form->input('Evokation.id', array(
					'id' => 'evokation_id'
				));
				echo $this->Form->input('Group.id', array(
					'id' => 'evokation_group',
					'value' => $group['Group']['id']
				));
				echo $this->Form->input('Evokation.title', array(
					'label' => '',
					'id' => 'evokation_title',
					'placeholder' => __('Your Evokation title')
				));
				echo $this->Form->input('Evokation.abstract', array(
					'label' => '',
					'id' => 'evokation_abstract',
					'placeholder' => __('Your Evokation abstract')
				));
			 ?>

			<div id="evokation_div" class="project page" data-placeholder=""></div>
			
		</div>

		<aside>
			<div class="small-2 medium-2 large-2 columns chat">				
				<h6 class="subheader"><?php echo __('CHAT'); ?></h6>
				<!-- CHAT GOES HERE -->
			</div>
		</aside>
	</div>
</section>

<meta name="padID" content="<?php echo $padID; ?>">

<?php echo $this->Html->script('/components/etherpad/js/etherpad.js', array('inline' => false)); ?>
<?php echo $this->Html->script('evokation', array('inline' => false)); ?>