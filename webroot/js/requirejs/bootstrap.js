requirejs.config({
    baseUrl: webroot + 'components',
    paths: {
        // ALPHABETICAL ORDER PLEASE
        chartjs : 'chartjs/Chart.min',
        ember: 'ember/ember.min',
        embertemplatecompiler: 'ember/ember-template-compiler',
        facebook: '//connect.facebook.net/en_US/all',
        foundation: 'foundation/js/foundation.min',
        foundationtopbar: 'foundation/js/foundation/foundation.topbar',
        froala: 'FroalaWysiwygEditor/js/froala_editor.min',
        fullpage: 'fullpage.js/jquery.fullPage.min',
        handlebars: 'handlebars/handlebars.min',
        jquery : 'jquery/dist/jquery.min',
        jqueryui : 'jquery-ui/jquery-ui.min',
        jqueryslimscroll : 'jquery.slimscroll/jquery.slimscroll.min',
        linkpreview: 'linkpreview/library/js/bootstrap-linkpreview.min',
        list: 'list.js/dist/list.min',
        modernizr: 'modernizr/modernizr',
        sidr: 'sidr/jquery.sidr.min',
        slickcarousel: 'slick-carousel/slick/slick.min',
        stickykit: 'sticky-kit/jquery.sticky-kit.min',
        sweetalert: 'sweetalert/lib/sweet-alert.min'
    },
    shim: {
        facebook: { exports: 'FB' },
        foundation: {
            deps: ['jquery', 'modernizr'],
            exports: 'Foundation'
        },
        froala: { deps: ['jquery'] },
        fullpage: { deps: ['jquery', 'jqueryui', 'jqueryslimscroll'] },
        handlebars: { exports: 'Handlebars' },
        jqueryui: { deps: ['jquery'] },
        jqueryslimscroll: { deps: ['jquery'] },
        list: { exports: 'List' },
        modernizr: { exports: 'Modernizr' },
        sidr: { deps: ['jquery'] },
        slickcarousel: { deps: ['jquery'] },
        stickykit: { deps: ['jquery'] },
        sweetalert: { exports: 'swal' }
        
        // socketio: {
        //   exports: 'io'
        // }
    }
});

require(['../js/requirejs/app/evoke'], function () {
    
});