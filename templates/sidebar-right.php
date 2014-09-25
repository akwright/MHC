<?php
/**
 * @package MHC
 */
/*
Template Name: Right Sidebar
*/
?>
<?php get_header(); ?>
  <div id="content" class="content archive grid-cols container">
    <?php the_breadcrumb(); ?>
    <div class="row">
      <main class="content-inner small-12 medium-9 columns" role="main">
        <?php
          $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
        ?>
        <img src="<?php echo $url; ?>" alt="Post Featured Image">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <article class="post" id="p<?php the_ID(); ?>">
            <header class="post-header">
              <h1 class="page-title"><?php the_title(); ?></h1>
            </header>
            <section class="post-content">
              <?php the_content(); ?>
            </section>
          </article>
        <?php endwhile; endif; ?>
      </main>
      <?php get_template_part( 'partials/sidebars/sidebar', 'page' ); ?>
    </div>
  </div>
<?php get_footer(); ?>