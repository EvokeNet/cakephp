<?php
	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke background-gray">

	<?= $this->element('menu', array('user' => $user)) ?>

	<div class = "evoke dashboard position">
		<?= $this->element('left_titlebar', array('title' => __("evokation's Development Area"))) ?>
	</div>

	<div class="row full-width">
		<div class="small-2 medium-2 large-2 columns">

			<ul class="no-bullet">
				<?php foreach ($users as $usr): ?>
					<div class="image circle">
						<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $usr['User']['id'])) ?>">
							<?php if($usr['User']['photo_attachment'] == null) : ?>
								<?php if($usr['User']['facebook_id'] == null) : ?>
									<img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"/>
								<?php else : ?>	
									<img src = "https://graph.facebook.com/<?php echo $usr['User']['facebook_id']; ?>/picture?type=large">
								<?php endif; ?>

							<?php else : ?>
								<img src="<?= $this->webroot.'files/attachment/attachment/'.$usr['User']['photo_dir'].'/'.$usr['User']['photo_attachment'] ?>" />
							<?php endif; ?>
						</a>
					</div>
						
					<li><?php $test = explode(' ', $usr['User']['name']); echo $test[0]; ?></li>
				<?php endforeach ?>

			</ul>


			<H6 class="subheader"><?php echo __('ACTIONS'); ?></H6>
			<button class="button general expand" id="evokation_draft_button" data-reveal-id="send" data-reveal><?php echo __('Publish to Network'); ?></button>
			<button class="button general expand" data-reveal-id="final" data-reveal><?php echo __('Send Final Evokation'); ?></button>

			<div class = "evoke position">
				<div class = "evoke titles-left">
					<div class = "evoke titles"><h4><?= strtoupper(__("Updates"));?></h4></div>
				</div>
			</div>
			
			<div id="send" class="reveal-modal tiny" data-reveal>
				<h1><?= __('Describe updates of this publishing:')?></h1>
				<?php 
					echo $this->Form->create('Update', array(
						'url' => array(
							'controller' => 'GroupsUsers',
							'action' => 'publish', 
							$evokation['Evokation']['id']
						)
					));

					if(!empty($lastUpdate)) {
						echo '<span>' . __('Last update: ') . $lastUpdate['EvokationsUpdate']['description'] . '</span>';
					}

					echo $this->Form->input('description');
				?>
				
				<button class="button tiny" type="submit">
					<?php echo __('Publish it')?>
				</button>
				<?php echo $this->Form->end(); ?>
				<a class="close-reveal-modal">&#215;</a>
			</div>

			<div id="final" class="reveal-modal tiny" data-reveal>
				<h1><?= __('Sending final evokation!')?></h1>
				<h4><?= __('Once the evokation is sent it will go to admin approval.')?></h4>
				<a class="button small" href="<?= $this->Html->url(array('controller' => 'GroupsUsers', 'action' => 'publishFinal', $evokation['Evokation']['id'])) ?>">
					<?php echo __('Publish final evokation')?>
				</a>
				<a class="close-reveal-modal">&#215;</a>
			</div>

		</div>
		<div class="small-8 medium-8 large-8 columns">
			
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

			<div id="evokation_div" data-placeholder=""></div>

		</div>
		<div class="small-2 medium-2 large-2 columns">

			<div class = "evoke position">
				<div class = "evoke titles-left">
					<div class = "evoke titles"><h4><?= strtoupper(__("Team"));?></h4></div>
				</div>
			</div>

			<div class = "evoke position">
				<div class = "evoke titles-left">
					<div class = "evoke titles"><h4><?= strtoupper(__("Documents"));?></h4></div>
					<ul class="no-bullet">
						<?php foreach ($evokationAttachments as $a) : ?>
							<?= $a['Attachment']['attachment'] ?>
						<?php endforeach ?>
					</ul>

				</div>
			</div>

			<div class = "evoke position">
				<div class = "evoke titles-left">
					<div class = "evoke titles"><h4><?= strtoupper(__("Deadlines"));?></h4></div>
				</div>
			</div>

			<!-- <div class = "evoke position">
				<div class = "evoke titles-left">
					<div class = "evoke titles"><h4><?= strtoupper(__("Chat"));?></h4></div>
				</div>
			</div> -->
		</div>
	</div>

</section>

<meta name="padID" content="<?php echo $padID; ?>">

<?php echo $this->Html->script('/components/jquery/jquery.min.js');//, array('inline' => false)); ?>
<?php echo $this->Html->script('/components/etherpad/js/etherpad.js', array('inline' => false)); ?>
<?php echo $this->Html->script('evokation', array('inline' => false)); ?>