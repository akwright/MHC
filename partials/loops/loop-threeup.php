<?php
global $mhc_section_header;
global $mhc_section_title;
global $mhc_section_caption;
?>
<div class='post-group threeup row'>
	<?php if ( isset( $mhc_section_header ) && $mhc_section_header ) : ?>
	<div class='nav post-group-header'>
		<span class='label'><?php echo( $mhc_section_title ); ?></span>
		<?php $view_more_label = __( 'View more', 'mhc_theme' ); ?>
		<span class='caption'><?php echo( $mhc_section_caption ) ?></span> <span class='more'>
			<?php next_posts_link( $view_more_label . '&hellip;' ); ?>
		</span>
	</div>
	<?php endif; ?>
	<div class='contents row'>
	<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
		<?php get_template_part( 'partials/posts/post', 'small' ); ?>
	<?php endwhile; ?>
	</div>
</div>