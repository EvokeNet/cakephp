$(document).ready( function() {});

var last = $('meta[name=lastNotification]').attr('content');
var olderContent = 5;
var lastLocal = last;
var method = 'moreNotifications';
var target = '#target';

//checking scrolling info to call ajax function
$(window).scroll(throttle(function() {   
	if($(window).scrollTop() + $(window).height() < ($(document).height() - $(target + ":last-child").height() + 200)) {
		// alert(lastLocal);
		if((lastLocal) != "")
			fillExtraContent();
		// menuHeight();
	}
}, 1000));

function throttle(fn, threshhold, scope) {
  	threshhold || (threshhold = 250);
  	var last, deferTimer;
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
	    type: 'get',
	    url: getCorrectURL(method)+"/"+lastLocal+"/"+olderContent + "/<?=$user['User']['id']?>",
	    //"<?php echo $this->Html->url(array('action' => 'moreEvidences', $lastEvidence)); ?>",
	    beforeSend: function(xhr) {
	        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	    },
	    success: function(response) {
	        var responseLast = response.substring(response.search("lastBegin") + 9, response.search("lastEnd"));

			lastLocal = responseLast;
					
	        response = response.substring(response.search("lastEnd") + 7);
		        
	        // console.log(response);	
	        $(target).append((response));
	    },
	    error: function(e) {
	        console.log(e);
	    }
	});

}

function getCorrectURL(afterHome){
	var str = document.URL;
	
	//str = str.substr(7, str.length);
	str = str.substr(0, str.indexOf("notifications"));
	
	str = str.substr(0, str.length -1);
	// alert(str);
	if(str.length>1) {
		// str = str.substr(0, str.indexOf('/', 1));
		//alert(str);	
		str = str + '/' + afterHome;
		return str;
	} else {
		//alert(str);	
		return afterHome;
	}
	//alert(str);
}