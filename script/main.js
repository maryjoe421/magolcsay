var langCode = window.navigator.userLanguage || window.navigator.language,
	language = (langCode.length > 2) ? langCode.substring(0, 2) : langCode;

var siteHash = document.location.hash;


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

function jPlayerAdvancedHtml() {
	var advancedPlayerHtml = '' +
	'<div id="jquery_jplayer"></div>' +
	'<div class="jp-playlist-player">' +
		'<div class="jp-interface">' +
			'<ul class="jp-controls">' +
				'<li><a href="#" id="jplayer_play" class="jp-play" tabindex="1">play</a></li>' +
				'<li><a href="#" id="jplayer_pause" class="jp-pause" tabindex="1">pause</a></li>' +
				'<li><a href="#" id="jplayer_stop" class="jp-stop" tabindex="1">stop</a></li>' +
				'<li><a href="#" id="jplayer_previous" class="jp-previous" tabindex="1">previous</a></li>' +
				'<li><a href="#" id="jplayer_next" class="jp-next" tabindex="1">next</a></li>' +
			'</ul>' +
			'<div id="jplayer_play_time" class="jp-play-time"></div>' +
			'<div class="jp-progress">' +
				'<div id="jplayer_load_bar" class="jp-load-bar">' +
					'<div id="jplayer_play_bar" class="jp-play-bar"></div>' +
				'</div>' +
			'</div>' +
			'<div id="jplayer_total_time" class="jp-total-time"></div>' +
			'<div id="jplayer_volume_bar" class="jp-volume-bar">' +
				'<div id="jplayer_volume_bar_value" class="jp-volume-bar-value"></div>' +
			'</div>' +
		'</div>' +
		'<div id="jplayer_playlist" class="jp-playlist">' +
			'<ul>' +
				'<li></li>' +
			'</ul>' +
		'</div>' +
	'</div>';
	jQuery(".footer").append(advancedPlayerHtml);
}

function createPlayList() {
	var items = jQuery(".tracks:eq(0)").find("a").toArray(),
		array = [];
	for (var i = 0; i < items.length; i++) {
		array.push('{name: "' + items[i].innerHTML + '", mp3: "file/' + items[i].href.substring(items[i].href.indexOf("#") + 1, items[i].href.length) + '.mp3"}');
	}
	return eval("[" + array.join(",") + "];");
}



jQuery(document).ready(function() {

	// open panel by hash
	if (siteHash != "") {
		var item = siteHash.substr(1);
		jQuery(".section-layer").fadeIn("fast", function() {
			jQuery("#" + item + "_container").fadeIn("fast", function() {
				initScroll(0);
				if (jQuery(this).find(".holder").attr("lang")) {
					jQuery(this).find(".holder").hide();
					jQuery(this).find(".holder[lang='" + language + "']").fadeIn("fast");
					jQuery(this).find(".language").removeClass("active");
					jQuery(this).find("a[href='#" + language + "']").addClass("active");
				}
			});
		});
	}

	// email hack
	jQuery("a[href*='mailto']").each(function() {
		var mailhref = jQuery(this).attr("href").replace("[at]", "@").replace("[dot]", ".");
		var mailtext = jQuery(this).text().replace("[at]", "@").replace("[dot]", ".");
		jQuery(this).attr("href", mailhref);
		jQuery(this).text(mailtext);
	});

	// new window for outer links
	jQuery("a[href*='http']").each(function() {
		jQuery(this).attr("target", "_blank");
	});

	// single player popup panel
	jQuery(".text-content a[href^='?']").each(function() {
		jQuery(this).wrap('<div class="player-wrapper" />');
	});

	// menuitems hover
	jQuery(".menu").find("a").hover(function() {
		jQuery(this).parent().addClass("over");
	}, function() {
		jQuery(this).parent().removeClass("over");
	});

	// menuitem click
	jQuery(".menu").find("a").click(function() {
		_gaq.push(["_trackEvent", "menu", jQuery(this).attr("title")]);
		var item = jQuery(this).attr("href").substr(1);
		jQuery(".section-layer").fadeIn("fast", function() {
			jQuery("#" + item + "_container").fadeIn("fast", function() {
				initScroll(0);
				if (jQuery(this).find(".holder").attr("lang")) {
					jQuery(this).find(".holder").hide();
					jQuery(this).find(".holder[lang='" + language + "']").fadeIn("fast");
					jQuery(this).find(".language").removeClass("active");
					jQuery(this).find("a[href='#" + language + "']").addClass("active");
				}
			});
		});
	});

	// language change
	jQuery(".language").click(function(event) {
		event.preventDefault();
		var langcode = jQuery(this).attr("href").substr(1),
			section = jQuery(this).parents("section");

		section.find(".holder").fadeOut("fast", function() {
			section.find(".holder[lang='" + langcode + "']").fadeIn("fast");
			section.find(".language").removeClass("active");
			section.find("a[href='#" + langcode + "']").addClass("active");
		});
		initScroll(0);
	});

	// hide panels
	jQuery(".close").click(function() {
		var item = jQuery(this).parents("section").attr("id");
		jQuery("#" + item).fadeOut("fast", function() {
			jQuery(".section-layer").fadeOut("fast");
		});
		if (jQuery(".simple-player")[0]) {
			jQuery(".simple-player").remove();
		}
	});

	// bio, events, contact, grow young hover
	jQuery("#bio a, #events a, #contact a, #publications a").hover(function() {
		jQuery(this).find("> span").fadeIn("slow");
	}, function() {
		jQuery(this).find("> span").fadeOut("slow");
	});

	// logo-mandala hover
	jQuery("#logo_mandala a").hover(function() {
		jQuery(this).find("> span").fadeIn("slow").arctext({
			radius: 10,
			dir: -1
		});
	}, function() {
		jQuery(this).find("> span").fadeOut("slow");
	});

	// workshop hover
	jQuery("#workshop a").hover(function() {
		jQuery(this).find("> span").show().stop().animate({"bottom": "130px"}, 1800);
	}, function() {
		jQuery(this).find("> span").stop().animate({"bottom": "800px"}, 1800, function() {
			jQuery(this).hide();
		});
	});

	// ashes of cows hover
	jQuery("#ashes_of_cows a").hover(function() {
		jQuery(this).find("> span").fadeIn("slow").arctext({
			radius: 10
		});
	}, function() {
		jQuery(this).find("> span").fadeOut("slow");
	});

	// things hover
	jQuery("#things a").hover(function() {
		jQuery(this).find("> span").show().stop().animate({"bottom": "45px"}, 400);
	}, function() {
		jQuery(this).find("> span").stop().animate({"bottom": "-30px"}, 400, function() {
			jQuery(this).hide();
		});
	});

	// playing tracks
	jQuery(".tracks > li > a").click(function(event) {
		event.preventDefault();
		_gaq.push(["_trackEvent", "ashes of cows", jQuery(this).attr("title")]);
		var list = jQuery("#jplayer_playlist ul");
		var pos = list.find('a[href="file/' + jQuery(this).attr("href").substr(1) + '.mp3"]').parent().index();
		playListChange(pos);
	});

	jQuery(".player-wrapper > a").click(function(event) {
		event.preventDefault();
		jQuery(".simple-player").remove();
		var simplePlayerHtml = '' +
		'<div class="simple-player">' +
			'<div id="jquery_jplayer_simple"></div>' +
			'<div class="jp-playlist-player">' +
				'<div class="jp-interface">' +
					'<ul class="jp-controls">' +
						'<li><a href="#" id="jplayer_close" class="jp-close" title="Bezár">close</a></li>' +
						'<li><a href="#" id="jplayer_play" class="jp-play" tabindex="1">play</a></li>' +
						'<li><a href="#" id="jplayer_pause" class="jp-pause" tabindex="1">pause</a></li>' +
						'<li><a href="#" id="jplayer_stop" class="jp-stop" tabindex="1">stop</a></li>' +
					'</ul>' +
					'<div id="jplayer_simple_play_time" class="jp-play-time"></div>' +
					'<div class="jp-progress">' +
						'<div id="jplayer_load_bar" class="jp-load-bar">' +
							'<div id="jplayer_play_bar" class="jp-play-bar"></div>' +
						'</div>' +
					'</div>' +
					'<div id="jplayer_simple_total_time" class="jp-total-time"></div>' +
					'<div id="jplayer_volume_bar" class="jp-volume-bar">' +
						'<div id="jplayer_volume_bar_value" class="jp-volume-bar-value"></div>' +
					'</div>' +
				'</div>' +
			'</div>' +
		'</div>';
		jQuery(this).parent().append(simplePlayerHtml);
		var mp3File = jQuery(this).attr("href").substr(1);
		jQuery("#jquery_jplayer_simple").jPlayer({
			ready: function() {
				playListInit(false);
			},
			swfPath: "flash"
		}).jPlayer("onProgressChange", function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
			jQuery("#jplayer_simple_play_time").text(jQuery.jPlayer.convertTime(playedTime));
			jQuery("#jplayer_simple_total_time").text(jQuery.jPlayer.convertTime(totalTime));
		}).jPlayer("setFile", "file/" + mp3File + ".mp3");
	});

	jQuery("#jplayer_close").live("click", function(event) {
		event.preventDefault();
		jQuery(".simple-player").remove();
	});

	jQuery("#workshop_container .text-content, #things_container .text-content, #events_container .text-content").find("img").each(function() {
		if (jQuery(this).parent().get(0).tagName != "A") {
			jQuery(this).wrap('<a href="' + jQuery(this).attr("src") + '" class="js-wrapped" rel="clearbox"></a>');
		}
	});


	jPlayerAdvancedHtml();


	// jplayer
	jQuery("#jquery_jplayer").jPlayer({
		ready: function() {
			displayPlayList();
			playListInit(false);
		},
		swfPath: "flash"
	}).jPlayer("onProgressChange", function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
		jQuery("#jplayer_play_time").text(jQuery.jPlayer.convertTime(playedTime));
		jQuery("#jplayer_total_time").text(jQuery.jPlayer.convertTime(totalTime));
	}).jPlayer("onSoundComplete", function() {
		playListNext();
	});

	jQuery("#jplayer_previous").click(function(event) {
		event.preventDefault();
		playListPrev();
		jQuery(this).blur();
	});

	jQuery("#jplayer_next").click(function(event) {
		event.preventDefault();
		playListNext();
		jQuery(this).blur();
	});

	var playItem = 0;
	var myPlayList = createPlayList();

	function displayPlayList() {
		jQuery("#jplayer_playlist ul").empty();
		for (i=0; i < myPlayList.length; i++) {
			var listItem = (i == myPlayList.length - 1) ? '<li class="jplayer_playlist_item_last">' : '<li>';
			listItem += '<a href="' + myPlayList[i].mp3 + '" id="jplayer_playlist_item_' + i + '" tabindex="1">' + myPlayList[i].name + '</a></li>';
			jQuery("#jplayer_playlist ul").append(listItem);
			jQuery("#jplayer_playlist_item_" + i).data("index", i).click(function(event) {
				event.preventDefault();
				var index = jQuery(this).data("index");
				if (playItem != index) {
					playListChange(index);
				} else {
					jQuery("#jquery_jplayer").jPlayer("play");
				}
				jQuery(this).blur();
			});
		}
	}

	function playListInit(autoplay) {
		if(autoplay) {
			playListChange(playItem);
		} else {
			playListConfig(playItem);
		}
	}

	function playListConfig(index) {
		jQuery("#jplayer_playlist_item_" + playItem).removeClass("jplayer_playlist_current").parent().removeClass("jplayer_playlist_current");
		jQuery("#jplayer_playlist_item_" + index).addClass("jplayer_playlist_current").parent().addClass("jplayer_playlist_current");
		var actualItem = jQuery(".jplayer_playlist_current").position().top;
		jQuery(".jp-playlist > ul").hide().css("top", "-" + actualItem + "px").fadeIn("slow");
		playItem = index;
		jQuery("#jquery_jplayer").jPlayer("setFile", myPlayList[playItem].mp3);
	}

	function playListChange(index) {
		playListConfig(index);
		jQuery("#jquery_jplayer").jPlayer("play");
	}

	function playListNext() {
		var index = (playItem + 1 < myPlayList.length) ? playItem + 1 : 0;
		playListChange(index);
	}

	function playListPrev() {
		var index = (playItem - 1 >= 0) ? playItem - 1 : myPlayList.length - 1;
		playListChange(index);
	}

	// login stripe slide toggle
	if (jQuery(".header")[0]) {
		jQuery(".header").stop().animate({"top": "-30px"}, 250).hover(function() {
			jQuery(this).stop().animate({"top": 0}, 250);
		}, function() {
			jQuery(this).stop().animate({"top": "-30px"}, 250);
		});
		
	}

});