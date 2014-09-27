<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<div id="content" class="content single product wrapper">
  <?php the_breadcrumb(); ?>
  <div class="row">
    <main class="content-primary" role="main">
      <?php while ( have_posts() ) : ?>
      <?php the_post(); ?>
      <article itemscope itemtype="http://schema.org/BlogPosting" class="post">
        <header class="post-header">
          <h1 class="post-title"><?php the_title(); ?></h1>
        </header>
        <?php if ( $post->post_excerpt ) : ?>
        <div id='excerpt'><?php the_excerpt(); ?></div>
        <?php endif; ?>
        <div id='content-main' class='row'>
          <section class='post-content clearfix'>
            <?php the_post_thumbnail( 'large' ); ?>
            <?php the_content(); ?>
            <?php wp_link_pages( 'before=<div class="pagination small"><span class="title">Pages:</span>&after=</div>' ); ?>
          </section>
          <div class='post-info'>
            <div id="prev-post" class="navigate nav-left clearfix">
              <?php
$prevPost = get_previous_post();
$prevThumbnail = get_the_post_thumbnail($prevPost->ID, array(110,110) );
previous_post_link( '%link', '<span class="icon-wrap">←</span><div><span>Previous Post</span><h3>%title</h3>'.$prevThumbnail.'</div>' );
              ?>
            </div>
            <div id="next-post" class="navigate nav-right clearfix">
              <?php
$nextPost = get_next_post();
$nextThumbnail = get_the_post_thumbnail($nextPost->ID, array(110,110) );
next_post_link( '%link', '<span class="icon-wrap">→</span><div><span>Next Post</span><h3>%title</h3>'.$nextThumbnail.'</div>' ); ?>
              <?php next_image_link(); ?>
            </div>
            <?php if ( !dynamic_sidebar( 'Post Left Aside' ) ) : ?>
            <?php endif; ?>
          </div>
        </div>
        <?php if ( is_active_sidebar( 'widget-postfooter' ) ) : ?>
        <footer id="post-footer" class='row'>
          <?php if ( !dynamic_sidebar( 'Post Footer' ) ) : ?>
          <?php endif; ?>
        </footer>
        <?php endif; ?>
      </article>
      <?php endwhile; ?>      
      <?php comments_template(); ?>
    </main>
  </div>
</div>
<?php get_footer(); ?>