
<h2><?= __('Hello, agent %s!', $recipient['firstname'].' '.$recipient['lastname']);?></h2>

<p><?= __('You have one request to join your group %s', $group['title']) ;?></h2>

<table class="margin: auto;">
	<tr>
		<td>
			<?php $pic = $this->Picture->getUserPictureAbsolutePath($sender); ?>
			<img src="<?= $pic ?>" alt="<?= __('User picture') ?>" title="<?= __('User picture') ?>" 
				style="max-width: 100px; max-height: 100px;" />
		</td>
		<td>
			<h3><strong><?= __('User: ') ?></strong><?php echo $sender['firstname'].' '.$sender['lastname'];?></h3>
			<p><strong><?= __('Email: ') ?></strong> <?= $sender['email'] ?></p>
			<p><strong><?= __('Biography: ') ?></strong> <?= (!empty($sender['mini_biography']) ? $sender['mini_biography'] : $sender['biography']) ?></p>
		</td>
	</tr>
</table>


<?php
	$style_link = "style='text-decoration: initial; color: #26dee0; text-transform: uppercase; background-color: #333; border: 1px solid #26dee0; padding: 1em 2em; display: inline-block;'";
?>
<br />

<div style="text-align: center;">
	<a href="<?php echo $_SERVER['SERVER_NAME'].'/groupsUsers/add/?arg='.$sender['id'].'&arg2='.$group['id']; ?>" <?= $style_link ?>>
		<?php echo __('Accept');?>
	</a>

	<a href="<?php echo $_SERVER['SERVER_NAME'].'/groupRequests/decline/?arg='.$sender['id'].'&arg2='.$group['id']; ?>" <?= $style_link ?>>
		<?php echo __('Decline');?>
	</a>
</div>