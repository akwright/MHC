				<h3 class="type-title"><?php _e('Performance Settings', 'mhc_theme'); ?></h3>

					<?php

					wp_nonce_field( 'mhc_update_performance', 'mhc_performance_key' );
					$mhc_updated = false;

					// PULL EXISTING SECTIONS, IF PRESENT
					$mhc_performance = get_option('_mhc_options');

					if (!empty($_POST) && wp_verify_nonce($_POST['mhc_performance_key'], 'mhc_update_performance')) {
						$mhc_performance['remove_script_version'] = mhc_post_value_or_default('mhc-performance-remove-script-version', false);
						$mhc_performance['remove_style_version'] = mhc_post_value_or_default('mhc-performance-remove-style-version', false);
						$mhc_performance['remove_wordpress_version'] = mhc_post_value_or_default('mhc-performance-remove-wordpress-version', false);
						

						update_option( '_mhc_options', $mhc_performance );
						$mhc_updated = true;

					}

					// IF THERE'S NOTHING, SET DEFAULTS
					if(empty($mhc_performance)) {

						$mhc_performance = array(
							'remove_script_version'               => false,
							'remove_style_version'                => false,
							'remove_wordpress_version'            => false
						);

					} ?>

					<div class="button-container">

						<input type="submit" name="submit"  class="save-settings" value="<?php _e('Update Settings', 'mhc_theme'); ?>" />

						<?php mhc_update_settings_button($mhc_updated); ?>

					</div><!-- // BUTTON CONTAINER -->

					
					<!-- REMOVE WORDPRESS VERSION -->
					<div id="first-option" class="option-container">
						<div class="feature">
							<input type="checkbox"
									 name="mhc-performance-remove-wordpress-version"
									 class="checkbox"
									 value="remove_wordpress_version" 
									<?php checked( mhc_get_option('remove_wordpress_version')); ?>
								/>

							<label for="mhc-performance-remove-wordpress-version">
								<?php _e('Remove WordPress version meta tag.', 'mhc_theme'); ?>
							</label>
						</div>
						<div class="feature-desc">
							<?php
								_e('There are potential security risks associated with exposing your version of WordPress. Removing this meta tag will also shave a few bytes off of the generated HTML.', 'mhc_theme');
							?>
						</div>
						<div style="clear:both;"></div>
					</div>
					<!-- REMOVE SCRIPT VERSION -->
					<div class="option-container">
						<div class="feature">
							<input type="checkbox"
									 name="mhc-performance-remove-script-version"
									 class="checkbox"
									 value="remove_script_version" 
									<?php checked( mhc_get_option('remove_script_version')); ?>
								/>

							<label for="mhc-performance-remove-script-version">
								<?php _e('Remove version URL parameter from scripts.', 'mhc_theme'); ?>
							</label>
						</div>
						<div class="feature-desc">
							<?php
								_e('The version URL parameter can prevent files from caching in certain browsers. If you want more reliable caching of your scripts, turn this feature on.', 'mhc_theme');
							?>
						</div>
						<div style="clear:both;"></div>
					</div>
					<!-- REMOVE SCRIPT VERSION -->
					<div class="option-container">
						<div class="feature">
							<input type="checkbox"
									 name="mhc-performance-remove-style-version"
									 class="checkbox"
									 value="remove_style_version" 
									<?php checked( mhc_get_option('remove_style_version')); ?>
								/>

							<label for="mhc-performance-remove-style-version">
								<?php _e('Remove version URL parameter from stylesheets.', 'mhc_theme'); ?>
							</label>
						</div>
						<div class="feature-desc">
							<?php
								_e('The version URL parameter can prevent files from caching in certain browsers. If you want more reliable caching of your stylesheets, turn this feature on.', 'mhc_theme');
							?>
						</div>
						<div style="clear:both;"></div>
					</div>




					<!--
					<div class="wrap">
<div id="icon-options-general" class="icon32"><br></div><h2>Permalink Settings</h2><div id="message" class="updated"><p>You should update your .htaccess now.</p></div>

<form name="form" action="options-permalink.php" method="post">
<input type="hidden" id="_wpnonce" name="_wpnonce" value="88a9389a02"><input type="hidden" name="_wp_http_referer" value="/wp-admin/options-permalink.php">
  <p>By default WordPress uses web <abbr title="Universal Resource Locator">URL</abbr>s which have question marks and lots of numbers in them, however WordPress offers you the ability to create a custom URL structure for your permalinks and archives. This can improve the aesthetics, usability, and forward-compatibility of your links. A <a href="http://codex.wordpress.org/Using_Permalinks">number of tags are available</a>, and here are some examples to get you started.</p>

<h3>Common Settings</h3>
<table class="form-table permalink-structure">
	<tbody><tr>
		<th><label><input name="selection" type="radio" value=""> Default</label></th>
		<td><code>http://mhc.local/?p=123</code></td>
	</tr>
	<tr>
		<th><label><input name="selection" type="radio" value="/%year%/%monthnum%/%day%/%postname%/" checked="checked"> Day and name</label></th>
		<td><code>http://mhc.local/2013/05/17/sample-post/</code></td>
	</tr>
	<tr>
		<th><label><input name="selection" type="radio" value="/%year%/%monthnum%/%postname%/"> Month and name</label></th>
		<td><code>http://mhc.local/2013/05/sample-post/</code></td>
	</tr>
	<tr>
		<th><label><input name="selection" type="radio" value="/archives/%post_id%"> Numeric</label></th>
		<td><code>http://mhc.local/archives/123</code></td>
	</tr>
	<tr>
		<th><label><input name="selection" type="radio" value="/%postname%/"> Post name</label></th>
		<td><code>http://mhc.local/sample-post/</code></td>
	</tr>
	<tr>
		<th>
			<label><input name="selection" id="custom_selection" type="radio" value="custom">
			Custom Structure			</label>
		</th>
		<td>
			<code>http://mhc.local</code>
			<input name="permalink_structure" id="permalink_structure" type="text" value="/%year%/%monthnum%/%day%/%postname%/" class="regular-text code">
		</td>
	</tr>
</tbody></table>

<h3>Optional</h3>
<p>If you like, you may enter custom structures for your category and tag <abbr title="Universal Resource Locator">URL</abbr>s here. For example, using <code>topics</code> as your category base would make your category links like <code>http://example.org/topics/uncategorized/</code>. If you leave these blank the defaults will be used.</p>

<table class="form-table">
	<tbody><tr>
		<th><label for="category_base">Category base</label></th>
		<td> <input name="category_base" id="category_base" type="text" value="" class="regular-text code"></td>
	</tr>
	<tr>
		<th><label for="tag_base">Tag base</label></th>
		<td> <input name="tag_base" id="tag_base" type="text" value="" class="regular-text code"></td>
	</tr>
	</tbody></table>


<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>  </form>
<p>If your <code>.htaccess</code> file were <a href="http://codex.wordpress.org/Changing_File_Permissions">writable</a>, we could do this automatically, but it isn’t so these are the mod_rewrite rules you should have in your <code>.htaccess</code> file. Click in the field and press <kbd>CTRL + a</kbd> to select all.</p>
<form action="options-permalink.php" method="post">
<input type="hidden" id="_wpnonce" name="_wpnonce" value="88a9389a02"><input type="hidden" name="_wp_http_referer" value="/wp-admin/options-permalink.php">	<p><textarea rows="6" class="large-text readonly" name="rules" id="rules" readonly="readonly">&lt;IfModule mod_rewrite.c&gt;
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
&lt;/IfModule&gt;
</textarea></p>
</form>
	
</div>
-->