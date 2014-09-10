<?php
/**
 * @package MHC
 */
?>
<!DOCTYPE html>
<!--[if IE 7 | IE 8]>
<html class="ie" lang="en-US">
<![endif]-->
<!--[if (gte IE 9) | !(IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	<title>
		<?php
		wp_title( '&mdash;', true, 'right' );
		bloginfo( 'name' );
		?>
	</title>

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
    <?php if ( ! is_admin ) : ?>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro|Bitter">
    <?php endif; ?>
</head>
<body id="page" <?php body_class('no-bg'); ?>>
	<!--[if lt IE 9]>
		<div class="chromeframe">Your browser is out of date. Please <a href="http://browsehappy.com/">upgrade your browser </a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a>.</div>
	<![endif]-->
  <div class="site-wrapper">
    
    <header id="page-header" class="page-header container row">
      <h1 class="site-logo">
        <a href="<?php echo home_url(); ?>">
          <?php //if (is_front_page()) : ?>
          <img src="<?php bloginfo('template_url') ?>/images/mhc-logo_whitec.png" alt="<?php bloginfo( 'name' ); ?>">
          <?php //else : ?>
          <!--<img src="<?php //bloginfo('template_url') ?>/images/mhc-logo.jpg" alt="<?php //bloginfo( 'name' ); ?>">-->
          <?php //endif; ?>
        </a>
      </h1>
      
      <a id="menu-trigger" class="menu-trigger">MENU</a>
      <nav class="site-nav" role="navigation">
        <?php if ( !dynamic_sidebar( 'Navigation' ) ) : ?>
        <?php wp_nav_menu( array( 'theme_location' => 'mhc_primary_navigation', 'container' => false ) ); ?>
        <?php endif; ?>
      </nav>
    </header>
    <?php
      $header_image = get_header_image();
      if ( $header_image ) :
        if ( function_exists( 'get_custom_header' ) ) {
          $header_image_width = get_theme_support( 'custom-header', 'width' );
        } else {
          $header_image_width = HEADER_IMAGE_WIDTH;
        }

        if ( is_singular() && has_post_thumbnail( $post->ID ) &&
           ( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 
             array( $header_image_width, $header_image_width ) ) ) &&
             $image[1] >= $header_image_width ) :
          $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
          ?>
    <section id="featured-image" class="featured-image row" style="background: url('<?php echo $url; ?>') no-repeat center; background-size: cover;">
        <?php
        else :
          if ( function_exists( 'get_custom_header' ) ) {
            $header_image_width  = get_custom_header()->width;
            $header_image_height = get_custom_header()->height;
          } else {
            $header_image_width  = HEADER_IMAGE_WIDTH;
            $header_image_height = HEADER_IMAGE_HEIGHT;
          }
        ?>
    <section id="featured-image" class="featured-image row" style="background: url('<?php header_image(); ?>') no-repeat center; background-size: cover;">
      <?php endif; ?>
    <?php endif; ?>
      <div class="js-featured_text">
        <?php
          $featured_text = get_post_meta( get_the_ID(), '_mhc_featured_text', true );
          if ( ! empty( $featured_text ) ) {
            echo  $featured_text;
          } else if ( is_archive() ) {
            $post_type_data = get_post_type_object( $post_type );
            $post_type_slug = $post_type_data->rewrite['slug'];
            echo "<h2>".$post_type_slug."</h2>";
          } else {
        ?>
        <h2><?php the_title(); ?></h2>
        <?php } ?>
<!--        <span>Scroll</span>-->
      </div>
    </section>