<style>
#full-screen-background-image {
  /*z-index: -999;*/
  min-height: 100%;
  min-width: 1024px;
  width: 100%;
  height: 100vh; /*auto;*/
  position: fixed;
  top: 0;
  left: 0;
}

#wrappers {
  position: relative;
  width: 1000px;
  /*min-height: 400px;*/
  margin: 10px auto;
  color: #333;
  z-index: 10;
  top: 100px;
}

#imgs{
    position: relative;
    top:120px;
}

</style>
<?php
/**
 *
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 */
?>

<img alt="full screen background image" src="<?= $this->webroot.'img/error_page_60.png' ?>" id="full-screen-background-image" />
<div id="wrappers">
    
    <div class="row">
        <div class="large-8 columns">
            <h1 class = "font-green uppercase"><?= __("Oops!") ?></h1>
            <h2 class = "margin-bottom-1em"><?= __("It seems this page doesn't exist and we've ended up in a very dark place...") ?></h2>
            <ul>
                <!--<li class = "margin-bottom-05em"><h3><?= __("But don't worry! You can go to those links to continue exploring Evoke:") ?></h3></li>-->
                <li class = "margin-bottom-05em"><h3><?= __("Don't worry though! You can go back to Evoke Network by clicking one of options below:") ?></h3></li>
                <li><a href="/">Home</a></li>
                <li><a href="/search">Search</a></li>
                <li><a href="/help">Help</a></li>
                <li><a href="/help/getting-started/how-to-travel">Traveling on Airbnb</a></li>
                <li><a href="/info/why_host">Hosting on Airbnb</a></li>
                <li><a href="/trust">Trust &amp; Safety</a></li>
                <li><a href="/sitemaps">Sitemap</a></li>
            </ul>    
        </div>
        <div class="large-4 columns">
            <div id = "imgs">
                <img src="<?= $this->webroot.'img/alchemy.png' ?>" width="250px"/>
            </div>
        </div>
    </div>

    <!--<h1 class = "font-green uppercase"><?= __("Oops!") ?></h1>
    <h2 class = "margin-bottom-1em"><?= __("It seems this page doesn't exist and we've ended up in a very dark place...") ?></h2>
    <ul>
        <li class = "margin-bottom-05em"><h3><?= __("Don't worry though! You can go back to Evoke Network by clicking one of options below:") ?></h3></li>
        <li><a href="/">Home</a></li>
        <li><a href="/search">Search</a></li>
        <li><a href="/help">Help</a></li>
        <li><a href="/help/getting-started/how-to-travel">Traveling on Airbnb</a></li>
        <li><a href="/info/why_host">Hosting on Airbnb</a></li>
        <li><a href="/trust">Trust &amp; Safety</a></li>
        <li><a href="/sitemaps">Sitemap</a></li>
    </ul>-->
</div>

<!--<h2><?php echo $name; ?></h2>
<p class="error">
	<strong><?php echo __d('cake', 'Error'); ?>: </strong>
	<?php printf(
		__d('cake', 'The requested address %s was not found on this server.'),
		"<strong>'{$url}'</strong>"
	); ?>
</p>-->
  
<?php
// if (Configure::read('debug') > 0):
// 	echo $this->element('exception_stack_trace');
// endif;
?>