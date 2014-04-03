<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $user['User']['id'])); ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li class="name">
				<h1><?= sprintf(__('Hi %s'), $user['User']['name']) ?></h1>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>
			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>
		</ul>

		<h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3>

	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background-gray padding top-2">
	<div class="row">
		<div class="small-11 small-centered columns">
			<div class="evidences form">

			<div class = "evoke evidence-body edit">

			<?php echo $this->Form->create('Evidence', array('enctype' => 'multipart/form-data')); ?>
				<?php echo __('Edit Evidence'); ?>

				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('title', array('label' => __('Title')));
					//echo $this->Form->input('content');
					echo $this->Form->hidden('user_id');
					//echo $this->Form->input('quest_id', array('empty' => true));
					echo $this->Form->hidden('mission_id');
					echo $this->Form->hidden('phase_id');
					echo $this->Media->ckeditor('content', array('label' => __('Content')));
					//echo $this->Media->iframe('Evidence', $this->request->data['Evidence']['id']);

					echo "<label>".__('Attachments'). "</label>";
		            echo '<div id="fileInputHolder">';
		            echo "<ul>";
		            $k = 0;
		            foreach ($attachments as $media) {
		                echo "<li>";
		                echo '<div class="input file" id="prev-'. $k .'"><label id="label-'. $k .'" for="Attachment'. $k .'Attachment">'. $media['Attachment']['attachment'] .'</label>';
		                
		                echo '<input type="hidden" name="data[Attachment][Old]['. $k .'][id]" id="Attachmentprev-'. $k .'Id" value="NO-'. $media['Attachment']['id'] .'">';
		                echo '<img id="img-'. $k .'"src="' . $this->webroot.'files/attachment/attachment/'.$media['Attachment']['dir'].'/thumb_'.$media['Attachment']['attachment'] . '"/>';

		                echo '<button class="button tiny alert" id="-'. $k .'">delete</button></div>';

		                $k++;
		            }
		            echo "</ul>";
		            echo '</div>';
		            echo '<button id="newFile" class="button tiny">+ File</button>';
				?>
			<?php //echo $this->Form->end(__('Save Evidence')); ?>
			<div class = "evoke titles-right"><button type="submit" class= "evoke button general submit-button-margin"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Save Evidence')) ?></button></div>
			</div>
			</div>
		</div>
	</div>
</section>
<?php echo $this->Html->script('quest_attachments'); ?>
<script type="text/javascript">

        <?php
            $i = 0;
            for($i=0; $i<$k;$i++) {
        
                echo "$('#-". $i ."').click(function() {
                        var attId = $('#Attachmentprev-". $i ."Id').val().replace('NO-', '');
                        $('#img-". $i ."').remove();
                        $('#label-". $i ."').remove();
                        $('#Attachmentprev-". $i ."Id').val(attId);
                        $('#-". $i ."').remove();
                        return false;
                    });";                
        }?>
    
    </script>
