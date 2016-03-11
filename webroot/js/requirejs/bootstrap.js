requirejs.config({
  baseUrl: webroot + 'components',
  paths: {
    // EVOKE SPECIFIC MODULES
    evoke: '../js/requirejs/app/evoke',
    evokedata: '../js/requirejs/app/evoke_data',
    ajax_retry: '../js/requirejs/modules/ajax_retry',
    missionpanels: '../js/requirejs/modules/mission_panels',
    brainstormlanguages: webroot+'brainstorm_session/js/languages',
    // COMPONENTS (ALPHABETICAL ORDER)
    chartjs : 'chartjs/Chart.min',
    
    facebook: '//connect.facebook.net/en_US/all',
    foundation: 'foundation/js/foundation.min',
    foundationjoyride: 'foundation/js/foundation/foundation.joyride',
    foundationtopbar: 'foundation/js/foundation/foundation.topbar',
    froala: 'FroalaWysiwygEditor/js/froala_editor.min',
    fullpage: 'fullpage.js/jquery.fullPage.min',
    
    i18next: 'i18next/i18next.min',
    jquery : 'jquery/dist/jquery.min',
    jqueryajaxretry: 'jquery-ajax-retry/dist/jquery.ajax-retry.min',
    jqueryui : 'jquery-ui/jquery-ui.min',
    jqueryslimscroll : 'jquery.slimscroll/jquery.slimscroll.min',
    linkpreview: 'linkpreview/library/js/bootstrap-linkpreview.min',
    list: 'list.js/dist/list.min',
    modernizr: 'foundation/js/vendor/modernizr',
    sidr: 'sidr/jquery.sidr.min',
    slickcarousel: 'slick-carousel/slick/slick.min',
    stickykit: 'sticky-kit/jquery.sticky-kit.min',
    sweetalert: 'sweetalert/dist/sweetalert.min',

    multiscroll: 'multiscroll.js/jquery.multiscroll.min',
    
    "react": 'react/react',
    "reactdom": 'react/react-dom',
    "reactaddons": 'react/react-with-addons'
  },
  shim: {
    // EVOKE SPECIFIC MODULES
    evoke: { exports: 'evoke' },
    missionpanels: { exports: 'missionPanels' },
    // COMPONENTS (ALPHABETICAL ORDER PLEASE)
    facebook: { exports: 'FB' },
    foundation: {
      deps: ['jquery', 'modernizr'],
      exports: 'Foundation'
    },
    froala: { deps: ['jquery'] },

    multiscroll: { deps: ['jquery'] },

    // fullpage: { deps: ['jquery', 'jqueryui', 'jqueryslimscroll'] },
    handlebars: { exports: 'Handlebars' },
    jqueryui: { deps: ['jquery'] },
    jqueryslimscroll: { deps: ['jquery'] },
    list: { exports: 'List' },
    modernizr: { exports: 'Modernizr' },
    
    'react':        {
      exports: 'React',
      dps:['reactdom', 'reactaddons']
    },
    
    sidr: { deps: ['jquery'] },
    slickcarousel: { deps: ['jquery'] },

    fullpage: { deps: ['jquery', 'jqueryui', 'jqueryslimscroll'] },
    
    stickykit: { deps: ['jquery'] },
    sweetalert: { exports: 'swal' }
  }
});

require(['evoke', 'ajax_retry'], function (evoke) {
  evoke.initialize();
});
