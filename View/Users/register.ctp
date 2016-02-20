<?php echo $this->element('topbar-login'); ?>

<?php echo $this->Form->create('User', array('data-abide', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>

<div class = "login-align">
    
    <h3 class="text-align-center margin-bottom-1em uppercase font-green"><?= __('Sign Up to Evoke Network') ?></h3>
    <div class="row">
        <div class="large-4 large-centered columns">
            <div class="fb-login-button text-align-center">
                <div class = "login-button-icon"><i class="fa fa-facebook fa-2x"></i>
                </div>
                <div>
                    <!--<span class="text-align-center"><?= strtoupper(__('Sign In with Facebook')) ?></span>-->
                        <span class="text-align-center"><a href="<?= $this->Html->url($facebook_login_url) ?>"><?= strtoupper(__('Sign In with Facebook')) ?></a></span>
                </div>
            </div>
            
            <div class="google-login-button text-align-center">
                <div class = "login-button-icon"><i class="fa fa-google fa-2x"></i>
                </div>
                <div>
                    <!--<span class="text-align-center"><?= strtoupper(__('Sign In with Google')) ?></span>-->
                        <span class="text-align-center"><a href="<?= $this->Html->url($google_login_url) ?>"><?= strtoupper(__('Sign In with Google')) ?></a></span>
                </div>
            </div>
        
            <div class = "separate-tag margin-top-2em margin-bottom-2em">
                <div class="container">
                    <span><?= __('OR') ?></span>
                </div>
            </div>
            <div class = "text-align-center" style = "margin: 1em 1.5em;">
                <?php
                        echo $this->Form->input('firstname', array('required' => true, 'label' => false, 'placeholder' => __('First Name')));
                        echo $this->Form->input('lastname', array('required' => true, 'label' => false, 'placeholder' => __('Last Name')));
                        echo $this->Form->input('username', array('required' => true, 'label' => false, 'placeholder' => __('Username')));
                        echo $this->Form->input('email', array('required' => true, 'label' => false, 'placeholder' => __('E-mail')));
                        echo $this->Form->input('password', array('required' => true, 'label' => false, 'placeholder' => __('Password')));
                ?>
                
                <button type="submit" class="uppercase margin-top-1em" style = "width:70%"><?php echo __('Sign In'); ?></button>
                
            </div>
        </div>
    </div>
</div>

<div class="row standard-width">
	<?php //echo $this->element('register_form'); ?>
</div>

<?php echo $this->Form->end(); ?>

<?php echo $this->Html->script('requirejs/app/fullpage.js', array('inline' => false)); ?>