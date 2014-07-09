<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<div class="evoke panels contain-to-grid top-bar-background panels-bg">
  <nav class="top-bar row full-width-alternate margin top-05" data-topbar>
    <ul class="title-area">
	    <li class="name">
	      <h1><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $user['User']['id'])); ?>"><?= ('Evoke') ?></a></h1>
	    </li>
	     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
	    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
	  </ul>

	  <section class="top-bar-section">
	    <!-- Right Nav Section -->
	    <ul class="right top-bar-background">

	      <li class="active">
	      	<a href="#">
	      		<?php if($user['User']['photo_attachment'] == null) : ?>
					<?php if($user['User']['facebook_id'] == null) : ?>
						<img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"   class = "evoke top-bar icon"/>
					<?php else : ?>	
						<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
					<?php endif; ?>
					
	  			<?php else : ?>
	  				<img src="<?= $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
	  			<?php endif; ?>		
	      	</a>
      	  </li>

	     <!--  <li class="active" id = "top-bar-name">

	      	<?php if(isset($user['User'])) :?>
				<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'profile', $user['User']['id'])); ?>"><span><?= $user['User']['name'] ?></span></a>
			<?php else :?>
				<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>"><span><?= __('Unidentified Agent, please login') ?></span></a>
			<?php endif; ?>

      	  </li> -->

	      <li class="has-dropdown">
	        <a href="#">
	        	<?php if(isset($user['User'])) :?>
					<span><?= $user['User']['name'] ?></span>
				<?php else :?>
					<span><?= __('Unidentified Agent, please login') ?></span>
				<?php endif; ?>
	        </a>
	        <ul class="dropdown">
	          	<?php if(isset($user['User'])) :?>
					<li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $user['User']['id'])) ?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<?= __('See profile') ?></a></li>
	          		<li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'logout')) ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;<?= __('Sign Out') ?></a></li>
				<?php else :?>
					 <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'login')) ?>"><?= __('Log in') ?></a></li>
				<?php endif; ?>

	        </ul>
	      </li>

	      <li class="evoke divider"></li>

	      <li class="has-dropdown">
	        <a href="#"><?= __('Language') ?></a>
	        <ul class="dropdown">
	          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?= __('English') ?></a></li>
	          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?= __('Spanish') ?></a></li>
	        </ul>
	      </li>

	    </ul>

	    <!-- Left Nav Section -->
	    <!-- <ul class="left">
	      <li><a href="#">Left Nav Button</a></li>
	    </ul> -->
	  </section>
  </nav>
</div>

<?php $this->end(); ?>

<section class="evoke margin top-2">
	<div class="row evoke max-width">
		<div class="small-12 medium-12 large-12 columns">
			<!-- <h1><?= __('Creating Mission')?><?php if(isset($id) && !is_null($id)) : echo ': ' . $mission['Mission']['title']; endif;?></h1> -->
			
			<div class="table-bordered form">

				<?php 
					echo $this->Form->create('Mission', array(
						   	'url' => array(
						   		'controller' => 'panels',
						   		'action' => 'add_mission'
							),
							'enctype' => 'multipart/form-data'
					));
					 
				?>
				
				<?php
					
					echo __('Add a Mission'); 
					echo $this->Form->input('Mission.title.eng', array('label' => __('Title'), 'required' => true));
					echo $this->Form->input('Mission.title.spa', array('label' => __('Spanish Title')));
					//echo $this->Form->input('title_es', array('label' => __('Spanish Title')));
					echo $this->Form->input('Mission.description.eng', array('label' => __('Description'), 'required' => true));
					echo $this->Form->input('Mission.description.spa', array('label' => __('Spanish Description')));
					//echo $this->Form->input('description_es', array('label' => __('Spanish Description')));
					echo $this->Form->input('video_link', array('label' => __('Video Link')));
					echo $this->Form->input('video_link_es', array('label' => __('Spanish Video Link')));
					echo $this->Form->radio('basic_training', array(0 => 'No', 1=>'Yes'), array('required' => true, 'default'=> 0));
					if(!is_null($mission['Mission']['image_dir'])) :
						echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$mission['Mission']['image_dir'].'/thumb_'.$mission['Mission']['image_attachment'] . '"/>';
						echo '<div class="input file"><label for="AttachmentImgAttachment">Change Image</label><input type="file" name="data[Attachment][Img][attachment]" id="AttachmentImgAttachment"></div>';
					else :
						echo '<div class="input file"><label for="AttachmentImgAttachment">Image</label><input type="file" name="data[Attachment][Img][attachment]" id="AttachmentImgAttachment"></div>';
					endif;
					if(!is_null($mission['Mission']['cover_dir'])) :
						echo '<img src="' . $this->webroot.'files/attachment/attachment/'.$mission['Mission']['cover_dir'].'/thumb_'.$mission['Mission']['cover_attachment'] . '"/>';
						echo '<div class="input file"><label for="AttachmentCoverAttachment">Change Cover</label><input type="file" name="data[Attachment][Cover][attachment]" id="AttachmentCoverAttachment"></div>';
					else :
						echo '<div class="input file"><label for="AttachmentCoverAttachment">Cover</label><input type="file" name="data[Attachment][Cover][attachment]" id="AttachmentCoverAttachment"></div>';
					endif;
					echo $this->Form->hidden('form_type', array('value' => 'mission'));
					echo $this->Form->input('MissionIssue.issue_id', array(
						'options' => $issues
					));
					echo $this->Form->input('organization_id', array(
							'label' => __('Created by'),
							'options' => $organizations
					));
				?>
				
				<button class="button small" type="submit">
					<?php echo __('Save and continue') ?>
				</button>
				<?php echo $this->Form->end(); ?>
			</div>
			
			<!-- encerrar tudo -->
			<?php 
				if((empty($phases) || is_null($phases)) && isset($id) && !is_null($id)):?>
					<button class="button small" href="#" data-reveal-id="myModalExit" data-reveal><?php echo __('Return to Admin Panel');?></button>
					<div id="myModalExit" class="reveal-modal tiny" data-reveal>
						<h4><?= __('Are you sure you want to exit to Admin Panel?') ?></h4>
						<p><?= __('Your mission has no Phase and, therefore, will not be displayed to other agents. Please add a Phase to your mission!') ?></p>
						<br><br>
						<?= $this->Html->Link(__('Stay in this page'), array('controller' => 'panels', 'action' => 'add_mission', $id), array( 'class' => 'button small')); ?>
						<?= $this->Html->Link(__('Exit anyway'), array('controller' => 'panels', 'action' => 'index', 'missions'), array( 'class' => 'button small alert')); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				<?php else :
					echo $this->Html->Link(__('Return to Admin Panel'), array('controller' => 'panels', 'action' => 'index', 'missions'), array( 'class' => 'button small')); 
				endif; ?>
		</div>
	</div>
</section>
<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
?>