<?php
    $this->extend('/Common/topbar');
    $this->start('menu');
?>

<div class="evoke panels contain-to-grid top-bar-background panels-bg">
  <nav class="top-bar row full-width-alternate margin top-05" data-topbar>
    <ul class="title-area">
        <li class="name">
          <h1><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $user['User']['id'])); ?>"><?= ('Evoke') ?></a></h1>
        </li>
         <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right top-bar-background">

          <li class="active">
            <a href="#">
                <?php if($user['User']['photo_attachment'] == null) : ?>
                    <?php if($user['User']['facebook_id'] == null) : ?>
                        <img src="<?= $this->webroot.'img/user_avatar.jpg' ?>"   class = "evoke top-bar icon"/>
                    <?php else : ?> 
                        <img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large"  class = "evoke top-bar icon"/>
                    <?php endif; ?>
                    
                <?php else : ?>
                    <img src="<?= $this->webroot.'files/attachment/attachment/'.$user['User']['photo_dir'].'/'.$user['User']['photo_attachment'] ?>" class = "evoke top-bar icon"/>
                <?php endif; ?>     
            </a>
          </li>

         <!--  <li class="active" id = "top-bar-name">

            <?php if(isset($user['User'])) :?>
                <a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'profile', $user['User']['id'])); ?>"><span><?= $user['User']['name'] ?></span></a>
            <?php else :?>
                <a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'login')); ?>"><span><?= __('Unidentified Agent, please login') ?></span></a>
            <?php endif; ?>

          </li> -->

          <li class="has-dropdown">
            <a href="#">
                <?php if(isset($user['User'])) :?>
                    <span><?= $user['User']['name'] ?></span>
                <?php else :?>
                    <span><?= __('Unidentified Agent, please login') ?></span>
                <?php endif; ?>
            </a>
            <ul class="dropdown">
                <?php if(isset($user['User'])) :?>
                    <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'profile', $user['User']['id'])) ?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;<?= __('See profile') ?></a></li>
                    <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'logout')) ?>"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;&nbsp;<?= __('Sign Out') ?></a></li>
                <?php else :?>
                     <li><a href="<?= $this->Html->url(array('controller' => 'users', 'action' => 'login')) ?>"><?= __('Log in') ?></a></li>
                <?php endif; ?>

            </ul>
          </li>

          <li class="evoke divider"></li>

          <li class="has-dropdown">
            <a href="#"><?= __('Language') ?></a>
            <ul class="dropdown">
              <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?= __('English') ?></a></li>
              <li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?= __('Spanish') ?></a></li>
            </ul>
          </li>

        </ul>

        <!-- Left Nav Section -->
        <!-- <ul class="left">
          <li><a href="#">Left Nav Button</a></li>
        </ul> -->
      </section>
  </nav>
</div>

<?php $this->end(); ?>

<section>

    <div class="evoke row full-width-alternate admin-panel-bg">
        <div class="small-11 small-centered columns margin top-2">

        <?php 
        	if(!isset($origin) || $origin != 'edit_mission') $origin = 'add_mission';
        	echo $this->Form->create('Quest', array(
		   		'url' => array(
		   			'controller' => 'panels',
		   			'action' => 'edit_quest', $mission_id, $me['Quest']['id'], $origin
                ),
				'enctype' => 'multipart/form-data'
			)); ?>

            <a href="<?= $this->Html->url(array('controller' => 'panels', 'action' => 'index', 'missions')); ?>" class = "button general"><?= strtoupper(__('Return to Admin Index')) ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-reply" style = "float:right; margin-top:5px"></i></a>

        	<h3 class = "margin top" style = "clear:both"><?php echo __('Edit Quest'); ?></h3>
        	<?php
        		echo $this->Form->input('title', array('value' => $me['Quest']['title']));
                echo $this->Form->input('title_es', array('value' => $me['Quest']['title_es'], 'label' => __('Spanish Title')));
        		echo $this->Form->input('description', array('value' => $me['Quest']['description'], 'label' => __('Description')));
                echo $this->Form->input('description_es', array('value' => $me['Quest']['description_es'], 'label' => __('Spanish Description')));
                echo $this->Form->input('todo_list', array('value' => $me['Quest']['todo_list']));
                echo $this->Form->input('points', array('value' => $me['Quest']['points']));
                echo $this->Form->radio('mandatory', array(1 => 'Yes', 0 => 'No'), array('required' => true, 'default' => $me['Quest']['mandatory']));//
        		echo $this->Form->hidden('mission_id', array('value' => $mission_id));
        		echo $this->Form->hidden('phase_id', array('value' => $phase_id));
                echo $this->Form->hidden('type', array('value' => $me['Quest']['type']));
        		if($me['Quest']['type'] == Quest::TYPE_QUESTIONNAIRE) {
        			//present the already registered questions of this questionnaire
        			$my_questionnaire = null;
        			foreach ($questionnaires as $questionnaire) {
        				if($questionnaire['Questionnaire']['quest_id'] == $me['Quest']['id']){
        					$my_questionnaire = $questionnaire;
        					break;
        				}
        			}
        			if($my_questionnaire) {
        	?>
        	<!-- questionnaire form -->
        	<p><b><?php echo __('Questionnaire:'); ?></b></p>
            <div id="survey-forms">
            	<?php 
            		//iterate questions of the questionnaire displaying its description in the form..
            		$k = 0;
            		foreach ($my_questionnaire['Question'] as $question) { ?>
            			
            			<div class="survey-question">
            				<label for="title-<?php echo $k; ?>">Enunciado</label>
            				<input class="input-block-level" id="title-<?php echo $k; ?>" name="data[Questions][<?php echo $k; ?>][description]" type="text" value="<?php echo $question['description']; ?>">
            				<input name="data[Questions][<?php echo $k; ?>][type]" type="hidden" value="<?php echo $question['type']; ?>">
            				<br>
            					<!-- iterates possible answers if question type isnt essay -->
            					<?php 
            						if($question['type'] != 'essay') {
            							if($question['type'] == 'single-choice') $cssClass = 'radio-prototype';
            							else $cssClass = 'checkbox-prototype';
            							foreach ($answers as $answer) {
            								if($answer['Answer']['question_id'] == $question['id']) {
            									//show all the pre-defined answers
            									?>
            									<div class="<?php echo $cssClass; ?>">
            										<input name="data[Questions][<?php echo $k; ?>][Answer][][description]" placeholder="Opção" type="text" value="<?php echo $answer['Answer']['description']; ?>">
            									</div>

            									<?php
            								}
            							}
                                        echo'
                                        <button class="button" id="add-'.$k.'" type="button">
                                            <i class="fa fa-plus"></i>
                                             Option
                                        </button>';
            						}
            					?>

            				<button class="button alert" id="<?php echo $k?>" type="button">
            					<i class="fa fa-trash-o"></i>
            				</button>
            			</div>

            	<?php
            			$k++;
            		}
            	?>
            </div>

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
        	<!--fim de teste -->

        	<?php 
        			}
        		} else {
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
                }
        	?>
        	
        	<button class="button tiny" type="submit">
        		<?php echo __('Save Quest')?>
        	</button>
        	<?php echo $this->Form->end(); ?>
        	<button class="button alert small">
        		<?php echo $this->Form->PostLink(__('Delete'), array('controller' => 'panels', 'action' => 'delete_quest', $mission_id, $me['Quest']['id'], $origin));?>
        	</button>
        </div>
    </div>

    <?php echo $this->Html->script('survey'); ?>

    <!-- necessary function to add remove the already existing questions -->
    <script type="text/javascript">

        <?php
            $i = 0;
            for($i=0; $i<$k;$i++) {
                $new = '<div><input name="data[Questions]['.$i.'][Answer][][description]" placeholder="Opção" type="text"></div>';

                echo "$('#". $i ."').click(function() {
                        $('#". $i ."').parent('div.survey-question').remove();
                    });";

                echo "$('#add-". $i ."').click(function() {
                        $('#add-". $i ."').parent('div.survey-question').append('".$new."');
                    });";

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