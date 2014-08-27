<h3 class="type-title">
	<?php _e('Home Page Settings', 'mhc_theme'); ?>
</h3>
	<?php

	wp_nonce_field('mhc_update_home_sections', 'mhc_key');

	// GET EXISTING SECTIONS, IF PRESENT
	$mhc_sections = get_option('_mhc_options');
	$mhc_updated  = false;
	if (!empty($_POST) && wp_verify_nonce($_POST['mhc_key'], 'mhc_update_home_sections')) {

		$sections     = array();

		foreach($_POST as $key => $value) {

			$keyflag = 'mhc-display-type-';

			if(substr($key, 0, strlen($keyflag)) == $keyflag) {

				// FIND ID FLAG
				$mhc_section_flag = substr($key, strlen($keyflag), strlen($key));

				// SINCE WE'RE PIGGY-BACKING SOME WP CORE FUNCTIONALTITY, THE POST
				// CATEGORIES HAVE A SLIGHTLY DIFFERENT ID DEPENDING ON WHAT WAS FIRST

				if($mhc_section_flag == 'default') {

					echo $mhc_post_category_flag = '';

				} else {

					$mhc_post_category_flag = '-' . $mhc_section_flag;

				}

				// ADD OUR DATA
				$sections[] = array(
					'display_type'      => mhc_post_value_or_default('mhc-display-type-' . $mhc_section_flag, 'default_loop'),
					'header'      => mhc_post_value_or_default('mhc-section-header-' . $mhc_section_flag, false),
					'title'      => mhc_post_value_or_default('mhc-section-title-' . $mhc_section_flag, ''),
					'caption'      => mhc_post_value_or_default('mhc-section-caption-' . $mhc_section_flag, ''),
					'num_posts'      => mhc_post_value_or_default('mhc-section-num-posts-' . $mhc_section_flag, 10),
					'categories'      => mhc_post_value_or_default('post_category-' . $mhc_section_flag, array()),
				);

			}

		} // END FOREACH LOOP

		$mhc_sections['sections'] = $sections;
		update_option('_mhc_options', $mhc_sections);
		$mhc_updated = true;

	}

	$mhc_sections = $mhc_sections['sections'];

	// IF NOTHING'S SET, SET DEFAULTS
	if(empty($mhc_sections)) {

		$mhc_sections['sections'] = array(
			'display_type'      => 'default_loop',
			'header'             => false,
			'title'             => '',
			'caption'           => '',
			'num_posts'         => 10,
			'categories'        => array(),
			'default'           => true
		);

	} ?>

	<div class="button-container">

		<input type="submit" name="submit"  class="save-settings" value="<?php _e('Update Settings', 'mhc_theme'); ?>" />

	<?php mhc_update_settings_button($mhc_updated); ?>

	</div><!-- // BUTTON CONTAINER --> 
	
	<div class="helper-container">
		<p class="section-helper">
			<?php
				_e('Content Sections give you the opportunity to create a dynamic homepage for you to keep your readers engaged. With a vast variety of different layouts, you have the choice to select a look that works best for you.', 'mhc_theme');
			?>
		</p>
	</div>

	<div style="clear:both;"></div>

	<div id="mhc-content-sections">           
	<?php

	foreach($mhc_sections as $mhc_section_id => $mhc_section) : ?>

	<div class="mhc-content-sections" id="mhc-street-section-<?php echo $mhc_section_id; ?>">

		<h3 class="content-titles">
			<?php _e('Content Section', 'mhc_theme'); ?>
			<span class="mhc-handle"></span>
			<a class="mhc-content-section-delete" href="#">&times;</a>
		</h3>

		<div class="content-group">
			<?php
			$the_type = $mhc_section['display_type'];
			$checkbox_name = "mhc-section-header-" . (isset($mhc_section['default']) ? 'default' : $mhc_section_id);
			?>
			<div class="main-options-container">
				<!-- // DISPLAY TYPES -->
				<div class="display-types">
					<label class="section-title"><?php _e('Display Type:', 'mhc_theme'); ?></label>
					<select name="mhc-display-type-<?php echo (isset($mhc_section['default']) ? 'default' : $mhc_section_id); ?>" class="dropmenu option-display-type">
						<option<?php if($the_type == 'default_loop') { ?> selected="selected"<?php } ?> value="default_loop"><?php _e('Default Loop', 'mhc_theme'); ?></option>
						<option<?php if($the_type == 'one_up_reg' ) { ?> selected="selected"<?php } ?> value="one_up_reg"><?php _e('One Up (Regular)', 'mhc_theme'); ?></option>
						<option<?php if($the_type == 'one_up_lg' ) { ?> selected="selected"<?php } ?> value="one_up_lg"><?php _e('One Up (Large)', 'mhc_theme'); ?></option>
						<option<?php if($the_type == 'two_up' ) { ?> selected="selected"<?php } ?> value="two_up"><?php _e('Two Up', 'mhc_theme'); ?></option>
						<option<?php if($the_type == 'three_up' ) { ?> selected="selected"<?php } ?> value="three_up"><?php _e('Three Up', 'mhc_theme'); ?></option>
						<option<?php if($the_type == 'four_up' ) { ?> selected="selected"<?php } ?> value="four_up"><?php _e('Four Up', 'mhc_theme'); ?></option>
						<option<?php if($the_type == 'srd_loop' ) { ?> selected="selected"<?php } ?> value="srd_loop"><?php _e('Some Random Dude Loop', 'mhc_theme'); ?></option>
					</select>
				</div>
				<div style="clear:both;"></div>
			</div>
			
			<div class="top-options-container">

				

				<!-- // SECTION HEADER TOGGLE -->
				<div class="display-headers">
					<input type="checkbox"
					 name=<?php echo $checkbox_name ?>
					class="checkbox"
					value="section_header"
					<?php 
					$value = !isset($mhc_section['default']) ? stripslashes($mhc_section['header']) : $mhc_defaults['header'];
					checked($value); 
					?>
					/>
					<label class="section-title inline">
					<?php
						_e('Display section header', 'mhc_theme');
					?>
					</label>
				</div>

				<!-- // SECTION TITLE -->
				<div class="display-titles optional-container" controlling-checkbox=<?php echo $checkbox_name ?> >
					<label class="section-title"><?php _e('Section Title:', 'mhc_theme'); ?></label>
					<input type="text"
							 class="text text-title"
							 name="mhc-section-title-<?php echo (isset($mhc_section['default']) ? 'default' : $mhc_section_id); ?>"
							 <?php
								$val_str = isset($mhc_section['default']) ?  $mhc_defaults['title'] : stripslashes($mhc_section['title']);
								echo 'value="' . esc_attr($val_str) . '"';
							 ?>
					/>
				</div>
				
				<!-- // POSTS TO DISPLAY -->
				<div class="display-posts">
					<label class="section-title"><?php _e('Number of Posts:', 'mhc_theme'); ?></label>
					<input type="text"
							 class="text"
							 name="mhc-section-num-posts-<?php echo (isset($mhc_section['default']) ? 'default' : $mhc_section_id); ?>"
							 <?php
								$val_str = isset($mhc_section['default']) ?  $mhc_defaults['num_posts'] : stripslashes($mhc_section['num_posts']);
								echo 'value="' . esc_attr($val_str) . '"';
							 ?>
						/>
				</div>

			</div><!-- // END TOP OPTIONS CONTAINER -->
			</div>
			<div style="clear:both;"></div>

			<div class="bottom-options-container">
				
				<!-- // SECTION CAPTIONS -->
				<div class="display-captions optional-container" controlling-checkbox=<?php echo $checkbox_name ?> >
					<label class="section-title"><?php _e('Section Caption:', 'mhc_theme'); ?></label>
					<textarea name="mhc-section-caption-<?php echo (isset($mhc_section['default']) ? 'default' : $mhc_section_id); ?>"
						<?php
							$caption_txt = isset($mhc_section['default']) ? $mhc_defaults['caption'] : stripslashes($mhc_section['caption']);
							echo 'class="textarea">' . esc_textarea($caption_txt);
						?>
					</textarea>
				</div>
				
				
				<!-- // CATEGORIES TO DISPLAY -->
				<div class="display-categories">
					<label class="section-title"><?php _e('Categories to Display', 'mhc_theme'); ?></label>
					<div class="categories-container">
						<ul class="categorychecklist">
							<?php wp_terms_checklist(); ?>
						</ul>
						
						<div style="clear:both;"></div>
						
						<ul class="mhc-group">
							<li><a class="select-button mhc-select" href="#"><?php _e('Select All', 'mhc_theme'); ?></a></li>
							<li><a class="select-button mhc-deselect" href="#"><?php _e('Deselect All', 'mhc_theme'); ?></a></li>
						</ul>
						<div style="clear:both;"></div>
					</div>

					<div style="clear:both;"></div>

					<?php $categories = $mhc_section['categories']; ?>
					
					<script type="text/javascript">
					jQuery(document).ready(function() {
						<?php if (is_array($categories)) : ?>
						<?php foreach($categories as $category) : ?>

							jQuery('#mhc-street-section-<?php echo $mhc_section_id; ?> .categorychecklist input').each(function(){

								if(jQuery(this).val() == <?php echo $category; ?>) {

									jQuery(this).attr('checked', true);

								}

							});

						<?php endforeach; ?>
						<?php endif; ?>

					});
					</script>

				</div>

			</div><!-- //  END BOTTOM OPTIONS CONTAINER -->

			<div style="clear:both;"></div>

		

		<div style="clear:both;"></div>

	</div><!-- // mhc CONTENT SECTIONS --> <?php 
	
	endforeach; ?>
</div>
<div id="mhc-add-content-section">
	<a href="#"><?php _e('+ Add New Section +', 'mhc_theme'); ?></a>
</div>