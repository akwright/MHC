<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<div id="content" class="content page container wrapper">
	<?php the_breadcrumb(); ?>
	<div class="row">
		<main class="content-inner small-12 medium-10 medium-centered columns" role="main">
			<?php
        $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
        if ($url) :
      ?>
      <img src="<?php echo $url; ?>" alt="Post Featured Image">
    	<?php endif; ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
	</div>
</div>
<?php get_footer(); ?>