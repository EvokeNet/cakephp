$(document).foundation({
  joyride: {
    cookie_monster: true,
    cookie_name: 'joyride', 
    cookie_domain: true,
    cookie_expires: 3, 
    //other options
}}).foundation('joyride', 'start');

 // $(document).foundation().foundation('joyride', 'start')
 // {
 //                            'joyride': {cookie_monster: true, cookieName: 'JoyRide', cookie_domain: false}    // not cookieMonster
 //                }

// $(document).foundation({
//   joyride : {
//     cookie_monster: true,
//     cookie_name: 'joyride', 
//     cookie_domain: true
//   }
//  }).foundation('joyride', 'start');

// $(document).foundation({
//   joyride: {
//     cookieMonster: true,
//     cookieName: 'joyride',
//     cookieDomain: true,
//     cookieExpires: 3,
//     //other options
// }});

// $(window).load(function() {
// 	$("#tour").joyride({
// 		cookieMonster: true,
// 		cookieName: 'JoyRide'
// 	});
// });    