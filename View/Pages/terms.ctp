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
				<h3 class="text-center" style="color:black">Terms of Service</h3>
				<h5>The following Terms of Service apply to your use of this Network.  You are solely responsible for your conduct and your content on the Network and compliance with these terms.  By registering with us or using or browsing this Network, you acknowledge that you have read, understood, and agree to be bound by these terms. This Network is not directed to anyone younger than 13 and is offered only to users 13 years of age or older. Any person who provides their personal information through this Network represents that they are 13 years of age or older.</h5>
				<h5>You agree that you will not post, email or make available any content or use this Network:</h5>
				<ul><li>In a manner that infringes, violates or misappropriates any third party's intellectual property rights or other proprietary rights or contractual rights; </li>
				<li>in a manner that contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or hardware or telecommunications equipment; </li>
				<li>to engage in spamming, "chain letters," "pyramid schemes", advertisement of illegal or controlled products or services, or other advertising or marketing activities that violate these Terms of Service, any applicable laws, regulations or generally-accepted advertising industry guidelines; </li>
				<li>in a manner that is misleading, deceptive or fraudulent or otherwise illegal or promotes illegal activities, including engaging in phishing or otherwise obtaining financial or other personal information in a misleading manner or for fraudulent or misleading purposes; </li>
				<li>in a manner that is libelous or defamatory, or in a way that is otherwise threatening, abusive, violent, harassing, malicious or harmful to any person or entity, or invasive of another's privacy; </li><li>in a manner that is harmful to minors in any way; </li>
				<li>in a manner that is hateful or discriminatory based on race, color, sex, religion, nationality, ethnic or national origin, marital status, disability, sexual orientation or age or is otherwise objectionable; </li>
				<li>to impersonate any other person, or falsely state or otherwise misrepresent your affiliation with any person or entity, or to obtain access to this Network without authorization; </li>
				<li>to interfere or attempt to interfere with the proper working of this Network or prevent others from using this Network, or in a manner that disrupts the normal flow of dialogue with an excessive number of messages (flooding attack) to this Network, or that otherwise negatively affects other persons' ability to use this Network; </li>
				<li>to use any manual or automated means, including agents, robots, scripts, or spiders, to access or manage any user's account or to monitor or copy this Network or the content contained therein; </li><li>to facilitate the unlawful distribution of copyrighted content; </li>
				<li>in a manner that includes personal or identifying information about another person without that person's explicit consent; </li>
				<li>in a manner that employs misleading email or IP addresses, or forged headers or otherwise manipulated identifiers in order to disguise the origin of content transmitted through this Network or to users; and </li>
				<li>in a manner that constitutes or contains any form of advertising or solicitation if  emailed to users who have requested not to be contacted about other services, products or commercial interests. </li>
				<h5>Additionally, you agree not to:</h5><li>"Stalk" or otherwise harass anyone; </li>
				<li>Collect, use or disclose data, including personal information, about other users without their consent or for unlawful purposes or in violation of applicable law or regulations; </li>
				<li>Request, solicit or otherwise obtain access to usernames, passwords or other authentication credentials from any member of this Network or to proxy authentication credentials for any member of this Network for the purposes of automating logins to this Network; </li>
				<li>Post any content containing child pornography to this Network; </li>
				<li>Post any content that depicts or contains rape, extreme violence, murder, bestiality, incest, or other similar content; </li>
				<li>Post any content that constitutes pornography, contains nudity, or is adult in nature. </li>
				<li>Use automated means, including spiders, robots, crawlers, data mining tools, or the like to download data from this Network - except for Internet search engines (e.g. Google) and non-commercial public archives (e.g. archive.org) that comply with our robots.txt file, or "well-behaved" web services/RSS/Atom clients. We reserve the right to define what we mean by "well-behaved"; </li>
				<li>Post irrelevant content, repeatedly post the same or similar content or otherwise impose an unreasonable or disproportionately large load on the Network's infrastructure; </li>
				<li>Attempt to gain unauthorized access to our computer systems or engage in any activity that disrupts, diminishes the quality of, interferes with the performance of, or impairs the functionality of, this Network; </li>
				<li>Use this Network as a generic file hosting service;</li>
				<li>Take any action that may undermine the feedback or ratings systems (such as displaying, importing or exporting feedback information off of this Network or for using it for purposes unrelated to this Network); and</li>
				<li>Develop, invoke, or utilize any code to disrupt, diminish the quality of, interfere with the performance of, or impair the functionality of this Network.</li></ul>

				<h5>To provide notice of alleged copyright infringement on this Network, please see the <a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'dmcanotifications'));?>">DMCA Notification Guidelines</a>.</h5>
				<h5>You agree not to authorize or encourage any third party to use this Network to facilitate any of the foregoing prohibited conduct. You also agree that these Network Terms of Service inure to the benefit of our service providers (including our Network platform provider) and that they may take action (including the removal of your content and disabling of your account) in order to maintain compliance with these Network Terms of Service. Technology and hosting for aspects of this Network are provided by this Network's online service provider. However, the Network Creator of this Network controls the content, membership and policy of this Network, including those pages served by such service provider on behalf of this Network. Notwithstanding anything to the contrary, by participating on this Network you agree to indemnify and hold harmless such service provider on all matters related to your interaction with others using this Network and participation with this Network. </h5>
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
				<h3 class="text-center" style="color:black">Terms of Service</h3>
				<h5>The following Terms of Service apply to your use of this Network.  You are solely responsible for your conduct and your content on the Network and compliance with these terms.  By registering with us or using or browsing this Network, you acknowledge that you have read, understood, and agree to be bound by these terms. This Network is not directed to anyone younger than 13 and is offered only to users 13 years of age or older. Any person who provides their personal information through this Network represents that they are 13 years of age or older.</h5>
				<h5>You agree that you will not post, email or make available any content or use this Network:</h5>
				<ul><li>In a manner that infringes, violates or misappropriates any third party's intellectual property rights or other proprietary rights or contractual rights;</li>
				<li>in a manner that contains software viruses or any other computer code, files or programs designed to interrupt, destroy or limit the functionality of any computer software or hardware or telecommunications equipment; </li>
				<li>to engage in spamming, "chain letters," "pyramid schemes", advertisement of illegal or controlled products or services, or other advertising or marketing activities that violate these Terms of Service, any applicable laws, regulations or generally-accepted advertising industry guidelines; </li>
				<li>in a manner that is misleading, deceptive or fraudulent or otherwise illegal or promotes illegal activities, including engaging in phishing or otherwise obtaining financial or other personal information in a misleading manner or for fraudulent or misleading purposes; </li>
				<li>in a manner that is libelous or defamatory, or in a way that is otherwise threatening, abusive, violent, harassing, malicious or harmful to any person or entity, or invasive of another's privacy; </li><li>in a manner that is harmful to minors in any way; </li>
				<li>in a manner that is hateful or discriminatory based on race, color, sex, religion, nationality, ethnic or national origin, marital status, disability, sexual orientation or age or is otherwise objectionable; </li>
				<li>to impersonate any other person, or falsely state or otherwise misrepresent your affiliation with any person or entity, or to obtain access to this Network without authorization; </li>
				<li>to interfere or attempt to interfere with the proper working of this Network or prevent others from using this Network, or in a manner that disrupts the normal flow of dialogue with an excessive number of messages (flooding attack) to this Network, or that otherwise negatively affects other persons' ability to use this Network; </li>
				<li>to use any manual or automated means, including agents, robots, scripts, or spiders, to access or manage any user's account or to monitor or copy this Network or the content contained therein; </li><li>to facilitate the unlawful distribution of copyrighted content; </li>
				<li>in a manner that includes personal or identifying information about another person without that person's explicit consent; </li>
				<li>in a manner that employs misleading email or IP addresses, or forged headers or otherwise manipulated identifiers in order to disguise the origin of content transmitted through this Network or to users; and </li>
				<li>in a manner that constitutes or contains any form of advertising or solicitation if  emailed to users who have requested not to be contacted about other services, products or commercial interests. </li>
				<h5>Additionally, you agree not to:</h5><li>"Stalk" or otherwise harass anyone; </li>
				<li>Collect, use or disclose data, including personal information, about other users without their consent or for unlawful purposes or in violation of applicable law or regulations; </li>
				<li>Request, solicit or otherwise obtain access to usernames, passwords or other authentication credentials from any member of this Network or to proxy authentication credentials for any member of this Network for the purposes of automating logins to this Network; </li>
				<li>Post any content containing child pornography to this Network; </li>
				<li>Post any content that depicts or contains rape, extreme violence, murder, bestiality, incest, or other similar content; </li>
				<li>Post any content that constitutes pornography, contains nudity, or is adult in nature. </li>
				<li>Use automated means, including spiders, robots, crawlers, data mining tools, or the like to download data from this Network - except for Internet search engines (e.g. Google) and non-commercial public archives (e.g. archive.org) that comply with our robots.txt file, or "well-behaved" web services/RSS/Atom clients. We reserve the right to define what we mean by "well-behaved"; </li>
				<li>Post irrelevant content, repeatedly post the same or similar content or otherwise impose an unreasonable or disproportionately large load on the Network's infrastructure; </li>
				<li>Attempt to gain unauthorized access to our computer systems or engage in any activity that disrupts, diminishes the quality of, interferes with the performance of, or impairs the functionality of, this Network; </li>
				<li>Use this Network as a generic file hosting service;</li>
				<li>Take any action that may undermine the feedback or ratings systems (such as displaying, importing or exporting feedback information off of this Network or for using it for purposes unrelated to this Network); and</li>
				<li>Develop, invoke, or utilize any code to disrupt, diminish the quality of, interfere with the performance of, or impair the functionality of this Network.</li></ul>

				<h5>To provide notice of alleged copyright infringement on this Network, please see the <a href="<?= $this->Html->url(array('controller' => 'pages', 'action' => 'dmcanotifications'));?>">DMCA Notification Guidelines</a>.</h5>
				<h5>You agree not to authorize or encourage any third party to use this Network to facilitate any of the foregoing prohibited conduct. You also agree that these Network Terms of Service inure to the benefit of our service providers (including our Network platform provider) and that they may take action (including the removal of your content and disabling of your account) in order to maintain compliance with these Network Terms of Service. Technology and hosting for aspects of this Network are provided by this Network's online service provider. However, the Network Creator of this Network controls the content, membership and policy of this Network, including those pages served by such service provider on behalf of this Network. Notwithstanding anything to the contrary, by participating on this Network you agree to indemnify and hold harmless such service provider on all matters related to your interaction with others using this Network and participation with this Network. </h5>
				
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