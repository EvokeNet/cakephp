<?php
	
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div class="evoke default row full-width-alternate">

		<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
		</div>	

	 	<div class="small-10 medium-10 large-10 columns margin top-2 maincolumn body-padding">
			
			<h3 class = "margin bottom-1"> <?= strtoupper(__('Notifications')) ?> </h3>

			<div class = "evoke black-bg badges-bg">

				<?php
					$date = '';
					foreach($notifications as $n):
						if($date != date('j-n-Y', strtotime($n['Notification']['modified']))):
							$date = date('j-n-Y', strtotime($n['Notification']['modified'])); ?>
							<h2 class = "white margin top" style = "margin-left:0.5em"><?= $date ?></h2>
					<?php 
						endif; 
						echo $this->element('notification_box', array('n' => $n, 'user' => $user)); 
						$lastNotification = $n['Notification']['id'];
					endforeach;
				?>
				<meta name = "lastNotification" content = "<?php echo $lastNotification; ?>">
				<div id="target"></div>
			</div>

		</div>

		<!-- <div class="medium-1 end columns"></div> -->

	</div>

</section>

<?php
	// echo $this->Html->scriptBlock("var userId = '" . json_encode($user['User']['id']) . "'", array('inline' => true));
	echo $this->Html->script('/components/jquery/jquery.min.js');
	echo $this->Html->script('more_notifications');
	echo $this->Html->script('menu_height');
?>