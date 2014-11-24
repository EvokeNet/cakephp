requirejs.config({
    baseUrl: webroot + 'components',
    paths: {
        // ALPHABETICAL ORDER PLEASE
        chartjs : 'chartjs/Chart.min',
        facebook: '//connect.facebook.net/en_US/all',
        foundation: 'foundation/js/foundation.min',
        froala: 'FroalaWysiwygEditor/js/froala_editor.min',
        fullpage: 'fullpage.js/jquery.fullPage.min',
        jquery : 'jquery/dist/jquery.min',
        jqueryui : 'jquery-ui/jquery-ui.min',
        jqueryslimscroll : 'jquery.slimscroll/jquery.slimscroll.min',
        modernizr: 'modernizr/modernizr',
        sidr: 'sidr/jquery.sidr.min',
        slickcarousel: 'slick-carousel/slick/slick.min',
        stickykit: 'sticky-kit/jquery.sticky-kit.min'
    },
    shim: {
        facebook: { exports: 'FB' },
        foundation: {
            deps: ['jquery', 'modernizr'],
            exports: 'Foundation'
        },
        froala: { deps: ['jquery'] },
        fullpage: { deps: ['jquery', 'jqueryui', 'jqueryslimscroll'] },
        jqueryui: { deps: ['jquery'] },
        jqueryslimscroll: { deps: ['jquery'] },
        modernizr: { exports: 'Modernizr' },
        sidr: { deps: ['jquery'] },
        slickcarousel: { deps: ['jquery'] },
        stickykit: { deps: ['jquery'] }
        
        // socketio: {
        //   exports: 'io'
        // },
        //facebook: { exports: 'FB' }
    }
});

require(['../js/requirejs/app/evoke'], function () {
    
});