<?php
/**
 * Register options page
 */
function sws_preloader_options() {
	add_options_page( 'Preloader options', 'Preloader', 'manage_options', 'sws-preloader-options', 'sws_option_page' );
	add_action( 'admin_init', 'sws_preloader_register_settings' );
}
add_action( 'admin_menu', 'sws_preloader_options' );

/**
 * Register settigns for options page
 */
function sws_preloader_register_settings(){
	register_setting( 'sws-preloader-options-group', 'sws_preloader_options', 'sws_preloader_sanitize_options' );
}

/**
 * Sanitize all fields
 */
function sws_preloader_sanitize_options( $new_options ) {

	$clean_options = array();
	$old_options = get_option( 'sws_preloader_options' );

	if ( ! empty ( $new_options['sws-preloader-timeout'] ) ) {
		$clean_options = $old_options;
		$clean_options['sws-preloader-timeout'] = $new_options['sws-preloader-timeout'];
	} elseif ( ! empty( $old_options['sws-preloader-timeout'] ) ) {
		$clean_options['sws-preloader-timeout'] = $old_options['sws-preloader-timeout'];
	}

	$clean_options['sws-preloader-only-frontpage'] = empty( $new_options['sws-preloader-only-frontpage'] ) ? 0 : 1;

	if ( ! empty( $_FILES['sws-preloader-custom-file']['tmp_name'] ) ) {

		$overrides = array( 'test_form' => false );
		$file = wp_handle_upload( $_FILES['sws-preloader-custom-file'], $overrides );
		$clean_options['url'] = $file['url'];
		$clean_options['file'] = $file['file'];

	} else {

		if ( ! empty( $old_options['url'] ) && ! empty( $old_options['file'] ) ) {
			$clean_options['url'] = $old_options['url'];
			$clean_options['file'] = $old_options['file'];
		}

	}

	foreach ( $new_options as $key => $value ) {
		$clean_options[$key] = strip_tags( $value );
	}

	/**
	 * Delete unnecessary file
	 */
	if ( $clean_options['selected-tab'] !== 'upload_a_custom' && ! empty( $clean_options['file'] ) ) {

		unlink( $clean_options['file'] );
		unset( $clean_options['url'] );
		unset( $clean_options['file'] );

	} elseif ( isset( $file ) && isset( $old_options['url'] ) && $file['url'] !== $old_options['url'] ) {
		unlink( $old_options['file'] );
	}

	return $clean_options;
}

/**
 * Set selected option in select from $_POST
 */
function sws_set_selected( $value, $func_type = true ) {
	$options = get_option( 'sws_preloader_options' );

	if ( isset( $options['without_bg'] ) ) {
		$type =  'without_bg';
	} elseif ( isset( $options['with_bg'] ) ) {
		$type =  'with_bg';
	} elseif ( isset( $options['upload_a_custom'] ) ) {
		$type = 'upload_a_custom';
	} else {
		$type = '';
	}

	if ( $func_type === false && isset( $options[$type] ) ) {
		return ( $options[$type] === $value ) ? 'selected="true"' : '';
	} else {
		echo ( $options[$type] === $value ) ? 'selected="true"' : '';
	}
}

/**
 * Preloader preview HTML
 */
function sws_the_preloader_preview() {
	$options = get_option( 'sws_preloader_options' );

	if ( isset( $_GET['tab'] ) && empty( $options['with_bg'] ) ) {
		$default_preloader = ( $_GET['tab'] === 'with_bg' ) ? true : false;
	} else {
		$default_preloader = false;
	}

	if ( isset( $_GET['tab'] ) && $_GET['tab'] === 'without_bg' && empty( $options['without_bg'] ) ) {
		$preview = 'egg';
	} elseif ( ! empty( $options['without_bg'] ) ) {
		$preview = 'selecting';
	} else {
		$preview = null;
	}

	if ( $preview === 'egg' ) : ?>
		<img src="<?php echo plugins_url( 'assets/img/bg-false/blue-egg.gif', __DIR__ ); ?>" alt="">
		<?php return; ?>
	<?php endif;

	if ( $default_preloader === true ) : ?>
		<img src="<?php echo plugins_url( 'assets/img/bg-true/drop.gif', __DIR__ ); ?>" alt="">
	<?php elseif ( ! empty( $options['with_bg'] ) ) : ?>
		<img src="<?php echo plugins_url( 'assets/img/bg-true/' . $options['with_bg'], __DIR__ ); ?>" alt="">
	<?php elseif ( ! empty( $options['without_bg'] ) ) : ?>
		<img src="<?php echo plugins_url( 'assets/img/bg-false/' . $options['without_bg'], __DIR__ ); ?>" alt="">
	<?php else : ?>
		<img src="<?php echo plugins_url( 'assets/img/bg-true/drop.gif', __DIR__ ); ?>" alt="">
	<?php endif;

}

/**
 * Ajax get preloader preview
 */
function sws_ajax_preloader_preview() {
	$selected_ajax = $_POST['preloader'];
	$tab = $_POST['tab'];
	$drop_loader = sws_set_selected( 'drop.gif', false );
	$options = get_option( 'sws_preloader_options' ); ?>

	<?php if ( $tab === 'without_bg' ) : ?>
		<img src="<?php echo plugins_url( 'assets/img/bg-false/' . $selected_ajax, __DIR__ ); ?>" alt="">
	<?php elseif ( !empty( $selected_ajax ) ) : ?>
		<img src="<?php echo plugins_url( 'assets/img/bg-true/' . $selected_ajax, __DIR__ ); ?>" alt="">
	<?php elseif (  $drop_loader === 'selected="true"' ) : ?>
		<img src="<?php echo plugins_url( 'assets/img/bg-true/drop.gif', __DIR__ ); ?>" alt="">
	<?php elseif ( ! empty( $options['with_bg'] ) ) : ?>
		<img src="<?php echo plugins_url( 'assets/img/bg-true/' . $options['with_bg'], __DIR__ ); ?>" alt="">
	<?php endif;

	wp_die();
}
add_action( 'wp_ajax_sws_ajax_preloader_preview', 'sws_ajax_preloader_preview' );

/**
 * Options page
 */
function sws_option_page(){
		$options = get_option( 'sws_preloader_options' );

		if ( isset( $options['sws-preloader-type'] ) && ! empty( $options['sws-preloader-type'] ) ) {
			$type = $options['sws-preloader-type'];
		}

		if ( isset( $_GET[ 'tab' ] ) ) {
			$active_tab = $_GET[ 'tab' ];
		} elseif ( isset( $options[ 'selected-tab' ] ) ) {
			$active_tab = $options[ 'selected-tab' ];
		} else {
			$active_tab = 'with_bg';
		}

	?>
	<div class="wrap">
		<h2 class="dashicons-before sws-header-icon dashicons-update">Preloader</h2>
	    <?php
		    if ( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) ) {
			    $tab = $_GET['tab'];
		    } else {
		    	$tab = '';
		    }
	    ?>
	    <h2 class="nav-tab-wrapper" data-tab="<?php echo $tab; ?>">
	        <a href="?page=sws-preloader-options&tab=with_bg" class="nav-tab <?php echo ( $active_tab == 'with_bg' ) ? 'nav-tab-active' : ''; ?>" >With background</a>
	        <a href="?page=sws-preloader-options&tab=without_bg" class="nav-tab <?php echo ( $active_tab == 'without_bg' ) ? 'nav-tab-active' : ''; ?>">Without background</a>
	        <a href="?page=sws-preloader-options&tab=upload_a_custom" class="nav-tab <?php echo ( $active_tab == 'upload_a_custom' ) ? 'nav-tab-active' : ''; ?>">Upload a custom</a>
	        <a href="?page=sws-preloader-options&tab=settings" class="nav-tab <?php echo ( $active_tab == 'settings' ) ? 'nav-tab-active' : ''; ?>">Settings</a>
	    </h2>
		<form method="post" action="options.php" enctype="multipart/form-data">
			<?php settings_fields( 'sws-preloader-options-group' ); ?>
			<table class="form-table">
				<?php if ( $active_tab === 'with_bg' ) : ?>
					<!-- Preloaders with background section -->
					<tr>
						<th>Preloaders with preset background</th>
						<td>
							<select name="sws_preloader_options[with_bg]" class="sws-pleloader-choose-select">

								<?php require_once( SWS_PLUGIN_DIR .  'includes/preloaders/dark.php' ); ?>
								<?php require_once( SWS_PLUGIN_DIR .  'includes/preloaders/light.php' ); ?>
								<?php require_once( SWS_PLUGIN_DIR .  'includes/preloaders/juicy.php' ); ?>

							</select>
						</td>
					</tr>
					<tr>
						<th>Preview <?php submit_button( 'Save settigns' ); ?></th>
						<td class="preview-with-bg">
							<div class="preloader-preview-box">
								<?php sws_the_preloader_preview(); ?>
							</div>
						</td>
					</tr>
					<input type="hidden" name="sws_preloader_options[selected-tab]" value="with_bg">
				<?php elseif ( $active_tab === 'without_bg' ) : ?>
					<!-- Preloaders without background section -->
					<tr>
						<th>Preloaders without preset background</th>
						<td class="sws-color-picker-inline">
							<?php require_once( SWS_PLUGIN_DIR .  'includes/preloaders/no-bg.php' ); ?>
						</td>
					</tr>
					<tr>
						<th>Background color</th>
						<td>
							<input type="text" id="sws-preloader-bg-color" name="sws_preloader_options[bg_color]" value="<?php echo $options['bg_color']; ?>" class="sws-color-picker" />
						</td>
					</tr>
					<tr>
						<th>Preview <?php submit_button( 'Save settigns' ); ?></th>
						<td class="preview-with-bg">
							<div class="preloader-preview-box" style="<?php echo ( ! empty( $options['bg_color'] ) ) ? 'background-color:' . $options['bg_color'] : ''; ?>">
								<?php sws_the_preloader_preview(); ?>
							</div>
						</td>
					</tr>
					<input type="hidden" name="sws_preloader_options[selected-tab]" value="without_bg">
				<?php elseif ( $active_tab === 'upload_a_custom' ) : ?>
					<!-- Custom preloader section -->
					<tr>
						<th>
							Upload preloader image <br>
							<i>( jpg, png, gif )</i>
						</th>
						<td>
							<button class="sws-button-select-file button button-secondary">Upload from computer</button>
							<input type="file" id="sws-preloader-custom-file" name="sws-preloader-custom-file" class="sws-invisible-input">
							<p class="condition"></p>
						</td>
					</tr>
					<tr>
						<th>
							Background color
						</th>
						<td>
							<input type="text" id="sws-preloader-bg-color" name="sws_preloader_options[custom_bg_color]" value="<?php echo $options['custom_bg_color']; ?>" class="sws-color-picker" />
						</td>
					</tr>
					<input type="hidden" name="sws_preloader_options[selected-tab]" value="upload_a_custom">
					<?php if ( ! empty( $options['file'] ) ) : ?>
						<tr>
							<th>Preview</th>
							<td>
								<img src="<?php echo $options['url'] ?>" alt="" class="custom-preloader">
							</td>
						</tr>
					<?php endif; ?>
					<tr>
						<th>
							<?php submit_button( 'Save settigns' ); ?>
						</th>
					</tr>
				<?php elseif ( $active_tab === 'settings' ) : ?>
					<!-- Settings section -->
					<tr>
						<th>
							How long it should be active<br>
							after page loaded
						</th>
						<td>
							<?php $timeout = ( ! empty( $options['sws-preloader-timeout'] ) ) ? $options['sws-preloader-timeout'] : 1000; ?>
							<input type="number" id="sws-preloader-timeout" name="sws_preloader_options[sws-preloader-timeout]" value="<?php echo $timeout ?>" class="small-text" />
						</td>
					</tr>
					<tr>
						<th>
							Activate only for frontpage
						</th>
						<td>
							<input type="checkbox" id="sws-preloader-only-frontpage" name="sws_preloader_options[sws-preloader-only-frontpage]" <?php echo ( $options['sws-preloader-only-frontpage'] == '1' ) ? 'checked="checked"' : ''; ?> value="1"/>
						</td>
					</tr>
					<tr>
						<th><?php submit_button( 'Save settings' ); ?></th>
					</tr>
				<?php endif; ?>
			</table>
		</form>

	</div>
	<div class="sws-rating-box">
	<br>
	<br>
	<br>
	<br>
		<h2>Thank you for using SWS Preloader! Do you like this plugin?</h2>
		<p>
			<a href="https://wordpress.org/support/view/plugin-reviews/preloader-sws#postform" class="button sws-rating-button" target="_blank"><i class="dashicons-before dashicons-smiley"></i>Yes</a>
			<a href="https://wordpress.org/support/plugin/preloader-sws#postform" class="button sws-rating-button" target="_blank">No</a>
		</p>
	</div>
	<?php
}
