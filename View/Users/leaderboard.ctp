<?php
	/* Top bar */
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	/* Paginator */
	$paginatorParams = $this->Paginator->params();
?>

<section class="leaderboard">
	<div class="row standard-width">
		<div class="small-12 columns padding top-2">

			<!-- USER'S POSITION -->
			<div class="row margin">
				<!-- MEDAL WITH POSITION -->
				<div class="small-6 medium-4 columns text-right padding bottom-1 top-1">

					<span class="fa-stack fa-5x text-center margin right-05">
						<strong class="fa-stack-1x text-color-highlight medal-text"><?= $user_position['rank'] ?></strong>
					</span>
				</div>

				<!-- INFO -->
				<div class="small-6 medium-4 columns text-center padding left-2">
					<h2 class="text-color-highlight"><?= $user_position['name'] ?></h2>
					<h4><?= __('Points: ') ?><?= $user_position['total_points'] ?></h4>
					<h4><?= __('Level: ') ?><?= $user_position['level'] ?></h4>
					<p class="margin top-1">
						<?php
							//Calculating page where the user's rank is
							$my_rank_page = (int) ($user_position['rank'] / $paginatorParams['limit']);
							$my_rank_page_rest = $user_position['rank'] % $paginatorParams['limit'];

							if ($my_rank_page_rest > 0) {
								$my_rank_page += 1;
							}
						?>
						<a href="<?= $this->Html->url(array(
									'action' => 'leaderboard',
									'escape'=>false,
									'page' => $my_rank_page
								)); ?>
								#rank<?= $user_position['rank'] ?>"
							class="text-color-highlight">
							<i class="fa fa-arrow-circle-down text-color-highlight"></i>
							<?= __('Go to my rank') ?>
						</a>
					</p>
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
				<li id="rank1"><h4><?= strtoupper(__("Position")) ?></h4></li>
				<li><h4><?= strtoupper(__("Agent ID")) ?></h4></li>
				<li><h4><?= strtoupper(__("Agent name")) ?></h4></li>
				<li><h4><?= strtoupper(__("Level")) ?></h4></li>
				<li><h4><?= strtoupper(__("Points")) ?></h4></li>
			</ul>
			<?php
				$pos_index = 1;
				foreach ($points_users as $p => $user_point):
					// foreach ($point as $usr):
					$usr = $user_point['User'];
					$usr_points = $user_point[0]['total_points'];

					//Calculate position
					$position = $pos_index + ( ((int)$this->Paginator->counter('{:page}') - 1) * $paginatorParams['limit'] );
					?>

						<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $usr['id'], false)); ?>">

							<ul class="small-block-grid-5 medium-block-grid-5 large-block-grid-5 text-center radius background-color-light-dark-on-hover text-glow-on-hover border-top-divisor  padding top-2 bottom-0">
								<li id="rank<?= $position + 1 ?>"> <!-- Plus one just because of the margin -->
									<p><?= $position ?></p>
								</li>

								<li>
									<!-- USER PICTURE -->
									<?= $this->Picture->showUserCircularPicture(
										$usr,
										'square-40px',
										__("%s's profile picture",$usr['name'])
									); ?>
								</li>
								<li><p><?= $usr['name'] ?></p></li>
								<li><p><?= $usr['level'] ?></p></li>
								<li><p><?= $usr['total_points'] ?></p></li>
								<span class = "leaderboard-border"></span>
							</ul>

						</a>
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

	//SCRIPT
	$this->Html->script('requirejs/app/Users/leaderboard.js', array('inline' => false));
?>
