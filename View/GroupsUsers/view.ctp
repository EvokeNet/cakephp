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

<!-- Medium Editor CSS -->
<?php echo $this->Html->css('/components/medium-editor/dist/css/medium-editor'); ?>
<?php echo $this->Html->css('/components/medium-editor/dist/css/themes/default'); ?>

<section class="evoke margin top">
	<div class="row full-width">
		<aside>
			<div class="large-2 columns evoke chat">
				<h6 class="subheader"><?php echo __('DOSSIER'); ?></h6>
				
				<!-- Here are the related resources, limited to 4 -->
				<dl class="accordion evoke margin top bottom" data-accordion>
					<dd>
						<a href="#panel1">Document 1</a>
						<div id="panel1" class="content active">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex.
							</p>
						</div>
					</dd>
					<dd>
						<a href="#panel2">Document 2</a>
						<div id="panel2" class="content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex.
						</div>
					</dd>
					<dd>
						<a href="#panel3">Document 3</a>
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

		<div class="large-8 columns">
			<h1 class="evoke typeface strong" id="groupname"><small><?php echo __('Group'); ?> </small><?php echo $group['Group']['title']; ?></h1>

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

			<textarea id="evokation_txt" class="hidden"></textarea>

			<div class="editor">

				<!-- Add images -->
				<a class="button circle bg-teal" id="add_image">
					<i class="fa fa-camera fa-2x"></i>
				</a>

				<!-- Add videos -->
				<a class="button circle bg-maroon" id="add_video" href="#">
					<i class="fa fa-youtube-play fa-2x"></i>
				</a>

				<!-- Add audio -->
				<a class="button circle bg-olive" id="add_audio" href="#">
					<i class="fa fa-music fa-2x"></i>
				</a>

				<div id="evokation_div" class="evoke project page" contenteditable="true" data-placeholder=" "></div>
			</div>
			
			<!--/ Evokation page -->

		</div>

		<aside>
			<div class="large-2 columns evoke toolbar">
				<h6 class="subheader"><?php echo __('MEMBERS'); ?></h6>
				<ul class="no-bullet">
					<?php foreach ($users as $user): ?>
						<li><?php echo $user['User']['name']; ?></li>
					<?php endforeach ?>
				</ul>

				<button class="button expand" id="evokation_draft_button"><?php echo __('Save Evokation Draft'); ?></button>
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

<script type="text/javascript">
	var WEBROOT  = <?php echo $this->webroot; ?>;
	var ACCESS_TOKEN = <?php echo $this->Session->read('access_token'); ?>;
	var CLIENT_ID = "<?php echo Configure::read('google_client_id'); ?>";
</script>
<?php if (!empty($this->request->data['Evokation'])): ?>
	<script type="text/javascript">
		var FILE_ID = "<?php echo $this->request->data['Evokation']['gdrive_file_id']; ?>";
	</script>
<?php else: ?>
	<script type="text/javascript">
		var FILE_ID = false;
	</script>
<?php endif; ?>

<?php echo $this->Html->script('/components/medium-editor/dist/js/medium-editor.min', array('inline' => false)); ?>
<?php echo $this->Html->script('/components/rangy/index.js', array('inline' => false)); ?>
<?php echo $this->Html->script('https://apis.google.com/js/api.js', array('inline' => false)); ?>
<?php echo $this->Html->script('evokation', array('inline' => false)); ?>