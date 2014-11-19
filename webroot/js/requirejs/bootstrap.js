requirejs.config({
    baseUrl: webroot + 'components',
    paths: {
        // ALPHABETICAL ORDER PLEASE
        chartjs : 'chartjs/Chart.min',
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
        // handlebars: { exports: 'Handlebars' },
        // foundation: {
        //     deps: ['jquery', 'modernizr'],
        //     exports: 'Foundation'
        // },
        // velocity: { deps: ['jquery'] },
        // velocityui: {
        //     deps: ['velocity'],
        //     exports: 'Velocity'
        // },
        // ckeditor: {
        //     deps: ['jquery'],
        //     exports: 'CKEDITOR'
        // },
        // socketio: {
        //   exports: 'io'
        // },
        // stickykit: { deps: ['jquery'] },
        // modernizr: { exports: 'Modernizr' },
        // magnific_popup: { exports: 'magnificPopup' },
        // jquery_backgrounds: { deps: ['jquery'] },
        // fitvids: { deps: ['jquery'] },
        // prettyembed: { deps: ['jquery', 'fitvids'] },
        // jquerycookie: { deps: ['jquery'] },
        // facebook: { exports: 'FB' },
        // sweetalert: { exports: 'swal' }
    }
});

require(['../js/requirejs/app/evoke'], function () {
    //require(['../js/app/fb']);
});