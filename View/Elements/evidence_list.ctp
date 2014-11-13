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
<div class="moreEvidencesLoading text-center hidden padding all-1"><i class="fa fa-spinner fa-spin fa-3x"></i></div>

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
		var space_for_loading_image = 100;

		if ($(window).scrollTop() >= $(document).height() - $(window).height() - space_for_loading_image) {
			if (has_ended == false) {
				fillExtraContent();
			}
		}
	}, 600));

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
		$.ajax({
		    type: 'post',
		    url: "<?= $load_evidences_url ?>&offset="+last,

		    beforeSend: function(xhr) {
		        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		        $(".moreEvidencesLoading").removeClass("hidden");
		    },
		    completed: function() {
		    	$(".moreEvidencesLoading").addClass("hidden");
		    },
		    success: function(response) {
		    	if (response.length == 0) {
		    		has_ended = true;
		    		$(".moreEvidencesLoading").addClass("hidden");
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