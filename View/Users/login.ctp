<?php echo $this->element('topbar-login'); ?>

<?php echo $this->Form->create('User', array('data-abide', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>

<div class = "login-align">
    <div class="row margin-top-2em">
    <div class="large-4 large-centered columns">
        <!--<div style = "background-color:#222327">-->
            
            <div class="fb-login-button text-align-center margin-bottom-1em">
                <div class = "login-button-default"><i class="fa fa-facebook fa-3x"></i>
                </div>
                <div>
                    <div class="widget-stat-title text-align-center"><?= strtoupper(__('Sign In with Facebook')) ?></div>
                </div>
            </div>
            
            <div class="google-login-button text-align-center">
                <div class = "login-button-default"><i class="fa fa-google fa-3x"></i>
                </div>
                <div>
                    <div class="widget-stat-title text-align-center"><?= strtoupper(__('Sign In with Google')) ?></div>
                </div>
            </div>
        
            <div class = "separate-tag margin-top-2em margin-bottom-1em">
                <div class="container">
                    <span><?= __('OR') ?></span>
                </div>
            </div>
            
            <div>
                <?php
                        echo $this->Form->input('firstname', array('required' => true, 'label' => __('First name')));
                        echo $this->Form->input('lastname', array('required' => true, 'label' => __('Last name')));
                ?>
                
                <button type="submit" class="full-width uppercase"><?php echo __('Sign In'); ?></button>
                
            </div>
    </div>
    </div>
</div>

<?php echo $this->Form->end(); ?>

<?php echo $this->Html->script('requirejs/app/fullpage.js', array('inline' => false)); ?>
