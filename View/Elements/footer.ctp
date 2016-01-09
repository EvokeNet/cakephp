	<footer class="footer full-width <?php echo isset($footerClass) ? $footerClass : ''; ?>" id="footer">
		<div class="row standard-width padding top-05 bottom-05">
			<div class="small-12 medium-12 large-12 columns">
			  		&copy;

			  		<?= __('2014') ?> <?php echo strtoupper(__('Evoke'));?>

			  		| <a href = "<?= $this->Html->url(array('controller' => 'pages', 'action' => 'reportissue'))?>" target="_blank"><?= __('Report an issue') ?></a>

			  		| <a href = "<?= $this->Html->url(array('controller' => 'pages', 'action' => 'terms'))?>" target="_blank"><?= __('Terms of Service') ?></a>

					<a href = "http://www.worldbank.org/" target="_blank"><img src='<?= $this->webroot.'img/wblogo.png' ?>' alt = "<?= __('The World Bank') ?>"/></a>
			</div>
		</div>
	</footer>
