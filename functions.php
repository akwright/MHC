<?php
require_once 'admin/mhc-theme-options.php';

add_action( 'after_setup_theme', 'mch_theme_setup' );

function mch_theme_setup(){
		load_theme_textdomain( 'mhc_theme', get_template_directory() . '/languages' );
}

if ( ! function_exists( 'mhc_get_option' ) ) {
	function mhc_get_option( $key ) {

		$mhc_options = get_option( '_mhc_options' );

		/* Define the array of defaults */
		$defaults = array(
				'header' => '',
				'footer' => '',
				'tweet_post_button' => false,
				'tweet_post_attribution' => '',
				'sections' => array(
				'display_type' => 'default_loop',
				'header' => false,
				'title' => '',
				'caption' => '',
				'num_posts' => 10,
				'categories' => array(),
				'default' => true,
			)
		);

		$mhc_options = wp_parse_args( $mhc_options, $defaults );

		if ( isset( $mhc_options[ $key ] ) )
			return $mhc_options[ $key ];

		return false;
	}
}

if ( ! isset( $content_width ) ) $content_width = 980;

define( 'HEADER_TEXTCOLOR', '3D302F' );
define( 'HEADER_IMAGE', '%s/images/default_header4.jpg' );
//define( 'HEADER_IMAGE_WIDTH', 980 );
//define( 'HEADER_IMAGE_HEIGHT', 225 );
define( 'HEADER_IMAGE_WIDTH', 800 );
define( 'HEADER_IMAGE_HEIGHT', 225 );

add_filter( 'wp_list_categories', 'mhc_remove_category_list_rel' );
add_filter( 'the_category', 'mhc_remove_category_list_rel' );
add_filter( 'dynamic_sidebar_params','mhc_widget_first_last_classes' );

if ( mhc_get_option( 'remove_script_version' ) ){
	add_filter( 'script_loader_src', 'mhc_remove_version_url_parameter', 15, 1 );
}
if ( mhc_get_option( 'remove_style_version' ) ){
	add_filter( 'style_loader_src', 'mhc_remove_version_url_parameter', 15, 1 );
}
if ( mhc_get_option( 'remove_wordpress_version' ) ){
	add_filter( 'the_generator', 'mhc_wp_generator' );
}

if ( ! is_admin() ) {
	add_action( 'init', 'mhc_enqueue_styles' );
    add_action( 'wp_enqueue_scripts', 'mhc_enqueue_scripts' );
}
if ( is_admin() ) {
	add_action( 'init', 'mhc_admin_assets' );
}

add_action( 'admin_menu', 'mhc_admin_menu' );
add_action( 'wp_footer', 'mhc_footer' );
add_action( 'wp_head', 'mhc_header' );
add_action( 'widgets_init', 'mhc_widgets' );
add_action( 'wp_head', 'mhc_add_ie_js_fixes' );
add_action( 'after_setup_theme', 'mhc_register_menu' );
add_action( 'after_switch_theme', 'mhc_set_missing_widget_options' );

add_editor_style();

$custom_header_support = array(
	'default-text-color'    => '3D302F',
	'flex-height'       => true,
	'wp-head-callback'      => 'mhc_header_style',
	'admin-head-callback'     => 'mhc_admin_header_style',
	'admin-preview-callback'  => 'mhc_admin_header_image',
);

add_theme_support( 'custom-header', $custom_header_support );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' ); 
add_theme_support( 'custom-background', array( 'default-color' => 'fffefe' ) );
add_theme_support( 'woocommerce' );

add_image_size( 'post-image', 535, 9999 ); 
add_image_size( 'featured-image', 980, 200, true );
add_image_size( 'excerpt-image', 724, 160, true );
add_image_size( 'default-thumbnail', 535, 200, true );
add_image_size( 'two-up-thumbnail', 468, 200, true );
add_image_size( 'three-up-thumbnail', 297, 150, true );
add_image_size( 'four-up-thumbnail', 212, 100, true );

function mhc_register_menu() {
	register_nav_menu( 'mhc_primary_navigation', 'Primary Navigation' );
}

function mhc_widgets() {
	register_sidebar(
		array(
			'name'      		=> 'Sub Header',
			'id'      			=> 'widget-subheader',
			'before_widget' => '<div id="%1$s" class="widget %2$s four columns">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      		=> 'Navigation',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      		=> 'Index Right Aside',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      		=> 'Post Left Aside',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      		=> 'Post Right Aside',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      		=> 'Post Footer',
			'id'      			=> 'widget-postfooter',
			'before_widget' => '<div id="%1$s" class="widget %2$s four columns">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'      		=> 'Footer',
			'id'     	 			=> 'widget-footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
			)
	);
}

/*
Clean up widget settings that weren't set at installation
If never used in a sidebar, their lack of default options will
trigger queries every page load
*/
function mhc_set_missing_widget_options( ){
	add_option( 'widget_pages', array( '_multiwidget' => 1 ) );
	add_option( 'widget_calendar', array( '_multiwidget' => 1 ) );
	add_option( 'widget_tag_cloud', array( '_multiwidget' => 1 ) );
	add_option( 'widget_nav_menu', array( '_multiwidget' => 1 ) );
}

function mhc_remove_version_url_parameter( $src ) {
	$parts = explode( '?', $src );
	return $parts[0];
}

function mhc_wp_generator() {
    echo '<meta name="generator" content="WordPress ', bloginfo( 'version' ), '" />';
}

if ( ! function_exists( 'mhc_header_style' ) ) :
	function mhc_header_style() {
		$text_color = get_header_textcolor();

		if ( $text_color == HEADER_TEXTCOLOR )
			return;
		?>
		<style type="text/css">
		<?php
			if ( 'blank' == $text_color ) :
		?>
			#site-title-description {
				position: absolute !important;
				clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			else :
		?>
			#site-title a,
			#site-description {
				color: #<?php echo $text_color; ?> !important;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

if ( ! function_exists( 'mhc_admin_header_style' ) ) :
	function mhc_admin_header_style() {
	?>
		<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}

		#desc, h1 {
			line-height: 1.25;
		}
		#headimg h1 {
			font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
			font-size: 24px;
			margin-bottom: 5px;
			margin-top:15px;
			font-weight: normal
		}
		#headimg h1 a {
			color: #3D302F;
			text-decoration: none
		}
		#desc {
			margin-top: 0;
			font-size: 13px;
			margin-bottom: 15px
		}
		<?php
			// If the user has set a custom color for the text use that
			if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
		?>
			#site-title a,
			#site-description {
				color: #<?php echo get_header_textcolor(); ?>;
			}
		<?php endif; ?>
		#headimg img {
			max-width: 980px;
			height: auto;
			width: 100%;
		}
		</style>
	<?php
	}
endif;

if ( ! function_exists( 'mhc_admin_header_image' ) ) :
	function mhc_admin_header_image() { ?>
		<div id="headimg">
			<?php
			$color = get_header_textcolor();
			$image = get_header_image();
			if ( $color && $color != 'blank' )
				$style = ' style="color:#' . $color . '"';
			else
				$style = ' style="display:none"';
			?>
			<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
			<?php if ( $image ) : ?>
				<img src="<?php echo esc_url( $image ); ?>" alt="" />
			<?php endif; ?>
		</div>
	<?php }
endif;

/* Remove rel attribute from the category list - thanks Joseph
(http://josephleedy.me/blog/make-wordpress-category-list-valid-by-removing-rel-attribute/)!
*/

function mhc_remove_category_list_rel( $output ) {
	$output = str_replace( ' rel="category tag"', '', $output );
	return $output;
}

/*
Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
via http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
 */

function mhc_widget_first_last_classes( $params ) {
	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets
	// If the counter array doesn't exist, create it
	if ( ! $my_widget_num ) {
		$my_widget_num = array();
	}
	// Check if the current sidebar has no widgets
	if ( ! isset( $arr_registered_widgets[$this_id] ) || ! is_array( $arr_registered_widgets[$this_id] ) ) {
		// No widgets in this sidebar... bail early.
		return $params;
	}
	// See if the counter array has an entry for this sidebar
	if ( isset( $my_widget_num[$this_id] ) ) {
		$my_widget_num[$this_id] ++;
	}
	// If not, create it starting with 1
	else {
		$my_widget_num[$this_id] = 1;
	}
	// Add a widget number class for additional styling options
	$class = 'class="widget-' . $my_widget_num[$this_id] . ' ';

	// If this is the first widget
	if ( $my_widget_num[$this_id] == 1 ) {
		$class .= 'widget-first ';
	}
	// If this is the last widget
	elseif ( $my_widget_num[$this_id] == count( $arr_registered_widgets[$this_id] ) ) {
		$class .= 'widget-last ';
	}

	// Insert our new classes into "before widget"
	$params[0]['before_widget'] = str_replace( 'class="', $class, $params[0]['before_widget'] );

return $params;
}

// ======================
// = HOME PAGE SECTIONS =
// ======================

if ( ! function_exists( 'mhc_theme_options' ) ) {
	function mhc_theme_options() {
		mhc_build_settings_page();
	}
}

// add our menus
function mhc_admin_menu() {
	add_theme_page( 'mhc', __( 'mhc Theme Options', 'mhc_theme' ), 'manage_options', 'mhc-settings', 'mhc_theme_options' );
}

function mhc_admin_assets() {
	wp_enqueue_style( 'mhc-admin', get_template_directory_uri() . '/admin/stylesheets/mhc-options.css', NULL, NULL, NULL );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'mhc-admin', get_template_directory_uri() . '/admin/javascripts/mhc-utils.js', 'jquery', NULL, true );
	$translation_array = array();
	$translation_array['delete_section_alert']     = __( 'Are you sure you want to delete this Content Section?', 'mhc_theme' );
	$translation_array['drag_section_instruction'] = '&larr; ' . __('(Drag & Drop Content Sections to Re-Order)', 'mhc_theme' );
	wp_localize_script( 'mhc-admin', 'admin_strings', $translation_array );
}

function mhc_footer() {
	echo stripslashes( mhc_get_option( 'footer' ) );
}

function mhc_header() {
	echo stripslashes( mhc_get_option( 'header' ) );
}

function mhc_tweet_post_button() {
	if ( mhc_get_option( 'tweet_post_button' ) ) return true;
}

function mhc_tweet_post_attribution() {
	return mhc_get_option( 'tweet_post_attribution' );
}

if ( ! function_exists( 'mhc_comment' ) ) {
	function mhc_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php comment_ID() ?>" class="comment">
			<div class="row">
				<div class="comment-content">
					<?php
						if ( $comment->comment_approved == '0' ) {
							$moderation_pending = __( 'Your comment is awaiting moderation', 'mhc_theme' );
							echo '<span class="comment-moderation">' . $moderation_pending . '</span>';
						}
						comment_text();
					?>
					<div class="comment-reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
					</div>
				</div>
				<div class="comment-info">
					<ul class='metadata vertical'>
						<li class="date"><time datetime="<?php the_time( 'Y-m-d' ); ?>"><span class="date-date"><?php comment_date( 'F d, Y' ); ?></span> <span class="date-time"><?php comment_date( 'g:i A' ); ?></span></time></li>
						<li class='author' id="vcard-<?php comment_ID() ?>">
							<?php
								echo _x( 'By', 'comment_author_attribution', 'mhc_theme' );
								echo ' ';
								?>
								<a class="url fn" href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a></li>
						<li>
							<?php edit_comment_link( _x( 'edit', 'edit-comment', 'mhc_theme' ) ); ?>
						</li>
					</ul>
				</div>
			</div>
	<?php
	}
}

if ( ! function_exists( 'mhc_enqueue_styles' ) ) {
	function mhc_enqueue_styles() {
		global $wp_styles;

		wp_register_style( 'mhc_stylesheet', get_stylesheet_directory_uri().'/style.css', null, '0.9', 'all' );
		wp_register_style( 'mhc_stylesheet_ie', get_stylesheet_directory_uri().'/ie.css', null, '0.9', 'all' );
		$wp_styles->add_data( 'mhc_stylesheet_ie', 'conditional', 'IE' );
		wp_enqueue_style( 'mhc_stylesheet' );
		wp_enqueue_style( 'mhc_stylesheet_ie' );
	}
}

if ( ! function_exists( 'mhc_enqueue_scripts' ) ) {
    function mhc_enqueue_scripts() {
        wp_register_script( 'mhc_scripts', get_stylesheet_directory_uri() . '/javascripts/min/mhc-min.js', false, '1.0', true );
        wp_enqueue_script( 'mhc_scripts' );
    }
}


function mhc_add_ie_js_fixes() {
	echo '<!--[if lt IE 9]><script src="',  get_stylesheet_directory_uri(), '/javascripts/html5.js"></script><![endif]-->';

	echo '<!--[if lt IE 7]><script src="',  get_stylesheet_directory_uri(), '/javascripts/ie7.js"></script><![endif]-->';
}
?>
