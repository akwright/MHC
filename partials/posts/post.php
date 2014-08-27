<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( 'leftaside' ); ?>>
	<header class="post-header">
        <?php if (is_archive()): ?>
          <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
        <?php else: ?>
          <h1 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
        <?php endif; ?>
	</header>
	<div class="row">
		<section class="post-content">
			<?php the_post_thumbnail( 'medium-thumbnail' ); ?>
			<?php the_content( __( 'Read On&hellip;', 'mhc_theme' ) ); ?>
		</section>
		<footer class="post-info">
			<?php get_template_part( 'partials/post-metadata' ); ?>
		</footer>
	</div>
</article>