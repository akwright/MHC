<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<main id="content" class="content container home" role="main">
	<?php
	$mhc_sections = get_option( '_mhc_options' );
	$mhc_sections = $mhc_sections['sections'];
	global $mhc_section_type, $mhc_section_header, $mhc_section_title, $mhc_section_caption, $mhc_section_num_posts, $mhc_section_categories;
	if ( $mhc_sections ) {
		foreach ( $mhc_sections as $section ) {
			$mhc_section_type       = $section['display_type'];
			$mhc_section_header     = $section['header'];
			$mhc_section_title      = $section['title'];
			$mhc_section_caption    = $section['caption'];
			$mhc_section_num_posts  = $section['num_posts'];
			$mhc_section_categories = $section['categories'];
			$mhc_paged              = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

			/* TODO: Clean this up */
			switch ( $mhc_section_type ) {
				case 'srd_loop':
					$wp_query = new WP_Query( array( 'posts_per_page' => $mhc_section_num_posts, 'cat' => implode( ',', array_filter( $mhc_section_categories ) ), 'paged' => $mhc_paged ) );
					get_template_part( 'partials/loops/loop', 'srd' );
					break;
				case 'one_up_reg':
					$wp_query = new WP_Query( array( 'posts_per_page' => $mhc_section_num_posts, 'cat' => implode( ',', array_filter( $mhc_section_categories ) ), 'paged' => $mhc_paged ) );
					get_template_part( 'partials/loops/loop', 'oneup' );
					break;
				case 'one_up_lg':
					$wp_query = new WP_Query( array( 'posts_per_page' => $mhc_section_num_posts, 'cat' => implode( ',', array_filter( $mhc_section_categories ) ), 'paged' => $mhc_paged ) );
					get_template_part( 'partials/loops/loop', 'oneuplarge' );
					break;
				case 'two_up':
					$wp_query = new WP_Query( array( 'posts_per_page' => $mhc_section_num_posts, 'cat' => implode( ',', array_filter( $mhc_section_categories ) ), 'paged' => $mhc_paged ) );
					get_template_part( 'partials/loops/loop', 'twoup' );
					break;
				case 'three_up':
					$wp_query = new WP_Query( array( 'posts_per_page' => $mhc_section_num_posts, 'cat' => implode( ',', array_filter( $mhc_section_categories ) ), 'paged' => $mhc_paged ) );
					get_template_part( 'partials/loops/loop', 'threeup' );
					break;
				case 'four_up':
					$wp_query = new WP_Query( array( 'posts_per_page' => $mhc_section_num_posts, 'cat' => implode( ',', array_filter( $mhc_section_categories ) ), 'paged' => $mhc_paged ) );
					get_template_part( 'partials/loops/loop', 'fourup' );
					break;
				default :
					get_template_part( 'partials/loops/loop' );
			}
		}
	} else {
		//Insert default loop
		get_template_part( 'partials/loops/loop' );
	}
	?>
	<?php get_template_part( 'partials/post-pagination' ); ?>
</main>
<?php get_footer(); ?>