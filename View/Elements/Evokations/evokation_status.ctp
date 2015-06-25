<ul class="no-marker">
<?php
foreach ($evokationQuests as $key => $quest): ?>
	<li>
		<p>
		<?php
		switch ($quest['Quest']['status']) {
			case Quest::STATUS_IN_PROGRESS: ?>
				<i class="fa fa-check-circle green"></i>
				<span class="font-highlight green"><?= $quest['Quest']['title'] ?></span> <?php
				__('(in progress)');
				break;
			case Quest::STATUS_NOT_STARTED: ?>
				<i class="fa fa-pencil text-color-highlight"></i>
				<span class="font-highlight text-color-highlight"><?= $quest['Quest']['title'] ?></span> <?php
				__('(start now)');
				break;
			//NOT READY YET
			case 300: ?>
				<i class="fa fa-star-o text-color-highlight"></i>
				<span class="font-highlight text-color-highlight"><?= $quest['Quest']['title'] ?></span> <?php
				__('()');
		}
		?>
		</p>
	</li><?php
endforeach;
?>
</ul>