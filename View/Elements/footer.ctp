<footer class="footer">
	<a href = "http://www.worldbank.org/" target="_blank" class = "left margin-top-1em margin-left-1em"><img src = '<?= $this->webroot.'img/wblogo.png' ?>'></a>
	<a href = "<?= $this->Html->url(array('controller' => 'pages', 'action' => 'terms'))?>" target="_blank" class = "right uppercase margin-top-2em margin-top-1em margin-right-1em"><?= __('Terms of Service') ?></a>
	<a href = "<?= $this->Html->url(array('controller' => 'pages', 'action' => 'reportissue'))?>" target="_blank" class = "right uppercase margin-top-2em margin-top-1em margin-right-1em"><?= __('Report an issue') ?></a>
	<a href="#" class = "right uppercase margin-top-2em margin-left-1em margin-right-1em">&copy;&nbsp;&nbsp;<?= __('2016') ?> <?php echo strtoupper(__('Evoke'));?></a>
</footer>
