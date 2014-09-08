<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<div id="content" class="archive products container">
  <div class="row">
    <main class="content-primary" role="main">
      <?php if ( have_posts() ) : ?>
      <header>
        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <h1 class="page-title"><span id="js-taxName">All</span> Products</h1>
      </header>
      <menu class="filter">
        <a class="js-ajax active" onclick="loadCustomPosts(this)" data-name="All">All</a>
        <?php
          $taxonomy_names = get_object_taxonomies( get_post_type( get_the_ID() ) );
          $terms = get_terms($taxonomy_names[0]);
          foreach ($terms as $term) {
            
            echo "<a class='js-ajax' onclick='loadCustomPosts(this, $term->term_id)' data-name='$term->name'>$term->name</a>";
          }
        ?>
      </menu>
      <div class="posts clearfix">
        <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'partials/posts/post', 'archive' ); ?>
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