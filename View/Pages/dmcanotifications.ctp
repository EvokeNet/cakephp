<?php
	echo $this->Html->css('users');
	echo $this->Html->css('evidences');

	//Facebook login URL comes from session
	$fbLoginUrl = $this->Session->read('fbLoginUrl');
	echo $this->element('topbar-login');
?>

<section class = "evoke login background">
	<div class="evoke row full-width">
	
	<?php if(is_null($userid)) :?>
		<div class="evoke small-7 medium-7 large-7 columns">
			<div class="evoke small-12 medium-12 large-12 columns">
		 		<div class = "evoke evidence-body view">
				<h3 class="text-center" style="color:black">DMCA Notification Guidelines</h3>
				
				<h4>A.    Notification of Infringement</h3>

				<h5>It is our policy to respond to clear notices of alleged copyright infringement that comply with the Digital Millennium Copyright Act.</h5>

				<h5>You may submit your Notification of Alleged Copyright Infringement using our <a href="#">automated form</a>, or by sending it to our Designated Agent by mail or e-mail as set forth below in Section C.</h5>

				<h5><a href="#" class="button">Submit DMCA Notice</a></h5>

				<h5>In addition, we will promptly terminate without notice the accounts of those determined by us to be "repeat infringers."  If you are a copyright owner or an agent thereof, and you believe that any content hosted on our web site infringes your copyrights, then you may submit a notification pursuant to the Digital Millennium Copyright Act ("DMCA") by providing the Copyright Agent with the following information in writing (please consult your legal counsel or See 17 U.S.C. Section 512(c)(3) to confirm these requirements): </h5>

				<h5>1.    A physical or electronic signature of a person authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</h5>

				<h5>2.    Identification of the copyrighted work claimed to have been infringed, or, if multiple copyrighted works on the Network are covered by a single notification, a representative list of such works at that site.</h5>

				<h5>3.    Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit our copyright agent to locate the material. <strong>Providing URLs in the body of an email is the best way to help us locate content quickly.</strong></h5>

				<h5>4.    Information reasonably sufficient to permit our copyright agent to contact the complaining party, such as an address, telephone number, and, if available, an electronic mail address at which the complaining party may be contacted.</h5>

				<h5>5.    A statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or the law.</h5>

				<h5>6.    A statement that the information in the notification is accurate, and under penalty of perjury, that the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</h5>

				<h5><strong>Please note that under Section 512(f) of the DMCA, any person who knowingly materially misrepresents that material or activity is infringing may be subject to liability.</strong></h5>

				<h5>Please note that our copyright agent will send a copy of such notices to both the individual that uploaded the allegedly infringing content and the creator of the social network where the content appears.</h5>

				<h4>B.    Counter-Notification</h4>

				<h5>If you elect to send us a counter notice, to be effective it must be a written communication that includes the following (please consult your legal counsel or See 17 U.S.C. Section 512(g)(3) to confirm these requirements):</h5>

				<h5>1.    A physical or electronic signature of the subscriber.</h5>

				<h5>2.    Identification of the material that has been removed or to which access has been disabled and the location at which the material appeared before it was removed or access to it was disabled.</h5>

				<h5>3.    A statement under penalty of perjury that the subscriber has a good faith belief that the material was removed or disabled as a result of mistake or misidentification of the material to be removed or disabled.</h5>

				<h5>4.    The subscriber\'s name, address, and telephone number, and a statement that the subscriber consents to the jurisdiction of Federal District Court for the judicial district in which the address is located, or if the subscriber\'s address is outside of the United States, for any judicial district in which our copyright agent may be found, and that the subscriber will accept service of process from the person who provided notification under subsection (c)(1)(C) or an agent of such person.</h5>

				<h5><strong>Please note that under Section 512(f) of the DMCA, any person who knowingly materially misrepresents that material or activity was removed or disabled by mistake or misidentification may be subject to liability.</strong></h5>

				<h5>Our copyright agent only accepts counter-notices that meet the requirements set forth above and are received from the email address associated with the our copyright agent account you used to upload the content within 7 business days of our forwarding you the DMCA notice. You may submit your Counter Notification by sending it to our Designated Agent by mail or e-mail as set forth below in Section C.</h5>

				<h4>C.    Designated Copyright Agent</h4>

				<h5>The Designated Copyright Agent to receive notifications and counter-notifications of claimed infringement can be reached as follows: </h5>

				<h5>Copyright Agent<br>
				c/o Ning<br>
				2000 Sierra Point Parkway<br>
				Suite 1000<br>
				Brisbane, CA 94005</h5>

				<h5>Or, <a href="mailto:copyright@ning.com">via email</a>.</h5>

				<h5>For clarity, only DMCA notices should go to the Designated Copyright Agent. Any other communications related to the Network should be directed to the Network Creator. You acknowledge that if you fail to comply with all of the requirements of this section, your DMCA notice may not be valid.</h5>
				</div>
				
			</div>
			
		</div>

		<div id="" class="loginpanel small-5 medium-5 large-5 columns">
			<img src = '<?= $this->webroot.'img/evoke-69.png' ?>' alt = "" class = "evoke login padding-bottom">
			
			<div id = "login-columns">
				<h4><?php echo __('Evoke Panel Login'); ?></h4>

				<div class = "evoke login top-border">
					<h5><?php echo __('Sign up');?></h5>

					<a href="<?php echo $fbLoginUrl; ?>" class="evoke login button facebook"><i class="fa fa-facebook fa-2x"></i>&nbsp;&nbsp;&nbsp;<?php echo __('Sign in with Facebook');?></a>
					<!-- <a href="<?php echo $this->Html->url(array('action' => 'google_login')); ?>" class="evoke login button google"><img src = '<?= $this->webroot.'img/evoke_g-login.png' ?>' alt = "">&nbsp;&nbsp;&nbsp;<?php echo __('Sign in with Google');?></a> -->
					<a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register'));?>" class="evoke login button signup"><img src = '<?= $this->webroot.'img/evoke_e-login.png' ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('Create EVOKE account');?></a>

					<!-- <a href="#" class="evoke login button signup" data-reveal-id="myModal" data-reveal><img src = '<?= $this->webroot.'img/evoke_e-login.png' ?>'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('Create EVOKE account');?></a> -->
				</div>
				<!-- <i class="fa fa-google-plus fa-2x" style = "position: absolute; top: 10px; left: 20px;"></i> -->
				<div class="evoke login users form top-border bottom-border">
					<?php echo $this->Session->flash('auth'); ?>
					<?php echo $this->Form->create('User', array(
	 						   		'url' => array(
	 						   			'controller' => 'users',
	 						   			'action' => 'login')
									));  ?>
							<!-- <legend><?php echo __('Please enter your username and password'); ?></legend> -->
							<h5><?php echo __('Sign in');?></h5>
							<?php 
								echo $this->Form->input('username', array('label' => false));
								echo $this->Form->input('password', array('label' => false));
							?>
						<button class="evoke button general" type="submit">
							<?php echo __('Sign in'); ?>
						</button>
						<a href = "" class = "evoke login password"><?php echo __('Forgot your password?');?></a>
						<?php echo $this->Form->end(); ?>
				</div>
			</div>

		</div>
	<?php else :?>
		<div class="evoke small-12 medium-12 large-12 columns">
			<div class = "evoke evidence-body view">
				<h3 class="text-center" style="color:black">DMCA Notification Guidelines</h3>
				
				<h4>A.    Notification of Infringement</h3>

				<h5>It is our policy to respond to clear notices of alleged copyright infringement that comply with the Digital Millennium Copyright Act.</h5>

				<h5>You may submit your Notification of Alleged Copyright Infringement using our <a href="#">automated form</a>, or by sending it to our Designated Agent by mail or e-mail as set forth below in Section C.</h5>

				<h5><a href="#" class="button">Submit DMCA Notice</a></h5>

				<h5>In addition, we will promptly terminate without notice the accounts of those determined by us to be "repeat infringers."  If you are a copyright owner or an agent thereof, and you believe that any content hosted on our web site infringes your copyrights, then you may submit a notification pursuant to the Digital Millennium Copyright Act ("DMCA") by providing the Copyright Agent with the following information in writing (please consult your legal counsel or See 17 U.S.C. Section 512(c)(3) to confirm these requirements): </h5>

				<h5>1.    A physical or electronic signature of a person authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</h5>

				<h5>2.    Identification of the copyrighted work claimed to have been infringed, or, if multiple copyrighted works on the Network are covered by a single notification, a representative list of such works at that site.</h5>

				<h5>3.    Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit our copyright agent to locate the material. <strong>Providing URLs in the body of an email is the best way to help us locate content quickly.</strong></h5>

				<h5>4.    Information reasonably sufficient to permit our copyright agent to contact the complaining party, such as an address, telephone number, and, if available, an electronic mail address at which the complaining party may be contacted.</h5>

				<h5>5.    A statement that the complaining party has a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or the law.</h5>

				<h5>6.    A statement that the information in the notification is accurate, and under penalty of perjury, that the complaining party is authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.</h5>

				<h5><strong>Please note that under Section 512(f) of the DMCA, any person who knowingly materially misrepresents that material or activity is infringing may be subject to liability.</strong></h5>

				<h5>Please note that our copyright agent will send a copy of such notices to both the individual that uploaded the allegedly infringing content and the creator of the social network where the content appears.</h5>

				<h4>B.    Counter-Notification</h4>

				<h5>If you elect to send us a counter notice, to be effective it must be a written communication that includes the following (please consult your legal counsel or See 17 U.S.C. Section 512(g)(3) to confirm these requirements):</h5>

				<h5>1.    A physical or electronic signature of the subscriber.</h5>

				<h5>2.    Identification of the material that has been removed or to which access has been disabled and the location at which the material appeared before it was removed or access to it was disabled.</h5>

				<h5>3.    A statement under penalty of perjury that the subscriber has a good faith belief that the material was removed or disabled as a result of mistake or misidentification of the material to be removed or disabled.</h5>

				<h5>4.    The subscriber\'s name, address, and telephone number, and a statement that the subscriber consents to the jurisdiction of Federal District Court for the judicial district in which the address is located, or if the subscriber\'s address is outside of the United States, for any judicial district in which our copyright agent may be found, and that the subscriber will accept service of process from the person who provided notification under subsection (c)(1)(C) or an agent of such person.</h5>

				<h5><strong>Please note that under Section 512(f) of the DMCA, any person who knowingly materially misrepresents that material or activity was removed or disabled by mistake or misidentification may be subject to liability.</strong></h5>

				<h5>Our copyright agent only accepts counter-notices that meet the requirements set forth above and are received from the email address associated with the our copyright agent account you used to upload the content within 7 business days of our forwarding you the DMCA notice. You may submit your Counter Notification by sending it to our Designated Agent by mail or e-mail as set forth below in Section C.</h5>

				<h4>C.    Designated Copyright Agent</h4>

				<h5>The Designated Copyright Agent to receive notifications and counter-notifications of claimed infringement can be reached as follows: </h5>

				<h5>Copyright Agent<br>
				c/o Ning<br>
				2000 Sierra Point Parkway<br>
				Suite 1000<br>
				Brisbane, CA 94005</h5>

				<h5>Or, <a href="mailto:copyright@ning.com">via email</a>.</h5>

				<h5>For clarity, only DMCA notices should go to the Designated Copyright Agent. Any other communications related to the Network should be directed to the Network Creator. You acknowledge that if you fail to comply with all of the requirements of this section, your DMCA notice may not be valid.</h5>
			</div>
			
		</div>
	<?php endif?>
	</div>
</section>

<div id="myModal" class="reveal-modal tiny evoke login-lightbox" data-reveal>
	<h2><?= __('Evoke Registration') ?></h2>
	<?php echo $this->Form->create('User'); ?>
	<?php
		echo $this->Form->input('name', array('required' => true, 'label' => __('Name')));
		echo $this->Form->input('username', array('required' => true, 'label' => __('Username')));
		echo $this->Form->input('email', array('type' => 'email', 'required' => true));
		echo $this->Form->input('password', array('required' => true, 'label' => __('Password')));
	?>
	<?php //echo $this->Form->end(__('Submit')); ?>
	<button class="evoke button general" type="submit"><?php echo __('Register') ?></button>
	<!-- <img src = '<?= $this->webroot.'img/chiptag.png' ?>'> -->
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php 
	echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false));
	//echo $this->Html->script('/components/foundation/js/foundation.min.js');
	//echo $this->Html->script('/components/foundation/js/foundation.min.js', array('inline' => false));
	echo $this->Html->script("https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js", array('inline' => false));
?>