jQuery(function($) {

	var trackPath = "file/",
		trackContent = "ashes_of_cows",
		trackPrefix = "#" + trackContent + "/",

		langCode = window.navigator.userLanguage || window.navigator.language,
		language = (jQuery.cookie("language") !== null) ? jQuery.cookie("language") : (langCode.length > 2) ? langCode.substring(0, 2) : langCode,

		siteHash = window.location.hash,

		pageHash = getHashBegin(siteHash.substr(1)),
		trackHash = getHashEnd(siteHash);


	function isPlaying() {
		var playbar = jQuery("#jplayer_play_bar").css("width");
		if (jQuery(".jp-playlist-player")[0]) {
			if (parseInt(playbar.replace("px", "")) > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function initScroll(scrolling) {
		if (window.matchMedia('(min-width: 992px)').matches) {
			jQuery(".scroll-pane").each(function() {
				jQuery(this).bind("jsp-scroll-y", function(event, scrollPositionY, isAtTop, isAtBottom) {
					var jspPaneHeight = jQuery(this).find(".jspPane").outerHeight(), // 3272
						jspPaneTopPos = jQuery(this).find(".jspPane").position().top, // -2742
						parentHeight = jQuery(this).find(".jspContainer").height(), // 530
						page = jQuery("section:visible").attr("rel"),
						num = 1;

					// console.log("jspPaneHeight", jspPaneHeight, "jspPaneTopPos:", jspPaneTopPos, "parentHeight:", parentHeight, "isAtBottom:", isAtBottom);

					if (isAtBottom === true) {
						num + 1;
						if ((jspPaneHeight + jspPaneTopPos) !== parentHeight) {
							initScroll();
						}
						if ((jspPaneHeight + jspPaneTopPos) === parentHeight) { /*
							jQuery(".loader").show();
							jQuery.ajax({
								url: "menu.php",
								data: "page=" + num,
								success: function(html) {
									jQuery(".loader").hide();
									jQuery("section[rel='" + page + "'] .text-content").append(html);
									initScroll();
								}
							}); */
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
	}

	function playTrack(track) {
		var pos = jQuery('#jplayer_playlist ul li a[href="' + trackPath + track + '.mp3"]').parent().index();
		playListChange(pos);
	}

	function getHashBegin(hash) {
		if (hash.indexOf("/") !== -1) {
			hash = hash.split("/");
			return hash[0];
		} else {
			return hash;
		}
	}

	function getHashEnd(hash) {
		if (hash.indexOf("/") !== -1) {
			hash = hash.split("/");
			return hash[1];
		} else {
			return "";
		}
	}

	function emailHack() {
		jQuery("a[href*='mailto']").each(function() {
			var mailhref = jQuery(this).attr("href").replace("[at]", "@").replace("[dot]", "."),
				mailtext = jQuery(this).text().replace("[at]", "@").replace("[dot]", ".");
			jQuery(this).attr("href", mailhref);
			jQuery(this).text(mailtext);
		});
	}

	function outerLinks() {
		jQuery("a[href*='http']").each(function() {
			jQuery(this).attr("target", "_blank");
		});
	}

	function setPanelContent(panelContent) {
		if (jQuery("section[rel='" + panelContent + "']").find(".holder").attr("lang")) {
			jQuery("section[rel='" + panelContent + "']").find(".holder").hide();
			jQuery("section[rel='" + panelContent + "']").find(".holder[lang='" + language + "']").fadeIn("fast");
			jQuery("section[rel='" + panelContent + "']").find(".language").removeClass("active");
			jQuery("section[rel='" + panelContent + "']").find("a[href='#" + language + "']").addClass("active");
		}
		initScroll(0);
	}

	function wrapIframe() {
		if (window.matchMedia('(max-width: 991px)').matches) {
			jQuery("iframe[src*='youtube']").each(function() {
				jQuery(this).wrap('<div class="video-wrapper"></div>');
			});
		}
	}

	function setPlayer(page) {
		if (page === trackContent && isPlaying() === false) {
			createPlayList();
			jPlayerAdvancedHtml();
		}
	}

	function setPanel(page) {
		jQuery(".section-layer").fadeIn("fast", function() {
			if (jQuery.trim(jQuery("section[rel='" + page + "']").html()) === "") {
				jQuery.ajax({
					url: "menu.php",
					data: "menuitem=" + page,
					async: true,
					success: function(html, status, xhr) {
						// console.log("Hooray, it worked!");
						jQuery("section[rel='" + page + "']").html(html).fadeIn("fast", function() {
							setPanelContent(page);
							emailHack();
							outerLinks();
							wrapIframe();
						});
					},
					beforeSend: function(xhr) {
						// console.log(xhr);
					},
					error: function(xhr, status, error) {
						// console.log(xhr, status, error);
					},
					complete: function(xhr, status) {
						// console.log(xhr, status);
					}
				});
			} else {
				jQuery("section[rel='" + page + "']").fadeIn("fast", function() {
					setPanelContent(page);
				});
			}
			setPlayer(page);
		});
	}


	// open panel by hash
	if (siteHash !== "") {
		setPanel(pageHash);
	}


	// menuitem click
	jQuery(document).on("click", ".menu > li > a", function() {
		_gaq.push(["_trackEvent", "menu", jQuery(this).attr("title")]);
		var item = jQuery(this).attr("href").substr(1);
		setPanel(item);
	});

	// language change
	jQuery(document).on("click", ".language", function(event) {
		event.preventDefault();
		var langcode = jQuery(this).attr("href").substr(1),
			section = jQuery(this).parents("section");

		section.find(".holder").fadeOut("fast", function() {
			section.find(".holder[lang='" + langcode + "']").fadeIn("fast");
			section.find(".language").removeClass("active");
			section.find("a[href='#" + langcode + "']").addClass("active");
			jQuery.cookie("language", langcode, {
				expires: 365,
				path: '/'
			});
		});
		initScroll(0);
	});

	// hide panels
	jQuery(document).on("click", ".close", function() {
		var item = jQuery(this).parents("section").attr("id");
		jQuery("#" + item).fadeOut("fast", function() {
			jQuery(".section-layer").fadeOut("fast");
			if (isPlaying() === false) {
				jQuery(".footer").empty();
			}
		});
	});


	if (window.matchMedia('(min-width: 992px)').matches) {
		// menuitems hover
		jQuery(".menu > a").hover(function() {
			jQuery(this).parent().addClass("over");
		}, function() {
			jQuery(this).parent().removeClass("over");
		});

		// bio, events, contacts hover
		jQuery("#item1 > a, #item5 > a, #item6 > a").hover(function() {
			jQuery(this).find("> span").fadeIn("slow");
		}, function() {
			jQuery(this).find("> span").fadeOut("slow");
		});

		// books hover
		jQuery("#item2 > a").hover(function() {
			jQuery(this).find("> span").fadeIn("slow").arctext({
				radius: 40,
				dir: -1
			});
		}, function() {
			jQuery(this).find("> span").fadeOut("slow");
		});

		// publications hover
		jQuery("#item3 > a").hover(function() {
			jQuery(this).find("> span").show().stop().animate({"bottom": "130px"}, 1800);
		}, function() {
			jQuery(this).find("> span").stop().animate({"bottom": "800px"}, 1800, function() {
				jQuery(this).hide();
			});
		});

		// reception hover
		jQuery("#item4 > a").hover(function() {
			jQuery(this).find("> span").show().stop().animate({"bottom": "45px"}, 400);
		}, function() {
			jQuery(this).find("> span").stop().animate({"bottom": "-30px"}, 400, function() {
				jQuery(this).hide();
			});
		});

		// ashes of cows hover
		jQuery("#" + trackContent + " > a").hover(function() {
			jQuery(this).find("> span").fadeIn("slow").arctext({
				radius: 10
			});
		}, function() {
			jQuery(this).find("> span").fadeOut("slow");
		});

		// playing tracks
		jQuery(document).on("click", ".track", function(event) {
			event.preventDefault();
			_gaq.push(["_trackEvent", "ashes of cows", jQuery(this).attr("title")]);
			var trackItem = jQuery(this).attr("href").substring(jQuery(this).attr("href").lastIndexOf("/") + 1, jQuery(this).attr("href").length);
			window.location.hash = trackPrefix + trackItem;
			playTrack(trackItem);
		});


		// reception and events content fixing
		jQuery("#item4_container .text-content, #item5_container .text-content").find("img").each(function() {
			if (jQuery(this).parent().get(0).tagName != "A") {
				jQuery(this).wrap('<a href="' + jQuery(this).attr("src") + '" class="js-wrapped" rel="clearbox"></a>');
			}
		});


		jQuery(document).on("click", "#jplayer_previous", function(event) {
			event.preventDefault();
			playListPrev();
			jQuery(this).blur();
		});

		jQuery(document).on("click", "#jplayer_next", function(event) {
			event.preventDefault();
			playListNext();
			jQuery(this).blur();
		});

		jQuery(document).on("click", "#jplayer_stop", function(event) {
			event.preventDefault();
			window.location.hash = jQuery(this).attr("href");
		});

		var playItem = 0,
			myPlayList;


		function createPlayList() {
			var items = jQuery(".track-list").toArray(),
				array = [];
			for (var i = 0; i < items.length; i++) {
				array.push('{name: "' + items[i].innerHTML + '", mp3: "' + trackPath + items[i].href.substring(items[i].href.lastIndexOf("/") + 1, items[i].href.length) + '.mp3"}');
			}
			myPlayList = eval("[" + array.join(",") + "];");
		}

		function jPlayerAdvancedHtml() {
			var advancedPlayerHtml = '' +
			'<div class="player">' +
				'<div id="jquery_jplayer"></div>' +
				'<div class="jp-playlist-player">' +
					'<div class="jp-interface">' +
						'<ul class="jp-controls">' +
							'<li><a href="#" id="jplayer_play" class="jp-play" tabindex="1">play</a></li>' +
							'<li><a href="#" id="jplayer_pause" class="jp-pause" tabindex="1">pause</a></li>' +
							'<li><a href="#' + trackContent + '" id="jplayer_stop" class="jp-stop" tabindex="1">stop</a></li>' +
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
						'<ul></ul>' +
					'</div>' +
				'</div>' +
			'</div>';
			jQuery(".footer").html(advancedPlayerHtml).fadeIn("fast");
			// jplayer
			jQuery("#jquery_jplayer").jPlayer({
				ready: function() {
					displayPlayList();
					if (trackHash !== "") {
						var trackItem = jQuery('section[rel="' + trackContent + '"] .holder:eq(0) .tracks ul li a[href="' + trackPrefix + trackHash + '"]').parent().attr("tabindex");
						playListChange(trackItem);
					} else {
						playListInit(false);
					}
				},
				swfPath: "flash"
			}).jPlayer("onProgressChange", function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
				jQuery("#jplayer_play_time").text(jQuery.jPlayer.convertTime(playedTime));
				jQuery("#jplayer_total_time").text(jQuery.jPlayer.convertTime(totalTime));
			}).jPlayer("onSoundComplete", function() {
				playListNext();
			});
		}

		function displayPlayList() {
			jQuery("#jplayer_playlist ul").empty();
			for (var i = 0; i < myPlayList.length; i++) {
				var listItem = '<li><a href="' + myPlayList[i].mp3 + '" id="jplayer_playlist_item_' + i + '" tabindex="1">' + myPlayList[i].name + '</a></li>';
				jQuery("#jplayer_playlist ul").append(listItem);
				jQuery("#jplayer_playlist ul").data("index", i).on("click", "#jplayer_playlist_item_" + i, function(event) {
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
			jQuery("#jplayer_playlist_item_" + playItem).parent().removeClass("jplayer_playlist_current");
			jQuery("#jplayer_playlist_item_" + index).parent().addClass("jplayer_playlist_current");
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
			window.location.hash = trackPrefix + jQuery(".jplayer_playlist_current a").attr("href").replace(trackPath, "").replace(".mp3", "");
		}

		function playListPrev() {
			var index = (playItem - 1 >= 0) ? playItem - 1 : myPlayList.length - 1;
			playListChange(index);
			window.location.hash = trackPrefix + jQuery(".jplayer_playlist_current a").attr("href").replace(trackPath, "").replace(".mp3", "");
		}

		// login stripe slide toggle
		if (jQuery(".header")[0]) {
			jQuery(".header").stop().animate({"top": "-30px"}, 250).hover(function() {
				jQuery(this).stop().animate({"top": 0}, 250);
			}, function() {
				jQuery(this).stop().animate({"top": "-30px"}, 250);
			});
		}
	}


	if (window.matchMedia('(max-width: 991px)').matches) {
		jQuery(".track").each(function() {
			var trackHref = trackPath + jQuery(this).attr('href').substring(1) + ".mp3";
			jQuery(document).on('click', this, function(event) {
				event.preventDefault();
				jQuery(".controls").remove();
				jQuery(this).parent().addClass('playing').append('<div class="controls"><a href="#" class="control" id="aoc_play">play</a><a href="#" class="control" id="aoc_pause">pause</a><a href="#" class="control" id="aoc_stop">stop</a></div>');
				jQuery("#" + trackContent + "_container").append('<audio id="aoc_player"/>')
				jQuery("#aoc_player").attr('src', trackHref);
				document.getElementById("aoc_player").play();
				jQuery("#aoc_play").hide();

				jQuery(document).on('click', "#aoc_pause", function(event) {
					event.preventDefault();
					document.getElementById("aoc_player").pause();
					jQuery("#aoc_pause").hide();
					jQuery("#aoc_play").show();
				});
				jQuery(document).on('click', "#aoc_play", function(event) {
					event.preventDefault();
					document.getElementById("aoc_player").play();
					jQuery("#aoc_play").hide();
					jQuery("#aoc_pause").show();
				});
				jQuery(document).on('click', "#aoc_stop", function(event) {
					event.preventDefault();
					document.getElementById("aoc_player").pause();
					document.getElementById("aoc_player").src = "";
					jQuery(".control").hide();
					jQuery(".track").parent().removeClass('playing');
				});
			});
		});
	}

});