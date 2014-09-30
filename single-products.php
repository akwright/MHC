<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<div id="content" class="content single product wrapper">
  <?php the_breadcrumb(); ?>
  <div class="row">
    <main class="content-inner small-12 columns" role="main">
      <?php while ( have_posts() ) : ?>
      <?php the_post(); ?>
      <article itemscope itemtype="http://schema.org/BlogPosting" class="post small-12 medium-10 medium-centered columns">
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
      <div id="prev-post" class="navigate nav-left">
        <?php
          $prevPost = get_previous_post();
          $prevThumbnail = get_the_post_thumbnail($prevPost->ID, array(110,110) );
          previous_post_link(
            '%link',
            '<div class="paginate clearfix"><div class="paginate-content"><span class="paginate-header">Previous Product</span><h3 class="paginate-title">%title</h3></div>'.$prevThumbnail.'</div>'
          ); ?>
      </div>
      <div id="next-post" class="navigate nav-right">
        <?php
          $nextPost = get_next_post();
          $nextThumbnail = get_the_post_thumbnail($nextPost->ID, array(110,110) );
          next_post_link(
            '%link',
            '<div class="paginate clearfix"><div class="paginate-content"><span class="paginate-header">Next Product</span><h3 class="paginate-title">%title</h3></div>'.$nextThumbnail.'</div>'
          ); ?>
      </div>
      <?php endwhile; ?>      
      <?php comments_template(); ?>
    </main>
  </div>
</div>
<?php get_footer(); ?>