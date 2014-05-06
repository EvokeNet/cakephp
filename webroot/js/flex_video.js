close_video : function (e) {
var videos = $(this).find('.flex-video');

  videos.each(function () {
    var $video = $(this),
      iframe = $video.find("iframe");
    if (iframe.length > 0) {
      iframe.attr('data-src', iframe[0].src);
      iframe.attr('src', 'about:blank');
      $video.hide();
    }  
  });
},

open_video : function (e) {
  var videos = $(this).find('.flex-video');

  videos.each(function () {
    var $video = $(this),
      iframe = $(this).find('iframe');

    if (iframe.length > 0) {
      var data_src = iframe.attr('data-src');
      if (typeof data_src === 'string') {
        iframe[0].src = iframe.attr('data-src');
      } else {
        var src = iframe[0].src;
        iframe[0].src = undefined;
        iframe[0].src = src;
      }
      $video.show();
    }
  });

},