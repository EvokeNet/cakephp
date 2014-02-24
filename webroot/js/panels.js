//<!-- pagination scheme for org -->
	$('table.paginated').each(function() {
	    var currentPage = 0;
	    var numPerPage = 2;
	    var $table = $(this);
	    $table.bind('repaginate', function() {
	        $table.find('tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
	    });
	    $table.trigger('repaginate');
	    var numRows = $table.find('tr').length;
	    var numPages = Math.ceil(numRows / numPerPage);
	    var $pager = $('<div class="pager"></div>');
	    for (var page = 0; page < numPages; page++) {
	        $('<span class="page-number"></span>').text(page + 1).bind('click', {
	            newPage: page
	        }, function(event) {
	            currentPage = event.data['newPage'];
	            $table.trigger('repaginate');
	            $(this).addClass('active').siblings().removeClass('active');
	        }).appendTo($pager).addClass('clickable');
	    }
	    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
	});

//<!-- issues & roles' filtering script -->
	$("#filters :checkbox").click(function() {
	   	$("#filters :checkbox").each(function() {
	       	if($(this).is(':checked')) {
	            $("." + $(this).val()).fadeTo("slow", 1);
			} else {
	            $("." + $(this).val()).hide();
	        }
	 	});
	});

	$("#filters2 :checkbox").click(function() {
		$('#box').val('');
	   	$("#filters2 :checkbox").each(function() {
	       	if($(this).is(':checked')) {
   				$("." + $(this).val()).fadeTo("slow", 1);
		        $("." + $(this).val()).addClass("shownR");
			} else {
				$("." + $(this).val()).hide();
	            $("." + $(this).val()).removeClass("shownR");
	        }
	 	});
	});

	//filter by name
	$('#box').keyup(function(){
   		var valThis = $(this).val().toLowerCase();
   		valThis = valThis.replace(/\s/g, '_');
    	$('.userList>li').each(function(){
    		var text = $(this).attr('class').split(' ')[1].toLowerCase();
    		if(text.indexOf(valThis) > -1) {
	        	if($(this).hasClass('shownR')) {//only show if its supposed to be seen by role
	        		$(this).show();
	        		$(this).addClass('shownN');
		        }
	        } else {
	        	$(this).hide();
	        	//remove shownN
	        	$(this).removeClass('shownN');
	        } 
   		});
	});


//<!-- hide and show '+ orgs', '+ badges', '+ issues' forms -->
	$( document ).ready(function() {
  		$("#orgsForm").hide();
  		//<?php //foreach ($organizations as $organization) echo  '$("#edit_org_'. $organization['Organization']['id'].'").hide();'; ?>

  		$("#badgesForm").hide();
  		$("#issuesForm").hide();
	});
	
	$("#new_org").click(function() {
	   	if($("#orgsForm").is(":visible")) {
	   		$("#orgsForm").hide();	
	   	} else {
	   		$("#orgsForm").fadeTo("slow", 1);
	   	}
	});

	$("#new_badge").click(function() {
	   	if($("#badgesForm").is(":visible")) {
	   		$("#badgesForm").hide();	
	   	} else {
	   		$("#badgesForm").fadeTo("slow", 1);
	   	}
	});

	$("#new_issue").click(function() {
	   	if($("#issuesForm").is(":visible")) {
	   		$("#issuesForm").hide();	
	   	} else {
	   		$("#issuesForm").fadeTo("slow", 1);
	   	}
	});
