define(['jquery'], function() {

	function evokeData() {}

	evokeData.webroot = "<?php echo Router::url('/', true); ?>";
	
	return evokeData;
});
