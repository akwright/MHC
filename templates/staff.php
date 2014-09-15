<?php
/**
 * @package MHC
 */
/*
Template Name: mhc Staff Template
*/
?>
<?php get_header(); ?>
<div id="content" class="archive staff grid-cols container">
	<div class="row">
	<main class="content-primary" role="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article class="post" id="p<?php the_ID(); ?>">
			<header class="post-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</header>
			<section class="post-content">
				<?php the_content(); ?>
			</section>
		</article>
		<?php endwhile; endif; ?>
	</main>
	</div>
</div>
<?php get_footer(); ?>