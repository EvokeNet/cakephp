require(['../requirejs/bootstrap'], function () {
   require(['jquery'], function ($) {

     $('#upload-img').click(function(e) {
       e.preventDefault();
       $('.upload').click();
       $(this).blur();
     });

     $('.upload').change(function (event) {
       if ('files' in this) {
           if (this.files.length > 0) {
               $('#file-name').text(this.files[0].name);
           } else {
               $('#file-name').text('');
           }
       }
     });
 });
});