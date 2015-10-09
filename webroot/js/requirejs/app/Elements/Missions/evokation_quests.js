require([webroot+'js/requirejs/bootstrap'], function () {
	//, 'evoke', 'missionpanels', 'foundation', 'slickcarousel', 'stickykit', 'jqueryui'], function ($, evoke, missionPanels) {
	require(['jquery'],function($){
		$('.send-evokation').on('click', function(event){
			$.ajax({
				type : "POST",
				data : {final_sent: 1},
				url  : $(this).attr('href'),
				success : function(data) {
					swal(i18n.t("app.elements.missions.evokation_quests.msg_evokation_saved.title"),
						i18n.t("app.elements.missions.evokation_quests.msg_evokation_saved.text"),
						"success"
					);
				},
				error : function() {

				}
			});
			event.preventDefault();
		});
	});
});