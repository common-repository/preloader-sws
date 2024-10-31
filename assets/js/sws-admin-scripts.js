(function( $ ) {
    $(function( $ ) {
	    /**
		 * Add Color Picker to options page
		 */
	    $('.sws-color-picker').wpColorPicker({
	    	change: function( event, ui ) {
	    		if ( $('.nav-tab-wrapper').data('tab') === 'without_bg' ) {
	    			$('.preloader-preview-box').css({
	    				background: ui.color.toString(),
	    			})
	    		}
	    	}
	    });
	    
	    /**
	     * Select 2 to select for choose preloader
	     */
		function swsColorBox(name) {
		  if ( ! name.id || name.element.className === 'sws-no-bg-preloader' ) { return name.text; }
		  var $name = $('<span class="sws-select-color-box ' + name.element.className + '">' + name.text + '</span>');
		  return $name;
		};

		$('.sws-pleloader-choose-select').select2({
			placeholder: 'Select a preloader',
			templateResult: swsColorBox,
			templateSelection: swsColorBox,
			minimumResultsForSearch: -1
		});

		/**
		 * Upload button
		 */
		$('.sws-button-select-file').on('click', function(event) {
			event.preventDefault();
			$('#sws-preloader-custom-file').trigger('click');
		});
		$('#sws-preloader-custom-file').on('change', function(event) {
			$('.condition').text( $(this).val() );
		});

		/**
		 * Preview preloader
		 */
		$('select[name="sws_preloader_options[with_bg]"], select[name="sws_preloader_options[without_bg]"').on( 'change' , function(event) {
			var tab = $('.nav-tab-wrapper').data('tab');
			
			if ( $(this).attr('name') === 'sws_preloader_options[with_bg]' ) {
				// Preloader with bg
				var preloader = $('select[name="sws_preloader_options[with_bg]"]').val();
			} else if ( $(this).attr('name') === 'sws_preloader_options[without_bg]') {
				// Preloader without bg
				var preloader = $('select[name="sws_preloader_options[without_bg]"]').val();
			}
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {
					action: 'sws_ajax_preloader_preview',
					preloader: preloader,
					tab: tab
				},
				beforeSend: function() {
					swsSetProperHeight();
				}
			})
			.done(function( data ) {

				$('.preview-with-bg .preloader-preview-box img').fadeOut( 150, function(){
					var $box = $('.preview-with-bg .preloader-preview-box');

					$('.preview-with-bg .preloader-preview-box').html( data );
					$('.preview-with-bg .preloader-preview-box img').hide();
					$('.preview-with-bg .preloader-preview-box img').fadeIn( 150, function() {
						swsSetProperHeight();
					} );
				});

			});
			
		});
		
	}); // ready

	function swsSetProperHeight() {
		var $box = $('.preview-with-bg .preloader-preview-box');
		$box.css('height', $box.find('img').height() + 24 + 'px' );
	}
})( jQuery );