    $('#questtype1').click(function(){
        $('#questionnaire').fadeTo("slow", 1);
        $('#media').hide();
        return false;
    });
    $('#questtype2').click(function(){
        $('#media').fadeTo("slow", 1);
        $('#fileInputHolder').append('<div class="input file" id="'+qtd+'"><label for="Attachment'+qtd+'Attachment">Media File</label><input type="file" name="data[Attachment]['+qtd+'][attachment]" id="Attachment'+qtd+'Attachment"></div>');
        qtd++;
        $('#questionnaire').hide();
        return false;
    });

    var qtd = 1;

    $('#newFile').click(function(){
        $('#fileInputHolder').append('<div class="input file" id="'+qtd+'"><label for="Attachment'+qtd+'Attachment">Media File</label><input type="file" name="data[Attachment]['+qtd+'][attachment]" id="Attachment'+qtd+'Attachment"><button class="button tiny alert" onClick="deleteDiv('+qtd+')">delete</button></div>');
        qtd++;
        return false;
    });

    function deleteDiv(id){
        $('#'+id).remove();
        qtd--;
        return false;
    }
