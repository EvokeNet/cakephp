<?php
	
    $this->extend('/Common/admin_panel');

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Admin Panel'), 'imgSrc' => ($this->webroot.'img/header-leaderboard-2.jpg'), 'margin' => false, 'hidden' => true));
	$this->end();

	echo $this->Html->css(
		array(
			'evoke',
			'circle'
		)
	);

?>

<?php $this->start('page_content'); ?>

<div class="row full-width" data-equalizer>

	<div class="large-10 columns" id="panel-content" data-equalizer-watch>	

		<div id="content">
			<div id="organizations" class="row padding-top-1"  >
				<div class="large-12 columns"  >
					<!-- This list show all organizations -->
					<ul class="small-block-grid-3">
						<?php foreach($organizations as $o): ?>
							<li>
							  	<div class="row"  >
									<div class="large-16 columns"  >
										<div style = "text-align: center; margin: 30px auto;"><i class="fa fa-bank fa-3x"></i></div>
										<div style = "font-size:2.5em;word-wrap: break-word;">
											<a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'organization', $o['Organization']['id'])) ?>">
												<?= $o['Organization']['name'] ?>
											</a>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->end(); ?>