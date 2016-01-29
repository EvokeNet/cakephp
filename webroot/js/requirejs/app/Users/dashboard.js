require([webroot+'js/requirejs/bootstrap'], function () {
  require(['jquery'], function ($) {
    $(document).ready(function(){
      //Change Mission
      $('.available-mission').on('click', function(e){
        $target = $(e.currentTarget);
        if (!$target.hasClass('selected-mission')){
          $targetMission = $('#' + $target.data('mission'));

          $('.selected-mission').removeClass('selected-mission');
          $target.addClass('selected-mission');
          $targetMission.addClass('selected-mission');
        }
      });
    });
  });
});
