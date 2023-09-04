<?php
/**
 * Even Zur functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Even Zur
 */

require get_template_directory() . '/functions-templates.php';
require get_template_directory() . '/functions-loaders.php';

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'evenzur_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function evenzur_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Even Zur, use a find and replace
		 * to change 'evenzur' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'evenzur', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'evenzur_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'evenzur_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function evenzur_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'evenzur_content_width', 640 );
}
add_action( 'after_setup_theme', 'evenzur_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function evenzur_scripts() {
	wp_enqueue_style( 'evenzur-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'evenzur-style', 'rtl', 'replace' );

	wp_enqueue_script( 'evenzur-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'evenzur_scripts' );





// disable gutenberg for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// disable gutenberg for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS
} 
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );


add_shortcode('menu', 'print_menu_shortcode');
function print_menu_shortcode($atts, $content = null) {
	extract(shortcode_atts(array( 'name' => null, ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
}

add_filter('wpcf7_autop_or_not', '__return_false');

// Custom menus
function wpb_custom_new_menu() {
  register_nav_menus(
    array(
		'top-menu' => __( 'תפריט עליון ' ),
		'mobile-menu' => __( 'תפריט מובייל' ),
		'footer-menu' => __( 'תפריט footer' ),
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );

//Settings page
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'הגדרות כלליות',
		'menu_title'	=> 'הגדרות כלליות',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position' => 2,
	));
}


add_action( 'admin_head', 'hide_editor' );
function hide_editor() {
	$template_file = $template_file = basename( get_page_template() );
	if($template_file != "page.php")
	{
		remove_post_type_support('page', 'editor');
	}
}




add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .select2-container--default .select2-results__option[aria-selected=true], .select2-container--default .select2-results__option[data-selected=true] {
		background-color: #ddd;
	}
	.wdspromos {
		display: none;
	}
  </style>';
}


function make_short($string, $num_of_words) {
	$no_tags = wp_strip_all_tags($string);
	return wp_trim_words($no_tags, $num_of_words);
}


//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

     $new_filetypes = array();
     $new_filetypes['svg'] = 'image/svg';
     $file_types = array_merge($file_types, $new_filetypes );

     return $file_types; 
} 
add_action('upload_mimes', 'add_file_types_to_uploads');

function get_cur_template() {
    global $template;
    return basename($template);
}


class myMenuWalker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$output .= "<li class='" .  implode(" ", $item->classes) . "'>";
		if ($item->url && $item->url != '#') {
			$output .= '<a href="' . $item->url . '">';
		} else {
			$output .= '<div>';
		}
		if(get_field("icon", $item)) {
			$f = get_field("icon", $item);
			$output .= '<div class="icon"><img src="'.$f["url"].'" alt="'.$f["alt"].'" title="'.$f["title"].'"></div>';
		}
		$output .= '<span>';
		$output .= $item->title;
		$output .= '</span>';
		
		if ($item->url && $item->url != '#') {
			$output .= '</a>';
		} else {
			$output .= '</div>';
		}
	}
	
    function end_el(&$output, $item, $depth=0, $args=array()) {
		$output .= '</li>';
	}
}

function get_all_term_ids_of_post_in_tax($post_type, $tax, $tax_id) {
	$result = [];
	$t_query = array(
		array(
			'taxonomy'      => $tax,
			'field' => 'term_id',
			'terms'         => $tax_id
		)
	);
	$args = array(
		'post_type'             => $post_type,
		'posts_per_page'        => -1,
		'tax_query'             => $t_query,
	);
	
	
	$products = get_posts($args);
	foreach($products as $product) {
		$taxes = get_object_taxonomies($post_type);
		foreach($taxes as $tax_slug) {
			$ar = wp_get_post_terms( $product->ID, $tax_slug, array( 'fields' => 'ids' ) );
			$result = array_merge($result, $ar);
		}
	}
	
	return($result);
}

add_image_size( 'thumb-project', 630, 490, true );
add_image_size( 'thumb-post', 770, 385, true );



add_action( 'wpcf7_before_send_mail', 'wpcf7_do_something_else_with_the_data', 90, 1 );
    
function wpcf7_do_something_else_with_the_data( $WPCF7_ContactForm ){

	// Submission object, that generated when the user click the submit button.
	$submission = WPCF7_Submission :: get_instance();

	if ( $submission ){
		$posted_data = $submission->get_posted_data();      
		if ( empty( $posted_data ) ){ return; }
		

		$mail = $WPCF7_ContactForm->prop( 'mail' );
		
		$image_url = $posted_data['project-image'];
		if($image_url) {
			$ch = "<img src='" . $image_url . "'>";
		}
		else {
			$ch = "";
		}
		
		$new_mail = str_replace( '[project-image-placeholder]', $ch, $mail );

		// Set
		$WPCF7_ContactForm->set_properties( array( 'mail' => $new_mail ) );
		
		return $WPCF7_ContactForm;
	}
}