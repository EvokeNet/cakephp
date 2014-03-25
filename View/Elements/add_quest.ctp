<!-- Form for adding quests -->
<?php 
	if(!isset($origin) || $origin != 'edit_mission') $origin = 'add_mission';
	echo $this->Form->create('Quest', array(
 							   	'url' => array(
 							   		'controller' => 'panels',
 							   		'action' => 'add_quest', $mission_id, $origin
                                ),
                                'enctype' => 'multipart/form-data'
							)); ?>
	<fieldset>
		<legend><?php echo __('Add Quest'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->radio('type', array(1 => 'Questionnaire', 2 => 'Media'), array('id' => 'questtype'));//
		echo $this->Form->hidden('mission_id', array('value' => $mission_id));
		echo $this->Form->hidden('phase_id', array('value' => $phase_id));
	?>
	</fieldset>

<!-- div of the questionnaire -->
<div id="questionnaire" style="display:none">
    <p><b><?php echo __('Questionnaire:'); ?></b></p>
        <div id="survey-forms"></div>

        <div class="spacer20"></div>
        <div class="btn-group">
            <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">
                <i class="icon-plus"></i>
                <?php echo __('Add a question') ?>
                <i class="icon-caret-down"></i>
            </a>

            <ul class="dropdown-menu">
                <li>
                	<a href="#" id="essay-question" class="btn-create-question">
                        <i class="icon-text-height"></i>
                        <?php echo __('Essay'); ?>
                    </a>
                </li>
                <!--<li>
                    <a href="#" id="likert-scale-question" class="btn-create-question">
                        <i class="icon-sort-by-attributes"></i>
                        <?php echo __('1 to 5 scale'); ?>
                    </a>
                </li>-->
                <li>
                    <a href="#" id="single-choice-question" class="btn-create-question">
                        <i class="icon-circle-blank"></i>
                        <?php echo __('Single choice'); ?>
                    </a>
                </li>
                <li>
                    <a href="#" id="multiple-choice-question" class="btn-create-question">
                        <i class="icon-check-empty"></i>
                        <?php echo __('Multiple choice'); ?>
                    </a>
                </li>
            </ul>
        </div>

        <div class="spacer40"></div>
</div>
<div id="media" style="display:none">
    <div id="fileInputHolder">
        <?php
            echo $this->Form->input('Attachment.0.attachment', array('type' => 'file', 'label' => 'Media File'));
            echo $this->Form->input('Attachment.0.model', array('type' => 'hidden', 'value' => 'Quest'));
        ?>
    </div>
    <button id="newFile" class="button tiny">
        + File
    </button>
</div>
	<button class="button tiny" type="submit">
		<?php echo __('Add Quest')?>
	</button>
	<?php echo $this->Form->end(); 

	echo $this->Html->script('survey'); 
    echo $this->Html->script('quest_attachments');
    ?>
