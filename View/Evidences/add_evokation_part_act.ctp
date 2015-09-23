<!-- TOPBAR MENU -->
<?php
	$this->start('topbar');
	echo $this->element('topbar', array('sticky' => '', 'fixed' => ''));
	$this->end();
?>
<!-- TOPBAR MENU -->

<?php
$element_title = 'evidence';
if (isset($evokation_part) && ($evokation_part)) {
	$element_title = 'evokation part';
}
?>

<div class="row full-width padding top-5 background-color-darkest border-bottom-divisor border-color-highlight radius" >
	<div class="column small-12 medium-12 large-12 centering-block" >
	<?php
			if (isset($quest)): ?>
				<!-- QUEST DESCRIPTION -->	
				<h2 class="text-glow"><?= __('Quest: '.$quest['Quest']['title']) ?></h2>
				<?= $quest['Quest']['description'] ?>
				<?php
			endif;
			?>
	</div>
</div>

<div class="evidence row full-width min-full-height">	

	<div class="column background-color-standard small-12 medium-4 min-full-height padding bottom-2 top-3">
		<h4 class="text-color-darker-gray"><?=__('Your group\'s evidences are here:')?></h4>
		<dl class="accordion" data-accordion>
			<?php
				$i = 1;
				foreach ($act_evidences as $evidence):
					//debug($evidence);
			?>
		  		<dd class="accordion-navigation">
		    		<a href="#panel<?= $i ?>"><?= $evidence['Evidence']['title'] ?></a>
		    		<div id="panel<?= $i++ ?>" class="content active">
		    			<!-- MAIN CONTENT -->
						<?php
							if (isset($evidence['Evidence']['main_content']) && isset($evidence['Evidence']['type'])):
								//IMAGE
								if (substr( $evidence['Evidence']['type'], 0, 5) === "image"):
								?>
									<img src="<?= $evidence['Evidence']['main_content'] ?>" alt="$evidence['Evidence']['title']" class="full-width" />
								<?php

								//VIDEO
								elseif (substr( $evidence['Evidence']['type'], 0, 5) === "video"):
								?>
									<div class="flex-video-new">
										<iframe width="420" height="315" autoplay="false" src="<?= $evidence['Evidence']['main_content'] ?>" frameborder="0" allowfullscreen></iframe>
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
						?>
						<!-- CONTENT -->
		      			<?= $evidence['Evidence']['content'] ?>
		    		</div>
		  		</dd>
		  	<?php
				endforeach;
			?>
		</dl>
	</div>

	<div class="column small-12 medium-8 padding top-3 left-4 right-4 min-full-height">
		<!-- TITLE -->
		<h2 class="text-glow text-center">
			<?= __('Create your '.$element_title) ?>
		</h2>

		<!-- FORM -->
		<?php
		if (!isset($loggedIn) || (!$loggedIn)) {
			echo $this->element('Evidences/evidence_form', array('sample_form' => true));
		}
		else {
			echo $this->element('Evidences/evidence_form');
		}
			
		?>
	</div>
</div>


<?php
	//FOOTER
	$this->start('footer');
	echo $this->element('footer');
	$this->end();
?>