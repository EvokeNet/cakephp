(function($) {
    $(function() {
        $('.jcarousel')
            .on('jcarousel:create jcarousel:reload', function() {
                var element = $(this),
                    width = element.innerWidth();

                    if (width >= 600) {
                            width = width / 3;
                        } else if (width >= 350) {
                            width = width / 3;
                        }

                // This shows 1 item at a time.
                // Divide `width` to the number of items you want to display,
                // eg. `width = width / 3` to display 3 items at a time.
                element.jcarousel('items').css('width', width + 'px');
            })
            .jcarousel({
                // Your configurations options
            });

        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .on('click', function(e) {
                e.preventDefault();
            })
            .jcarouselPagination({
                perPage: 1,
                item: function(page) {
                    return '<a href="#' + page + '">' + page + '</a>';
                }
            });
    });
})(jQuery);
