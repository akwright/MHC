<?php
/**
 * @package MHC
 */
?>
<aside id="sidebar" class="sidebar" role="complementary"> 
  <?php if ( ! dynamic_sidebar( 'Index Right Aside' ) ) : ?>
    <?php
      $taxonomy_names = get_object_taxonomies( get_post_type( get_the_ID() ) );
      $terms = get_terms($taxonomy_names[0]);
    ?>
      <ul class="sb__menu">
    <?php
      foreach ($terms as $term) {
        echo "<li><a href='".site_url()."/$term->taxonomy/$term->slug'>$term->name</a></li>";
      }
    ?>
      </ul>
  
  <?php endif; ?>
</aside>