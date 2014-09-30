<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<div id="content" class="content single product wrapper">
  <?php //the_breadcrumb(); ?>
  <div class="row">
    <main class="spacing content-inner small-12 columns" role="main">
      <?php while ( have_posts() ) : ?>
      <?php the_post(); ?>
      <article itemscope itemtype="http://schema.org/BlogPosting" class="post">
        <header class="post-header">
          <h1 class="post-title"><?php the_title(); ?></h1>
          <?php
            if ( get_post_meta ($post->ID,'staffer_staff_title', true) != '' ) {
              echo '<h4 class="staff-title">';
              echo get_post_meta ($post->ID,'staffer_staff_title', true) . '</h4>';
            }
          ?>
        </header>
        <?php if ( $post->post_excerpt ) : ?>
        <div id='excerpt'><?php the_excerpt(); ?></div>
        <?php endif; ?>
        <div id='content-main' class='row'>
          <section class='post-content clearfix'>
            <?php the_post_thumbnail( 'large', array( 'class' => 'post-image' ) ); ?>
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
          if ( get_post_meta( $prevPost->ID,'staffer_staff_title', true ) != '' ) {
            $position = get_post_meta( $prevPost->ID,'staffer_staff_title', true );
          }

          previous_post_link(
            '%link',
            '<div class="paginate clearfix"><div class="paginate-content"><span class="paginate-header">Previous Team Member</span><h3 class="paginate-title">%title</h3><span class="paginate-subtitle">'.$position.'</span></div>'.$prevThumbnail.'</div>'
          ); ?>
      </div>
      <div id="next-post" class="navigate nav-right">
        <?php
          $nextPost = get_next_post();
          $nextThumbnail = get_the_post_thumbnail($nextPost->ID, array(110,110) );
          if ( get_post_meta( $nextPost->ID,'staffer_staff_title', true ) != '' ) {
            $position = get_post_meta( $nextPost->ID,'staffer_staff_title', true );
          }
          next_post_link(
            '%link',
            '<div class="paginate clearfix"><div class="paginate-content"><span class="paginate-header">Next Team Member</span><h3 class="paginate-title">%title</h3><span class="paginate-subtitle">'.$position.'</span></div>'.$nextThumbnail.'</div>'
          ); ?>
      </div>
      <?php endwhile; ?>      
      <?php comments_template(); ?>
    </main>
  </div>
</div>
<?php get_footer(); ?>