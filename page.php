<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<div id="content" class="page container">
	<div class="row">
		<main class="spacing small-12 medium-9 columns" role="main">
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article class="post clear" id="p<?php the_ID(); ?>">
				<header class="post-header">
					<h1 class="post-title"><?php the_title(); ?></h1>
				</header>
				<section class="post-content clearfix">
					<?php the_content(); ?>
				</section>
			</article>
			<?php endwhile; endif; ?>
		</main>
    <?php get_template_part( 'partials/sidebars/sidebar', 'page' ); ?>
	</div>
</div>
<?php get_footer(); ?>