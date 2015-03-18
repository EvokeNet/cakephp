require([webroot+'js/requirejs/bootstrap'], function () {
  require(['jquery'], function ($) {
    //--------------------------------------------//
    //INSTRUCTIONS
    //--------------------------------------------//
    //Create an INPUT of type FILE
    //1. define its id
    //2. add class "upload-file-input"
    //   ex.: <input type="file" id="file-input-1" class="upload-file-input" />

    //Create a BUTTON to trigger the input
    //1. add class upload-file-button
    //2. add property file-input-id, whose value is the id of the actual input that will be triggered
    //   ex.: <button class="upload-file-button" data-file-input-id="file-input-1" />

    //(Optional) Create an element to display the filename
    //1. define its id with the same name as the file input, plus "-filename"
    //   ex.: <span id="file-input-1-filename"></span>

    //--------------------------------------------//
    //CLICK IN UPLOAD BUTTONS
    //--------------------------------------------//
    $('.upload-file-button').on('click', function(e) {
      //Default input file behavior
      var file_input_id = $(this).data("file-input-id");
      $('#'+file_input_id).click();

      //Remove focus
      e.preventDefault();
      $(this).blur();
    });

    //--------------------------------------------//
    //FILE INPUT CHANGED -> FILE NAME DISPLAYED IN ANOTHER ELEMENT
    //--------------------------------------------//
    $('.upload-file-input').on('change', function (event) {
      //Displays file name if there is such element
      var filename_element = $('#'+this.id+'-filename');

      if (($(filename_element).length) && ('files' in this)) {
        if (this.files.length > 0) {
          $(filename_element).text(this.files[0].name);
        } else {
          $(filename_element).text('');
        }
      }
    });
  });
});