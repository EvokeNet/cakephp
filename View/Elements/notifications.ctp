<div class="row evoke evokation-red-box">
	<div class="small-2 medium-2 large-2 columns margin bottom-1">
  		<div class = "evoke dashboard text-align">
  			<!-- <img src="https://graph.facebook.com/<?php echo $e['User']['facebook_id']; ?>/picture?type=large" width="110px"/> -->

  			<a href = "<?php echo $this->Html->url(array('controller' => 'groups', 'action' => 'view', $e['Group']['id']));?>">
  				<?php if($e['Group']['photo_dir'] == null) :?>
  					<img src="https://graph.facebook.com//picture?type=large"/>
	  			<?php else : ?>
						<img src="<?= $this->webroot.'files/attachment/attachment/'.$e['Group']['photo_dir'].'/thumb_'.$e['Group']['photo_attachment'] ?>" />
			  	<?php endif; ?>
				<!-- <h6><?= $e['Group']['created']?></h6> -->
			</a>

			</div>
		</div>
	
	<div class="small-7 medium-7 large-7 columns">

		<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
		
			<h1><?= $e['Evokation']['title']?></h1>
			<!-- <h5><?= $e['Group']['description']?></h5> -->

		</a>

	</div>

	<div class="small-3 medium-3 large-3 columns">
		<div class = "evoke text-align">
			<div class = "button general green"><?= strtoupper(__('View')) ?>
		</div>
	</div>	
</div>