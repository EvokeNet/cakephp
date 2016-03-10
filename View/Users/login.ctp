<?php echo $this->element('topbar-login'); ?>

<?php echo $this->Form->create('User', array('data-abide', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>

<div id="content"></div>
<div id="example"></div>

    <script type="text/jsx">
        ReactDOM.render(
            <h1>Hello, world!</h1>,
            document.getElementById('example')
        );
    </script>
    
<!--<div class = "login-align">
    
    <div class="row" data-equalizer>
        <div class="large-8 large-centered columns" data-equalizer-watch>
            
    <h2 class="text-align-center margin-bottom-1em uppercase font-green"><?= __('Sign In to Evoke Network') ?></h2>
    <div class="row" data-equalizer>
        <div class="large-5 columns" data-equalizer-watch>
                <div class = "text-align-center" style = "margin: 1em 1.5em;">
                    <?php
                            //echo $this->Form->input('username', array('required' => true, 'label' => false, 'placeholder' => __('Username')));
                            //echo $this->Form->input('password', array('required' => true, 'label' => false, 'placeholder' => __('Password')));
                    ?>
                    
                    <button type="submit" class="full-width uppercase margin-top-2em"><?php echo __('Sign In'); ?></button>
                    
                </div>
        </div>
        <div class="large-2 columns" data-equalizer-watch>
            <div class="ui vertical divider">
                <span class = "uppercase"><?= __('OR') ?></span>
            </div>
        </div>
        <div class="large-5 columns" data-equalizer-watch>
                <div class="fb-login-button text-align-center">
                    <div class = "login-button-default">
                        <i class="fa fa-facebook fa-3x"></i>
                    </div>
                    <div>
                        <span class="text-align-center"><?= strtoupper(__('Sign In with Facebook')) ?></span>
                    </div>
                </div>
                
                <div class="google-login-button text-align-center">
                    <div class = "login-button-default">
                        <i class="fa fa-google fa-3x"></i>
                    </div>
                    <div>
                        <span class="text-align-center"><?= strtoupper(__('Sign In with Google')) ?></span>
                    </div>
                </div>
        </div>
    </div>
    
    </div>
    </div>
    
</div>-->

<div class = "login-align">
    
    <h3 class="text-align-center margin-bottom-1em uppercase font-green"><?= __('Sign In to Evoke Network') ?></h3>
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
                
                <a class="btn btn-default facebook" href="<?php echo BASE_PATH.'fblogin'; ?>"> <i class="fa fa-facebook modal-icons"></i> Signin with Facebook </a>
                
                <div class = "separate-tag margin-top-2em margin-bottom-2em">
                    <div class="container">
                        <span><?= __('OR') ?></span>
                    </div>
                </div>
                
                <div class = "text-align-center" style = "margin: 1em 1.5em;">
                    <?php
                            echo $this->Form->input('username', array('required' => true, 'label' => false, 'placeholder' => __('Username')));
                            echo $this->Form->input('password', array('required' => true, 'label' => false, 'placeholder' => __('Password')));
                    ?>
                    
                    <div class = "recover-password">
                        <a href="<?= $this->Html->url(array('action'=>'recover_password')) ?>">
                            <?php echo __('Forgot password?'); ?>
                        </a>
                    </div>
    
                    <button type="submit" class="uppercase margin-top-1em"><?php echo __('Sign In'); ?></button>
                    
                </div>
        </div>
    </div>
</div>

<?php echo $this->Form->end(); ?>

<?php echo $this->Html->script('requirejs/app/fullpage.js', array('inline' => false)); ?>
