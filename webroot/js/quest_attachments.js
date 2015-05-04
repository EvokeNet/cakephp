    $('#questtype1').click(function(){
        $('#questionnaire').fadeTo("slow", 1);
        $('#media').hide();
        $('#questtype2').removeAttribute("checked");
        $('#questtype3').removeAttribute("checked");
        $('#questtype4').removeAttribute("checked");
        $('#questtype1').setAttribute("checked", "checked");
        return false;
    });

    $('#questtype2').click(function(){
        $('#media').fadeTo("slow", 1);
        if(qtd > 1) {
            $('#fileInputHolder').children().remove();
            qtd = 1;
        }
        $('#fileInputHolder').append('<div class="input file" id="'+qtd+'"><label for="Attachment'+qtd+'Attachment"></label><input type="file" name="data[Attachment]['+qtd+'][attachment]" id="Attachment'+qtd+'Attachment"></div>');
        qtd++;
        $('#questionnaire').hide();
        $('#questtype1').removeAttribute("checked");
        $('#questtype3').removeAttribute("checked");
        $('#questtype4').removeAttribute("checked");
        $('#questtype2').setAttribute("checked", "checked");
        return false;
    });

    $('#questtype3').click(function(){
        $('#media').fadeTo("slow", 1);
        if(qtd > 1) {
            $('#fileInputHolder').children().remove();
            qtd = 1;
        }
        $('#fileInputHolder').append('<div class="input file" id="'+qtd+'"><label for="Attachment'+qtd+'Attachment"></label><input type="file" name="data[Attachment]['+qtd+'][attachment]" id="Attachment'+qtd+'Attachment"></div>');
        qtd++;
        $('#questionnaire').hide();
        $('#questtype1').removeAttribute("checked");
        $('#questtype2').removeAttribute("checked");
        $('#questtype4').removeAttribute("checked");
        $('#questtype3').setAttribute("checked", "checked");
        return false;
    });

    $('#questtype4').click(function(){
        $('#media').fadeTo("slow", 1);
        if(qtd > 1) {
            $('#fileInputHolder').children().remove();
            qtd = 1;
        }
        $('#fileInputHolder').append('<div class="input file" id="'+qtd+'"><label for="Attachment'+qtd+'Attachment"></label><input type="file" name="data[Attachment]['+qtd+'][attachment]" id="Attachment'+qtd+'Attachment"></div>');
        qtd++;
        $('#questionnaire').hide();
        $('#questtype1').removeAttribute("checked");
        $('#questtype2').removeAttribute("checked");
        $('#questtype3').removeAttribute("checked");
        $('#questtype4').setAttribute("checked", "checked");
        return false;
    });

    var qtd = 1;

    $('#newFile').click(function(){
        $('#fileInputHolder').append('<div class="evoke input file border" id="'+qtd+'"><label for="Attachment'+qtd+'Attachment"></label><input type="file" name="data[Attachment]['+qtd+'][attachment]" id="Attachment'+qtd+'Attachment"><button class="button tiny alert" onClick="deleteDiv('+qtd+')">delete</button></div>');
        qtd++;
        return false;
    });


    function deleteDiv(id){
        $('#'+id).remove();
        qtd--;
        return false;
    }
