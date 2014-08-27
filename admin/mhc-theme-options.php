<?php

// CREATE THE SETTINGS TABS IN WP ADMIN
if (!function_exists('mhc_admin_tabs')) {
function mhc_admin_tabs($current = 'general') {

	$tabs = array( 'general' => __('General Settings', 'mhc_theme'),
									'home' => __('Home Page Settings', 'mhc_theme'),
									'performance' => __('Performance Settings', 'mhc_theme'));

	echo '<div id="icon-themes" class="icon32"><br></div>';
	echo '<h2 class="nav-tab-wrapper">';

	foreach($tabs as $tab => $name) {

		$class = ($tab == $current) ? ' nav-tab-active' : '';

				echo "<a class='nav-tab$class' href='?page=mhc-settings&tab=$tab'>$name</a>";

		}

		echo '</h2>';

}
}

// OPTIONS HELPER FUNCTIONS

if(!function_exists('mhc_add_warning')) {
	$mhc_warnings = array();
	function mhc_add_warning($warning_message) {
		global $mhc_warnings;
		$mhc_warnings[] = $warning_message;
	}
}

if(!function_exists('mhc_post_value_or_default')) {
	function mhc_post_value_or_default($val_name, $default) {

		$val = isset($_POST[$val_name]) ? $_POST[$val_name] : $default;
		switch (gettype($default)) {
			case "boolean":
				if (is_string($val)) {
					return $val != "";
				}
				return (bool)$val; // boolval() only exists in PHP >= 5.5.0
			case "integer":
				return intval($val);
			case "string":
				return strval($val);
			case "double":
				return doubleval($val);
			case "array":
				return is_array($val) ? $val : $default;
		}
		// We should never reach this point
		mhc_add_warning("The type of option '" . $val_name . "' couldn't be determined.");
		return $val;
	}
}

if(!function_exists('mhc_update_settings_button')) {
	function mhc_update_settings_button($updated) {
		if ($updated) {
			echo '<h4 class="saved-success">';
				echo '<img src="'.get_template_directory_uri().'/admin/images/success.png" />';
				_e('mhc\'s Settings Have Been Updated.', 'mhc_theme');
			echo '</h4>';

		} else {

			echo '<h4 class="info">';
				_e('Make Changes And Use The Update Settings Button To Save!', 'mhc_theme');
				echo ' &rarr;';
			echo '</h4>';
		}
	}
}

// BUILD THE CONTENT THAT DISPLAYS IN THEME SETTINGS
if (!function_exists('mhc_build_settings_page')) {
function mhc_build_settings_page() {
	global $pagenow;

	// SET FILE DIRECTORY
	$file_dir = get_template_directory_uri();
	
	// SETUP NEEDED STYLES & SCRIPTS FOR OPTIONS PAGE
	//wp_enqueue_script('jquery-ui-sortable' );
	//wp_enqueue_script('mhc-admin', $file_dir . '/admin/js/mhc-utils.js', 'jquery', NULL, TRUE);
	//wp_enqueue_style('mhc-admin', $file_dir . '/admin/css/mhc-options.css', NULL, NULL, NULL);

	// SET DEFAULT DATA FOR FIRST RUN
	$mhc_defaults = array(
		'header'            => true,
		'title'             => 'Section Title',
		'caption'           => 'Section Caption',
		'num_posts'         => 10
	);

	?>

	<div class="wrap">

		<h2>
			<?php _e('mhc Theme Settings', 'mhc_theme'); ?>
		</h2>

		<?php if (isset($_GET['tab'])) { mhc_admin_tabs($_GET['tab']); } else { mhc_admin_tabs('general'); } ?>

		<form method="post" action="">

			<div id="settings-container"> <?php
			
			
			if ($pagenow == 'themes.php' && $_GET['page'] == 'mhc-settings') {

				if (isset($_GET['tab'])) { $tab = $_GET['tab']; } else { $tab = 'general'; }

				switch ($tab) {

					// SETUP OPTIONS FOR GENERAL TAB
					case 'general' : 
						require_once 'mhc-theme-options-general.php';
						break;

					case 'home' :
						require_once 'mhc-theme-options-home.php';
						break; // END CASE "HOME"

					case 'performance' : 
						require_once 'mhc-theme-options-performance.php';
						break;

					} // END CASE "PERFORMANCE"

				} /* END SWITCH STATEMENT */ ?>

				<div class="button-container bottom">

					<input type="submit" name="submit"  class="save-settings" value="<?php _e('Update Settings', 'mhc_theme'); ?>" />

				<?php mhc_update_settings_button($mhc_updated); ?>

				</div><!-- // BUTTON CONTAINER -->

			</div><!-- // SETTINGS CONTAINER -->

		</form><!-- // END FORM -->
		
		<?php
			global $mhc_warnings;
			if (defined('WP_DEBUG')  && (WP_DEBUG == true)) {
				if (isset($mhc_warnings)) {
					foreach ($mhc_warnings as $warning) {
						echo "<p><b>Warning from mhc:</b> " . $warning . "</p>";
					}
				}
			}
		?>

	</div><!-- // WRAP -->

<?php } } ?>