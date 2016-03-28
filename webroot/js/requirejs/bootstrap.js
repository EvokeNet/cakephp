requirejs.config({
  baseUrl: webroot + 'components',
  paths: {
    // EVOKE SPECIFIC MODULES
    evoke: '../js/requirejs/app/evoke',
    evokedata: '../js/requirejs/app/evoke_data',

    // COMPONENTS (ALPHABETICAL ORDER)
    chartjs : 'chartjs/Chart.min',
    
    facebook: '//connect.facebook.net/en_US/all',
    foundation: 'foundation/js/foundation.min',
    foundationjoyride: 'foundation/js/foundation/foundation.joyride',
    foundationtopbar: 'foundation/js/foundation/foundation.topbar',
    froala: 'FroalaWysiwygEditor/js/froala_editor.min',
    fullpage: 'fullpage.js/jquery.fullPage.min',
    
    i18next: 'i18next/i18next.min',
    
    immutable: 'immutable/dist/immutable',
    lodash: 'lodash/dist/lodash',
    
    jquery : 'jquery/dist/jquery.min',
    jqueryajaxretry: 'jquery-ajax-retry/dist/jquery.ajax-retry.min',
    jqueryui : 'jquery-ui/jquery-ui.min',
 
    modernizr: 'foundation/js/vendor/modernizr',

    sweetalert: 'sweetalert/dist/sweetalert.min'

  },
  shim: {
    // EVOKE SPECIFIC MODULES
    evoke: { exports: 'evoke' },
    
    // COMPONENTS (ALPHABETICAL ORDER PLEASE)
    facebook: { exports: 'FB' },
    foundation: {
      deps: ['jquery', 'modernizr'],
      exports: 'Foundation'
    },
    froala: { deps: ['jquery'] },
    
    multiscroll: { deps: ['jquery'] },
    
    immutable: { exports: 'immutable'},
    
    lodash: { exports: 'lodash'},

    // fullpage: { deps: ['jquery', 'jqueryui', 'jqueryslimscroll'] },

    jqueryui: { deps: ['jquery'] },
    jqueryslimscroll: { deps: ['jquery'] },
    list: { exports: 'List' },
    modernizr: { exports: 'Modernizr' },

    fullpage: { deps: ['jquery', 'jqueryui', 'jqueryslimscroll'] },
    
    sweetalert: { exports: 'swal' }
  }
});

require(['evoke', 'ajax_retry'], function (evoke) {
  evoke.initialize();
});
