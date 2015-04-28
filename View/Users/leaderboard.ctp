<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => 'Leaderboard', 'imgSrc' => ($this->webroot.'img/header-leaderboard.jpg')));
	$this->end();
?>

<section class="leaderboard">	

	<?php echo $this->Session->flash(); ?>

	<div class="row standard-width">
		<div class="small-12 columns padding top-2">

			<!-- USER'S POSITION -->
			<div class="row margin">
				<!-- MEDAL WITH POSITION -->
				<div class="small-6 medium-4 columns text-right padding bottom-1 top-1">
					
					<span class="fa-stack fa-5x text-center icon-medal-stack margin right-05">
						<i class="fa fa-stack-2x icon-brankic icon-medal2 text-glow"></i>

						<i class="fa fa-circle fa-stack-1x text-color-dark"></i>

						<strong class="fa-stack-1x text-color-highlight medal-text"><?= $user_position['rank'] ?></strong>
					</span>
				</div>

				<!-- INFO -->
				<div class="small-6 medium-4 columns text-center padding left-2">
					<h2 class="text-color-highlight"><?= $user_position['name'] ?></h2>
					<h4><?= __('Points: ') ?><?= $user_position['total_points'] ?></h4>
					<h4><?= __('Level: ') ?><?= $user_position['level'] ?></h4>
				</div>

				<!-- GRAPH -->
				<div class="small-12 medium-4 columns text-left">
					<canvas id="performance-chart" width="400" height="200"></canvas>
				</div>
			</div>
		</div>

	
		<!-- LEADERBOARD -->
		<div class="small-12 columns">
			
			<!-- PAGINATION -->
			<div class="padding all-2 pagination-centered">
				<ul class="pagination">
					<?php
						echo $this->Paginator->prev(__('previous'), array('tag' => 'li','class' => 'arrow'), null, array('tag' => 'li','class' => 'unavailable','disabledTag' => 'a'));
						echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'current','tag' => 'li','first' => 1));
						echo $this->Paginator->next(__('next'), array('tag' => 'li','class' => 'arrow','currentClass' => 'unavailable'), null, array('tag' => 'li','class' => 'unavailable','disabledTag' => 'a'));
					?>
				</ul>
			</div>

			<ul class="small-block-grid-5 medium-block-grid-5 large-block-grid-5 text-center">
				<li><h4><?= strtoupper(__("Position")) ?></h4></li>
				<li><h4><?= strtoupper(__("Agent ID")) ?></h4></li>
				<li><h4><?= strtoupper(__("Agent name")) ?></h4></li>
				<li><h4><?= strtoupper(__("Level")) ?></h4></li>
				<li><h4><?= strtoupper(__("XP")) ?></h4></li>
			</ul>
			<?php 
				$pos_index = 1;
				foreach ($points_users as $p => $user_point):
					// foreach ($point as $usr):
						$usr = $user_point['User'];
						$usr_points = $user_point[0]['total_points'];

						//Calculate position
						$paginatorParams = $this->Paginator->params();
						$position = $pos_index + ( ((int)$this->Paginator->counter('{:page}') - 1) * $paginatorParams['limit'] );
						?>
						<ul class="small-block-grid-5 medium-block-grid-5 large-block-grid-5 text-center">
							<li><p><?= $position ?></p></li>

							<li>
								<?php $pic = $this->UserPicture->getPictureAbsolutePath($usr); ?>
								<div class="centering-block">
									<img src="<?=$pic?>" class="img-circular square-40px img-glow-on-hover-small" alt="<?= __('User profile picture') ?>" />
								</div>
							</li>
							<li><p><?= $usr['name'] ?></p></li>
							<li><p><?= $usr['level'] ?></p></li>
							<li><p><?= $usr['total_points'] ?></p></li>
							<span class = "evoke leaderboard-border"></span>
							</ul>
					<?php 
						$pos_index++;
					// endforeach;
				endforeach;
			?>


			<!-- PAGINATION -->
			<div class="padding all-2 pagination-centered">
				<ul class="pagination">
					<?php
						echo $this->Paginator->prev(__('previous'), array('tag' => 'li','class' => 'arrow'), null, array('tag' => 'li','class' => 'unavailable','disabledTag' => 'a'));
						echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'current','tag' => 'li','first' => 1));
						echo $this->Paginator->next(__('next'), array('tag' => 'li','class' => 'arrow','currentClass' => 'unavailable'), null, array('tag' => 'li','class' => 'unavailable','disabledTag' => 'a'));
					?>
				</ul>
			</div>
		</div>

	</div>
</section>


<?php
	/* Footer */
	$this->start('footer');
	echo $this->element('footer');
	$this->end();

	//SCRIPT
	$this->Html->script('requirejs/app/Users/leaderboard.js', array('inline' => false));
?>