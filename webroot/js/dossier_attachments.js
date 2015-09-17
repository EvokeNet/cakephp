	var qtdD = 1;

	$('#newFileD').click(function(){
	    $('#fileInputHolderD').append('<div class="input file" id="'+qtdD+'"><label for="Attachment'+qtdD+'Attachment">Media File</label><input type="file" name="data[Attachment]['+qtdD+'][attachment]" id="Attachment'+qtdD+'Attachment"><button class="button tiny alert" onClick="deleteDivD('+qtdD+')">delete</button></div>');
	    qtdD++;
	    return false;
	});


	function deleteDivD(id){
	    $('#'+id).remove();
	    qtdD--;
	    return false;
	}