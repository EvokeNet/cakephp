<div class="evoke contain-to-grid top-bar-background">
  <nav class="top-bar row full-width-alternate" data-topbar>
    <ul class="title-area">
	    <li class="name padding top-03">
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
						<?php $pic = $this->webroot.'img/user_avatar.jpg';?>
					<?php else : ?>							
						<?php $pic = "https://graph.facebook.com/". $user['User']['facebook_id'] ."/picture?type=large";?>
					<?php endif; ?>					
	  			<?php else : ?>	  				
					<?php $pic = $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'];?>
	  			<?php endif; ?>		
	  			
	  			<!-- <div class = "evoke top-bar icon" style="background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto;">
	  			</div> -->
	  			<div class="left" style="min-width: 2vw; max-width: 2vw; min-height: 2vw; background-image: url(<?=$pic?>); background-position:center; background-size: 100% Auto; margin-top: 0.2vw;"></div>
	  			<!-- <img src="<?=$pic?>" class = "evoke top-bar icon" /> -->
	      	</a>
      	  </li>

	      <li class="active" id = "top-bar-name">
	      	<!-- <a href="#">Right Button Active</a> -->

	      	<?php if(isset($user['User'])) :?>
	      		<?php $name = split(" ", $user['User']['name']);?>
				<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'profile', $user['User']['id'])); ?>"><span><?= $name[0] ?></span></a>
			<?php else :?>
				<a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>"><span><?= __('Unidentified Agent, please login') ?></span></a>
			<?php endif; ?>

      	  </li>
	      
	      <li class="evoke divider"></li>

	      <li class="active"><a href="#"><?= __('Level') ?>&nbsp;&nbsp;&nbsp;<span><?= $userLevel ?></span></a></li>
	      
	      <li class="evoke divider"></li>

	      <li class="active">
	      	<a href="#">
				<div class="evoke top-bar progress small-9 large-9 round">
				  <span class="meter" style="width: <?= $userLevelPercentage ?>%"></span>
				</div>
			</a>
		  </li>

		  <li class="evoke divider"></li>

	      <li class="active"><a href="#"><?= __('Points') ?>&nbsp;&nbsp;&nbsp;<span><?= $userPoints ?></span></a></li>

	      <li class="evoke divider"></li>

	      <li class="has-dropdown">
	        <a href="#"><?= __('Language') ?></a>
	        <ul class="dropdown">
	          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?= __('English') ?></a></li>
	          <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?= __('Spanish') ?></a></li>
	        </ul>
	      </li>
	      
	      <li class="evoke divider"></li>

	      <li class="has-dropdown">
	        <a href="#"><i class="fa fa-cog fa-lg"></i></a>
	        <ul class="dropdown">
	          	<?php if(isset($user['User'])) :?>
					<li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'edit', $user['User']['id'])) ?>"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;<?= __('Edit information') ?></a></li>
					<li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'changePassword')) ?>"><i class="fa fa-asterisk"></i>&nbsp;&nbsp;&nbsp;<?= __('Change password') ?></a></li>
	          		<li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'logout')) ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;<?= __('Sign Out') ?></a></li>
				<?php else :?>
					 <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'login')) ?>"><?= __('Log in') ?></a></li>
				<?php endif; ?>

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