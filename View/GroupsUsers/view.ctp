<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">Agent <?php //echo explode(' ', $this->Session->read('Auth.User.User.name'))[0]; ?></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<li><a href="<?php echo $this->Html->url(array('action' => 'logout')); ?>">Sign out</a></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><a href="#">Dashboard</a></li>
		</ul>
	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke margin top">
	<div class="row full-width">
		<aside>
			<div class="large-2 columns evoke chat">
				<h6 class="subheader"><?php echo __('ASSETS'); ?></h6>
				
				<!-- Here are the related resources, limited to 4 -->
				<dl class="accordion evoke margin top bottom" data-accordion>
					<dd>
						<a href="#panel1">Accordion 1</a>
						<div id="panel1" class="content active">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex.
							</p>
						</div>
					</dd>
					<dd>
						<a href="#panel2">Accordion 2</a>
						<div id="panel2" class="content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex.
						</div>
					</dd>
					<dd>
						<a href="#panel3">Accordion 2</a>
						<div id="panel3" class="content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex.
						</div>
					</dd>
				</dl>

				<button class="button expand"><?php echo __('Edit project info'); ?></button>

				<h6 class="subheader"><?php echo __('CHAT'); ?></h6>
			</div>
		</aside>

		<div class="large-8 columns evoke">
			<h1 class="evoke typeface strong"><small><?php echo __('Group'); ?> </small><?php echo $group['Group']['title']; ?></h1>

			<!-- THE EVOKATION PAGE -->
			<div id="evokation" class="evoke project page" contenteditable="true">

			</div>


		</div>

		<aside>
			<div class="large-2 columns evoke toolbar">
				<h6 class="subheader"><?php echo __('MEMBERS'); ?></h6>
				<ul class="no-bullet">
					<?php foreach ($group['User'] as $user): ?>
						<li><?php echo $user['name']; ?></li>
					<?php endforeach ?>
				</ul>

				<button class="button expand"><?php echo __('Save Evokation Draft'); ?></button>
				<button class="button expand disabled"><?php echo __('Send Final Evokation'); ?></button>

				<h6 class="subheader"><?php echo __('RELATED DOCUMENTS'); ?></h6>
				<ul class="no-bullet">
					<li><a href="#">Document</a></li>
					<li><a href="#">Document</a></li>
					<li><a href="#">Document</a></li>
					<li><a href="#">Document</a></li>
				</ul>

				<h6 class="subheader"><?php echo __('CALENDAR'); ?></h6>
				<ul class="no-bullet">
					<li><a href="#">Event</a></li>
					<li><a href="#">Event</a></li>
					<li><a href="#">Event</a></li>
					<li><a href="#">Event</a></li>
				</ul>

			</div>
		</aside>
	</div>
</section>

<?php echo $this->Html->script('/components/ckeditor/ckeditor'); ?>
<?php echo $this->Html->script('evokation'); ?>