var editor = new MediumEditor('.editable');

$(function () {
  $('.editable').mediumInsert({
    editor: editor,
    buttons: [
    	'bold',
        'italic',
        'underline',
        'header1',
        'header2',
        'orderedlist',
        'unorderedlist',
        'anchor',
        'quote',
        'superscript',
        'subscript',
        'strikethrough',
    ],
    checkLinkFormat: true,
    cleanPastedHTML: true,
    placeholder: 'Go for it',
    targetBlank: true,
    images: true,
    imagesUploadScript: "{{ URL::to('upload') }}",
    // addons: {
    //   images: {},
    //   embeds: {}
    // }
  });
});

// create post
$('body').on('click', '#form-submit', function(e){
    e.preventDefault();
    
    var postContent = editor.serialize();
 
    $.ajax({
        type: 'POST',
        // dataType: 'json',
        url : "250",
        data: {name: "data[Evidence][content]", value: postContent}, //{ content: postContent['contentEditable']['value'] },
        success: function(data) {
            if(data.success === false)
            {
                $('.error').append(data.message);
                $('.error').show();
            } else {
                $('.success').append(data.message);
                $('.success').show();
            }
        },
        error: function(xhr, textStatus, thrownError) {
            alert('Something went wrong. Please Try again later...');
        }
    });
    return false;
});