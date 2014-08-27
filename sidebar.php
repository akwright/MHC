<?php
/**
 * @package MHC
 */
?>
<aside id="sidebar" role="complementary">
	<?php if ( !dynamic_sidebar( 'Post Right Aside' ) ) : ?>
		<h3>
			<?php _e( 'About This Site', 'mhc_theme' ); ?>
		</h3>
		<p><?php bloginfo( 'description' ); ?></p>
		<h3>
			<?php _e( 'Search', 'mhc_theme' ); ?>
		</h3>
		<?php get_search_form(); ?>
	<?php endif; ?>
</aside>