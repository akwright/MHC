<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<div id="content" class="archive staff grid-cols container">
  <div class="row">
    <main class="content-primary" role="main">
      <?php if ( have_posts() ) : ?>
      <header>
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <h1 class="page-title">Staff</h1>
      </header>
      <div class="posts clearfix row collapse">
        <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'partials/posts/post', 'staff' ); ?>
        <?php endwhile; ?>
      </div>
    </main>
    <?php get_template_part( 'partials/post-pagination' ); ?>
    <?php else : ?>
    <div class="post empty">
      <header><h1>Page Not Found</h1></header>
      <section>
        <p>Looks like the page you're looking for isn't here anymore. Try using the search box below.</p>
        <?php get_search_form( true ); ?>
      </section>
    </div>
    <?php endif; ?>
  </div>
</div>
<?php get_footer(); ?>