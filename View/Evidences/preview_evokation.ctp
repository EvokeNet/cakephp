<?php
$element_title = 'evidence';
if (isset($evokation_part) && ($evokation_part)) {
	$element_title = 'evokation part';
}
?>

<div class="row padding top-5">
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
				<div class="row background-color-light-dark full-width padding left-3 top-2 bottom-3">
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
									?>
										<div class="flex-video">
											<iframe width="420" height="315" autoplay="false" src="<?= $evidence['Evidence']['main_content'] ?>" frameborder="0" allowfullscreen></iframe>
										</div>
									<?php

									//LINK
									elseif (substr( $evidence['Evidence']['type'], 0, 4) === "link"):
										debug("THIS IS A LINK EVIDENCE");
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
						echo "EVOKATION PART NOT STARTED!";
					}
					?>
				</div>
				<?php
			}
		?>
	</div>
</div>