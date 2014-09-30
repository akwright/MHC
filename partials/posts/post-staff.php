<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( 'small-12 medium-6 large-4 columns staff-item' ); ?>>
  <section class="post-content">
    <a href="<?php the_permalink() ?>">
      <?php the_post_thumbnail( 'full' ); ?>
    </a>
    <h3 class="post-title staff-heading"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    <?php
      if ( get_post_meta ($post->ID,'staffer_staff_title', true) != '' ) {
        echo '<p class="staff-title">';
        echo get_post_meta ($post->ID,'staffer_staff_title', true) . '</p>';
      }
    ?>
  </section>
</article>