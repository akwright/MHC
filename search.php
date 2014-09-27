<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<div id="content" class="content archive wrapper">
	<?php the_breadcrumb(); ?>
	<div class="row">
		<main id="content-primary" role="main">
			<?php if ( have_posts() ) : ?>
			<header>
				<h1 class="page-title">
				<?php
					_e( 'Search Results for', 'mhc_theme' );
					echo ' ';
					echo '&#8216';  // left single quotation mark
					echo the_search_query();
					echo '&#8217';  // right single quotation mark
				?>
				</h1>
			</header>
			<div class="posts">
				<?php while ( have_posts() ): ?>
					<?php the_post(); ?>
					<?php get_template_part( 'partials/posts/post' ); ?>
				<?php endwhile; ?>
				<?php get_template_part( 'partials/post-pagination' ); ?>
				<?php else : ?>
				<div class="post">
					<h2>
						<?php _e( 'No Results Were Found', 'mhc_theme' ); ?>
					</h2>
					<p>
						<?php _e( 'There were no matches for your search. Please try a different search term.', 'mhc_theme' ); ?>
					</p>
				</div>
			</div>
			<?php endif; ?>
		</main>
		<?php get_template_part( 'partials/sidebars/sidebar', 'archive' ); ?>
	</div>
</div>

<?php get_footer(); ?>