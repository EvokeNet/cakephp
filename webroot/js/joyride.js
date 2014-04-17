// $(document).foundation().foundation('joyride', 'start');

 // $(document).foundation().foundation('joyride', 'start')
 // {
 //                            'joyride': {cookie_monster: true, cookieName: 'JoyRide', cookie_domain: false}    // not cookieMonster
 //                }

$(document).foundation({
  joyride : {
    cookie_monster: true,
    cookie_name: 'joyride', 
    cookie_domain: true
  }
 }).foundation('joyride', 'start');

// $(window).load(function() {
// 	$("#tour").joyride({
// 		cookieMonster: true,
// 		cookieName: 'JoyRide'
// 	});
// });    