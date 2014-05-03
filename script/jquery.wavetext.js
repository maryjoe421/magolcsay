(function($) {	
	$.fn.waveText = function(options) {
		tw_seed = 0;
		tw_letters = 0;
		var settings = {
			'magnitude'	: 10,
			'speed' 		: 0.2,
			'offset'		: 0.4,
			'refresh'	: 30,
			'bounce'		: false
		};
		return this.each(function() {
			waveObj = $(this);
			if(options) {
				$.extend(settings, options);
			}
			tmp = waveObj.text();
			tmpOut = "";
			tw_letters = tmp.length;

			for(count = 0; count < tmp.length; count++) {
				tmpOut+= '<span class="letter_'+count+'">'+tmp.charAt(count)+'</span>';
			}
			waveObj.html(tmpOut);
			setInterval("tw_loop()", settings.refresh);
			tw_loop = function() {
				tw_seed+= settings.speed;
				for(count = 0; count < tw_letters; count++) {
					seed = Math.sin(((tw_seed + (settings.offset * count)) % (Math.PI * 2)) - (Math.PI / 2));
					if(settings.bounce && seed > 0) seed*= -1;
					waveObj.children(".letter_" + count).css({
						"position": "relative",
						"top": (settings.magnitude * seed) + "px"
					});
				}
			};
		});
	};

})(jQuery);