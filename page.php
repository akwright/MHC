<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<div id="content" class="content page">
	<?php the_breadcrumb(); ?>
	<div class="row">
		<main role="main">
			<?php
        $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
        //if ($url) :
      ?>
      <!-- <img src="<?php //echo $url; ?>" alt="Post Featured Image"> -->
    	<?php //endif; ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article class="spacing wrapper" id="p<?php the_ID(); ?>">
					<section class="post-content clearfix">
						<?php the_content(); ?>
					</section>
				</article>
			<?php endwhile; endif; ?>
		</main>
	</div>
</div>
<?php get_footer(); ?>