<?php
$element_title = 'evidence';
if (isset($evokation_part) && ($evokation_part)) {
	$element_title = 'evokation part';
}
?>

<div class="row padding top-5">
	<div class="row">
		<div class="columns large-12 medium-12 small-12 text-center padding bottom-2">
			<h2 class="text-glow"><?= __('Evokation %s', $mission_title) ?></h2>
		</div>
	</div>
	<div class="columns large-12 medium-12 small-12">
		<?php
			//print_r($quests);
			foreach ($quests as $q) {
				$done = false;
				?>

				<div class="row background-color-darkest full-width">
					<div class="columns large-12 medium-12 small-12 padding top-1 bottom-1">
						<h4 class="text-color-highlight"><?= $q['Quest']['title'] ?></h4>
					</div>
				</div>
				<div class="row background-color-light-dark full-width padding left-3 top-2 bottom-3 right-2">
					<div class="columns large-12 medium-12 small-12">
						<?php
						foreach ($evokation_parts as $evidence) {
							if($evidence['Evidence']['quest_id'] == $q['Quest']['id']){
								// MAIN CONTENT 
							
								if (isset($evidence['Evidence']['main_content']) && isset($evidence['Evidence']['type'])):
									//IMAGE
									if (substr( $evidence['Evidence']['type'], 0, 5) === "image"):
									?>
										<img src="<?= $evidence['Evidence']['main_content'] ?>" alt="$evidence['Evidence']['title']" class="full-width" />
									<?php

									//VIDEO
									elseif (substr( $evidence['Evidence']['type'], 0, 5) === "video"):
										// Specific for youtube videos, gets dthe ID of the video to embed it
										$video_id = explode("=", $evidence['Evidence']['main_content']);
										$video_id = $video_id[count($video_id) - 1];
										$iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="1" allowfullscreen></iframe>';
										//debug($iframe);
									?>
										<div class="flex-video">
											<?php echo $iframe ?>
										</div>
									<?php

									//LINK
									elseif (substr( $evidence['Evidence']['type'], 0, 4) === "link"):
									?>
										<a class="evidenceLink" href="<?= $evidence['Evidence']['main_content'] ?>" class="hidden"></a>

									<?php
										echo $this->element('Templates/Evidences/evidence-type-link-view');
									endif;
								endif;
								
								// CONTENT -->
				      			echo $evidence['Evidence']['content'];

				      			$done = true;
							}
						}

						?>
					</div>
				
					<?php
					if(!$done){
						$action = 'add_evokation_part_act';
						if($q['Quest']['type_enum'] == 'Evokation'){
							$action = 'add_evokation_part_pure'; // not from brainstorm
						}
						?>
						<div data-alert="" class="alert-box radius clearfix">
							<?= __('EVOKATION PART NOT STARTED!')?>
							<a class="button small open-mission-overlay large-2 medium-2 small-2 text-center right margins-0" href="<?php echo $this->Html->url(array('controller' => 'evidences', 'action' => $action, 
										$q['Quest']['mission_id'],
										$phase_id,
										$q['Quest']['id'],
										$evokation_id
									));?>">
								<i class="fa fa-pencil text-color-highlight"></i>
								<span class="font-highlight text-color-highlight "><?= __('Start') ?></span>
							</a>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}
		?>
	</div>
</div>