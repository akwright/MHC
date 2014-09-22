<?php
/**
* @package MHC
* Template Name: Home
*/
?>
<?php get_header(); ?>
<div id="content" class="content page container">
  <div class="row">
    <main class="content-primary" role="main">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : ?>
          <?php the_post(); ?>
          <article class="post clear" id="p<?php the_ID(); ?>">
            <section class="post-content clearfix">
              <?php the_content(); ?>
            </section>
          </article>
        <?php endwhile; endif; ?>
    </main>
  </div>
</div>
<?php get_footer(); ?>