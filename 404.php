<?php
/**
 * @package MHC
 */
?>
<?php get_header(); ?>
<main id="content" class="spacing content fourohfour wrapper" role="main">
	<div class="small-12 medium-10 medium-centered large-8 columns">
		<header>
			<h1 class="page-title text-center">
				<?php _e( 'Page Not Found', 'mhc_theme' ); ?>
			</h1>
		</header>
		<div class="content-primary">
			<div class="six columns">
					<p class="large">
					<?php
						echo sprintf( __( 'Unfortunately, the page you are looking for no longer exists or never existed in the first place. If you reached this page in error, you can go home and start over.', 'mhc_theme' ));
						$home_link = sprintf( '<a class="button" href="%s" title="%s">%s</a>', home_url(), get_bloginfo( 'name' ), _x( 'home', 'home_link_text', 'mhc_theme' ) );
						echo '<br>' . $home_link;
					?>
					</p>
				</div>
				<div class="six columns search">
					<p class="large">
					<?php
						_e( 'If you believe this page exists, please try searching for the page in the search input below.', 'mhc_theme' );
					?>
					</p>
					<?php get_search_form(); ?>
				</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>