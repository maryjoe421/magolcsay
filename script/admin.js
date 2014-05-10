
jQuery(document).ready(function() {

	function initScroll(scrolling) {
		jQuery(".scroll-pane").each(function() {
			jQuery(this).bind("jsp-scroll-y", function(event, scrollPositionY, isAtTop, isAtBottom) {
				var jspPaneHeight = jQuery(this).find(".jspPane").outerHeight(), // 3272
					jspPaneTopPos = jQuery(this).find(".jspPane").position().top, // -2742
					parentHeight = jQuery(this).find(".jspContainer").height(); // 530

				// console.log("jspPaneHeight", jspPaneHeight, "jspPaneTopPos:", jspPaneTopPos, "parentHeight:", parentHeight, "isAtBottom:", isAtBottom);

				if (isAtBottom == true) {
					if ((jspPaneHeight + jspPaneTopPos) != parentHeight) {
						initScroll();
					}
				}
				// console.log('Handle jsp-scroll-y', this, 'scrollPositionY=', scrollPositionY, 'isAtTop=', isAtTop, 'isAtBottom=', isAtBottom);
			}).jScrollPane({
				animateScroll: true,
				scrollbarWidth: 10
			});
			var api = jQuery(this).data("jsp");
			api.reinitialise();
			if (scrolling) {
				api.scrollTo(0, scrolling);
			}
		});
	}

	// select element styling
	function stylingSelect() {
		jQuery("select").each(function(){
			var title = $(this).attr("title");
			if( jQuery("option:selected", this).val() != "") {
				title = jQuery("option:selected", this).text();
			} else {
				title = jQuery("option:eq(0)", this).text();
			}
			jQuery(this).after('<span class="select">' + title + '</span>').change(function() {
				val = jQuery("option:selected", this).text();
				jQuery(this).next().text(val);
			});
		});
	}

	jQuery("fieldset legend label").click(function() {
		jQuery("fieldset").find(".row").hide();
		jQuery(this).parent().parent().find(".row").show();
	});


	initScroll(0);
	stylingSelect();

});