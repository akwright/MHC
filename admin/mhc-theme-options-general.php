<h3 class="type-title"><?php _e('General Settings', 'mhc_theme'); ?></h3>

<?php

wp_nonce_field( 'mhc_update_general', 'mhc_general_key' );
$mhc_updated = false;

// PULL EXISTING SECTIONS, IF PRESENT
$mhc_general = get_option('_mhc_options');

if (!empty($_POST) && wp_verify_nonce($_POST['mhc_general_key'], 'mhc_update_general')) {
	$mhc_general['header'] = mhc_post_value_or_default('mhc-general-header', '');
	$mhc_general['footer'] = mhc_post_value_or_default('mhc-general-footer', '');
	$mhc_general['tweet_post_button'] = mhc_post_value_or_default('mhc-general-tweet-post-button', false);
	$mhc_general['tweet_post_attribution'] = mhc_post_value_or_default('mhc-general-tweet-post-attribution', '');

	update_option( '_mhc_options', $mhc_general );
	$mhc_updated = true;

}

// IF THERE'S NOTHING, SET DEFAULTS
if(empty($mhc_general)) {

	$mhc_general = array(
		'header'                => '',
		'footer'                  => '',
		'tweet_post_button'       => false,
		'tweet_post_attribution'    => '',
	);

} ?>

<div class="button-container">

	<input type="submit" name="submit"  class="save-settings" value="<?php _e('Update Settings', 'mhc_theme'); ?>" />

	<?php mhc_update_settings_button($mhc_updated); ?>

</div><!-- // BUTTON CONTAINER -->

<!-- CUSTOM HEADER CODE -->
<div id="first-option" class="option-container">
	<label class="feature-title"><?php _e('Custom Header Code', 'mhc_theme'); ?></label>
	<div class="feature">
		<textarea name="mhc-general-header" class="textarea"><?php echo esc_html(stripslashes(mhc_get_option('header'))); ?></textarea>
	</div>
	<div class="feature-desc">
		<?php
			_e('This feature allows you to write or copy and paste your own code straight into the header. Many people use this feature to include their Google Analytics code, or other small bits of Javascript. Feel free to use this as you wish!', 'mhc_theme');
		?>
	</div>
	<div style="clear:both;"></div>
</div>


<!-- CUSTOM FOOTER CODE -->
<div class="option-container">
	<label class="feature-title"><?php _e('Custom Footer Code', 'mhc_theme'); ?></label>
	<div class="feature">
		<textarea name="mhc-general-footer" class="textarea"><?php echo esc_html(stripslashes(mhc_get_option('footer'))); ?></textarea>
	</div>
	<div class="feature-desc">
	<?php
		_e('This feature allows you to write or copy and paste your own code directly to the footer. A lot of people use this feature to include external and internal Javascript files, for plugins and things of the sort. Use it as you wish!', 'mhc_theme');
	?>
	</div>
	<div style="clear:both;"></div>
</div>
<!-- TWEET THIS OPTION -->
<div class="option-container">
	<label class="feature-title"><?php _e('Tweet This', 'mhc_theme'); ?></label>
	<div class="feature">
		<input type="checkbox"
				 name="mhc-general-tweet-post-button"
				 class="checkbox"
				 value="tweet_post_button" 
				<?php checked( mhc_get_option('tweet_post_button')); ?>
			/>

		<label for="mhc-general-tweet-post-button">
			<?php _e('Add a "Tweet This Post" Button to Post Templates.', 'mhc_theme'); ?>
		</label>
	</div>
	<div class="feature-desc">
		<?php
			_e('This feature gives you the option to integrate a little bit of social networking directly into your posts. By turning this feature on, we\'ll automatically create a "Tweet" Button people can use to share your content!', 'mhc_theme');
		?>
	</div>
	<div style="clear:both;"></div>
</div>
<!-- TWEET THIS HANDLE -->
<div class="option-container optional-container" controlling-checkbox="mhc-general-tweet-post-button">
	<label class="feature-title"><?php _e('Twitter Handle', 'mhc_theme'); ?></label>
	<div class="feature">
		<input type="text"
				 name="mhc-general-tweet-post-attribution"
				 class="text"
				 value="<?php echo esc_attr(stripslashes(mhc_get_option('tweet_post_attribution'))); ?>" />
	</div>
	<div class="feature-desc">
		<?php
			_e('By entering your handle once right here, you can easily reference this setting throughout the theme and change it later with ease, if needed. Refrain from using the \'@\' sign. An example handle: \'somerandomdude\'.', 'mhc_theme');
		?>
	</div>
	<div style="clear:both;"></div>
</div>  