<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( 'small-12 medium-6 large-4 columns' ); ?>>
  <section class="post-content">
    <a href="<?php the_permalink() ?>">
      <?php the_post_thumbnail( 'full' ); ?>
    </a>
    <h3 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    <?php
      $terms = get_the_terms( $post_id, 'staff-title' );
      $sep = '';
      foreach ( $terms as $term ) {
        echo $sep . $term->name;
        $sep = ', ';
      }
    ?>
  </section>
</article>