<?php


if ( ! is_admin() && ! preg_match("/wp-login/i", $_SERVER['REQUEST_URI'] ) ) {
	
	function sws_add_preloader_to_frontend() {
		$options = get_option( 'sws_preloader_options' );
		$only_frontpage = isset( $options['sws-preloader-only-frontpage'] ) ? $options['sws-preloader-only-frontpage'] : '';
		$image_with_bg = isset( $options['with_bg'] ) ? $options['with_bg'] : '';
		$image_without_bg = isset( $options['without_bg'] ) ? $options['without_bg'] : '';
		$url = isset( $options['url'] ) ? $options['url'] : '';

		switch ( $image_with_bg ) {
			
			case 'green-sphere-cutting.gif':
			case 'apple.gif':
			case 'yellow-r.gif':
			case 'infinity-blinking.gif':
			case 'stone-circle.gif':
			case 'star.gif':
				$bg_color = '#000';
				break;

			case 'house-and-fishman.gif':
			case 'spaceship-flight.gif':
			case 'shape-moving.gif':
			case 'spot-blinking.gif':
			case 'something-in-the-house.gif':
			case 'tools.gif':
			case 'ufo-and-phone-booth.gif':
			case 'triangle-to-square.gif':
			case 'monster-eats-a-bird.gif':
			case 'house-threw-a-man.gif':
			case 'many-half-moons.gif':
			case 'diamond-sharing.gif':
			case 'buth-loading.gif':
			case 'birdhouse-for-giants.gif':
			case 'blue-cutted-circle.gif':
			case 'cassette.gif':
			case 'orange-arrow-circle.gif':
			case 'products-to-the-cart.gif':
			case 'boards-loading.gif':
			case 'art-tool.gif':
			case 'cloud-in-bottle.gif':
			case 'clock-loading.gif':
			case 'two-iridescent-drops.gif':
			case 'lazy-human-dance.gif':
			case 'runing-clock.gif':
			case 'red-sign-intro.gif':
			case 'boy-and-girl.gif':
			case 'color-splash-wheel.gif':
			case 'three-color-gears.gif':
			case 'two-whater-drops.gif':
			case 'waves-triange.gif':
			case 'geometric-shapes-transformation.gif':
			case 'loading-and-a-ball.gif':
			case 'shapes-changing.gif':
			case 'firefox.gif':
				$bg_color = '#fff';
				break;

			case 'double-whell-with-shadow.gif':
				$bg_color = '#fffffb';
				break;
			
			case 'kitten-enjoing.gif':
				$bg_color = '#66ceff';
				break;
			
			case 'map-marker-hiding.gif':
				$bg_color = '#17a98f';
				break;
			
			case 'white-thick-circle.gif':
				$bg_color = '#02c4fc';
				break;
			
			case 'plant-in-pot.gif':
				$bg_color = '#fff3e1';
				break;
			
			case 'white-fractal-ring.gif':
				$bg_color = '#14d3a0';
				break;
			
			case 'red-dwelling.gif':
				$bg_color = '#f6f5f3';
				break;
			
			case 'time-and-money.gif':
				$bg_color = '#fcfbed';
				break;
			
			case 'fire.gif':
				$bg_color = '#18191b';
				break;
			
			case 'gnu-loader.gif':
				$bg_color = '#1a87c5';
				break;
			
			case 'icecream.gif':
				$bg_color = '#ffefcf';
				break;
			
			case 'falling-drop-and-wheel.gif':
				$bg_color = '#fffce4';
				break;
			
			case 'fox-fun-walk.gif':
				$bg_color = '#6a516a';
				break;
			
			case 'compass-loading.gif':
				$bg_color = '#3d73a5';
				break;
			
			case 'falling-drop-and-wheel.gif':
				$bg_color = '#3d73a5';
				break;
			
			case 'beer.gif':
				$bg_color = '#5db596';
				break;
				
			case 'click-to-load-button.gif':
				$bg_color = '#83af9b';
				break;
				
			case 'fire-2.gif':
				$bg_color = '#100010';
				break;
		
			case 'cat-with-headphones.gif':
				$bg_color = '#976d9e';
				break;
	
			case 'running-cat.gif':
				$bg_color = '#2c9ecc';
				break;

			case 'rotating-ball-loading.gif':
				$bg_color = '#dee1e2';
				break;
			
			case 'planet-earth.gif':
				$bg_color = '#e3f4fd';
				break;
			
			case 'changing-shapes.gif':
				$bg_color = '#9fe2dd';
				break;
			
			case 'drop.gif':
				$bg_color = '#222222';
				break;
			
			case 'bulb.gif':
				$bg_color = '#191f26';
				break;

			case 'bubble-breathing.gif':
				$bg_color = '#1c2126';
				break;
			
			case 'crazy-geometry.gif':
				$bg_color = '#2e2e2e';
				break;

			case 'timer.gif':
				$bg_color = '#3d4049';
				break;

			case 'eating-cookie.gif':
				$bg_color = '#292929';
				break;

			case 'hexagons-in-round.gif':
				$bg_color = '#15191f';
				break;

			case 'ruby-rotating.gif':
				$bg_color = '#00172a';
				break;

			case 'pink-dots.gif':
				$bg_color = '#2f2e33';
				break;

			case 'envato-leaf.gif':
				$bg_color = '#f4f6f4';
				break;

			case 'dancing-multicolor-dots.gif':
				$bg_color = '#ecf0f1';
				break;

			case 'infinity-sign.gif':
				$bg_color = '#c4ebe8';
				break;

			case 'fried-eggs.gif':
				$bg_color = '#f4ecdf';
				break;

			case 'three-light-green-gears.gif':
				$bg_color = '#e3f4fd';
				break;

			case 'space-rocket-charging.gif':
				$bg_color = '#28292e';
				break;

			case 'hexagonal-fractal.gif':
			case 'red-monster.gif':
				$bg_color = '#eeeeee';
				break;

			case 'planet-and-spaceship.gif':
				$bg_color = '#676d89';
				break;

			case 'sphere-cutting.gif':
				$bg_color = '#ffd87b';
				break;

			case 'gray-cat.gif':
				$bg_color = '#ff7c61';
				break;

			case 'small-black-ball.gif':
				$bg_color = '#ffdf01';
				break;

			case 'loadbar-to-circle.gif':
				$bg_color = '#ff5959';
				break;

			case 'upside-black-cat.gif':
				$bg_color = '#e19a2e';
				break;

			case 'download-cloud.gif':
				$bg_color = '#429ace';
				break;

			case 'jumping-ball.gif':
				$bg_color = '#635684';
				break;

			case 'jumping-dots.gif':
				$bg_color = '#2e425d';
				break;

			case 'black-squid.gif':
				$bg_color = '#36465d';
				break;

			case 'running-rabbit.gif':
				$bg_color = '#9b66c8';
				break;

			case 'african-woman-with-child.gif':
				$bg_color = '#bbd140';
				break;

			default:
				$bg_color = '#fff';
				break;
		}

		$delay = ( ! empty ( $options['sws-preloader-timeout'] ) ) ? $options['sws-preloader-timeout'] : 1000;

		if ( ! empty( $image_with_bg ) ) {
			$url = plugins_url('assets/img/bg-true/' . $image_with_bg, __DIR__);
		} elseif ( ! empty( $image_without_bg ) ) {
			$bg_color = $options['bg_color'];
			$url = plugins_url('assets/img/bg-false/' . $image_without_bg, __DIR__);
		} elseif ( ! empty( $url ) ) {
			$bg_color = $options['custom_bg_color'];
		}

		$preloader = '<div style="background: ' . $bg_color . ' url(' . $url . ') no-repeat center;" class="sws-preloader" data-delay="'. $delay . '"></div>';

		if ( $only_frontpage == 0 ) {
			echo $preloader;
		} elseif ( $only_frontpage === '1' ) {
			if ( is_front_page() || is_home() ) echo $preloader;
		}

	}
	add_action( 'wp_head', 'sws_add_preloader_to_frontend' );

}