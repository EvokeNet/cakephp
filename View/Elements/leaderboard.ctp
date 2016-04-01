
<!-- NEXT LEADERS -->
<div class="row other-leaders">
	<ul class="full-width small-block-grid-1 table">
		<?php
		$counter = 0;
		foreach($leaderboard_users as $similar_user):
			if ($counter > 4) break; //FORCE 3 FOR UI TESTING ?>
		<li>

			<!-- PANEL -->
			<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $similar_user['User']['id'], false)); ?>">
				<div class="profile-content padding top-1 border-top-divisor table-row">
				<!-- POSITION -->
				<div class="table-cell vertical-align-middle padding right-1">
					<strong><span class="no-word-break <?= ($counter < 3) ? 'text-color-highlight' : '' ?>">#<?= $counter+1 ?></span></strong>
				</div>

				<!-- USER INFO -->
				<div class="table-cell vertical-align-middle padding right-1 full-width">
					<!-- USER PICTURE -->
					<div class="left full-height padding right-1">

						<?= $this->Picture->showUserCircularPicture(
							$similar_user['User'],
							'square-40px',
							__("%s's profile picture",$similar_user['User']['name'])
						); ?>

					</div>

					<p class="user-name margins-0">
					<?= $similar_user['User']['name'] ?>
					</p>

					<small>Level <?= $similar_user['User']['level'] ?></small>
				</div>

				<!-- POINTS -->
				<div class="table-cell vertical-align-middle text-center no-word-break">
					<?= (!is_null($similar_user[0]['total_points'])) ? $similar_user[0]['total_points'] : '0' ?>
				</div>
				</div>
			</a>

		</li>
		
		<?php
			$counter++;
		endforeach;
		?>
	</ul>
</div>


<?php
	//SCRIPT
	$this->Html->script('requirejs/app/Elements/leaderboard.js', array('inline' => false));
?>