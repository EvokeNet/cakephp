<div id="moreEvidencesTarget" class="evidences-list">
	<?php 
	if (isset($evidences)):
		$lastEvidence = null; //keep track of which one is the last

		foreach($evidences as $e):
			$lastEvidence = $e['Evidence']['id'];
			
			echo $this->element('evidence', array('e' => $e));
		endforeach;
		
		//REFERENCE OF LAST EVIDENCE RENDERED
		?><meta name="lastEvidence" content="<?php echo $lastEvidence; ?>"><?php
	endif; ?>
</div>
<div id="moreEvidencesLoading" class="text-center hidden"><i class="fa fa-spinner fa-spin fa-3x"></i></div>

<!-- SCRIPT -->
<?php
	//LOADING EVIDENCES
	$load_evidences_url = $this->Html->url(array('controller' => 'missions', 'action' => 'moreEvidences', 
		'?' => array(
			'mission_id' => $this->request->query('mission_id'), 
			'limit' => $this->request->query('limit'))
	));
	$load_evidences_url = str_replace('amp;', '', $load_evidences_url); //Workaround for Cakephp 2.x
?>

<script type="text/javascript">
	var last = parseInt($('meta[name=lastEvidence]').attr('content')); //OFFSET (where to start again)
	var has_ended = false; //nothing else to load
	var load_limit = <?= $this->request->query('limit') ?>; //how many results to bring every call
	var target = 'moreEvidencesTarget'; //basis for the scroll

	//checking scrolling info to call ajax function
	$(window).scroll(throttle(function() {   
		//CODIGO LEGADO
		// y = $('#'+target).height();
		// targetOffset = getOffset(document.getElementById(target));
		
		if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
		//if ($(window).scrollTop() + $(window).height() >= (targetOffset + y) - 600) { //CODIGO LEGADO
			if (has_ended == false) {
				fillExtraContent();
			}
		}
	}, 1000));
	
	function getOffset( el ) {
	    var _x = 0;
	    var _y = 0;
	    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
	        _x += el.offsetLeft - el.scrollLeft;
	        _y += el.offsetTop - el.scrollTop;
	        el = el.offsetParent;
	    }
	    return _y;
	}

	function throttle(fn, threshhold, scope) {
	  	threshhold || (threshhold = 250);
	  	var last,
	    	deferTimer;
	  	return function () {
	    	var context = scope || this;

	    	var now = +new Date,
	    	    args = arguments;
	    	if (last && now < last + threshhold) {
	    	  // hold on to it
	    		clearTimeout(deferTimer);
	    		deferTimer = setTimeout(function () {
	    	    	last = now;
	        		fn.apply(context, args);
	      		}, threshhold);
	    	} else {
	    		last = now;
	      		fn.apply(context, args);
	    	}
	  	};
	}


	function fillExtraContent(){
		//alert("<?= $load_evidences_url ?>&offset="+last);
		$.ajax({
		    type: 'post',
		    url: "<?= $load_evidences_url ?>&offset="+last,

		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		        $("#moreEvidencesLoading").removeClass("hidden");
		    },
		    completed: function() {
		    	$("#moreEvidencesLoading").addClass("hidden");
		    },
		    success: function(response) {
		    	if (response.length == 0) {
		    		has_ended = true;
		    	}
		    	else {
			        $('.evidences-list').append(response);
			        $(document).foundation('reflow'); //Reflow foundation so that all the behaviors apply to the new elements loaded via ajax
			        last += load_limit;
			    }
		    },
		    error: function(e) {
		        console.log(e);
		    }
		});
	}
</script>