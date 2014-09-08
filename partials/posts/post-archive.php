<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( 'small-12 medium-6 large-4 columns' ); ?>>
  <?php
    global $post;
    $terms = get_the_terms( $post->ID, 'product-types' );
    foreach ( $terms as $term ) {
      echo '<span class="post-type '.$term->slug.'">'.$term->name.'</span>';
    }
  ?>
  <header class="post-header">
    <?php if ( is_archive() || $_POST['cpt'] ): ?>
    <h3 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    <?php else: ?>
    <h1 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
    <?php endif; ?>
  </header>
  <section class="post-content">
    <a href="<?php the_permalink() ?>">
      <?php the_post_thumbnail( 'medium-thumbnail' ); ?>
    </a>
    <?php the_excerpt( 'Read On&hellip;' ); ?>
    <a class="button" href="<?php the_permalink() ?>">View Product</a>
  </section>
</article>