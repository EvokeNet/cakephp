<li class="divider"></li>

<!-- CHANGE LANGUAGE -->
<li class="has-dropdown">
	<a href="#"><?= __('Language') ?></a>
	<ul class="dropdown">
		<li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'en')) ?>"><?= __('English') ?></a></li>
		<li><a href="<?= $this->Html->url(array('action'=>'changeLanguage', 'es')) ?>"><?= __('Spanish') ?></a></li>
	</ul>
</li>