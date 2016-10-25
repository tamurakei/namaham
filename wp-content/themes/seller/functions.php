<?php
/**
 * Seller functions and definitions
 *
 * @package Seller
 */


if ( ! function_exists( 'seller_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function seller_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'seller', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support('title-tag');
	
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	 global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640; /* pixels */
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * 
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'seller' ),
		'footer' => __( 'Footer Menu', 'seller' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'seller_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
	
	//Register custom thumbnail sizes
	//add_image_size('grid',350,350,true); //For the Grid layout
	//add_image_size('grid2',430,292,true); //For the Grid2 layout
	add_image_size('grid3',400,275,true); //For the Grid3 layout
	
	add_theme_support('woocommerce');
	
}
endif; // seller_setup
add_action( 'after_setup_theme', 'seller_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function seller_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'seller' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'sidebar-primary',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'seller' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'seller' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'seller' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'seller' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	
}
add_action( 'widgets_init', 'seller_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function seller_scripts() {

	//Load Default Stylesheet
	wp_enqueue_style( 'seller-style', get_stylesheet_uri() );
	
	//Load Font Awesome CSS
	wp_enqueue_style('font-awesome', get_template_directory_uri()."/assets/frameworks/font-awesome/css/font-awesome.min.css");
	
	//Google Fonts
	wp_enqueue_style('seller-font', '//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300');
	
	//Load Bootstrap CSS
	wp_enqueue_style('bootstrap-style',get_template_directory_uri()."/assets/frameworks/bootstrap/css/bootstrap.min.css");
	
	//Load BxSlider CSS
	wp_enqueue_style('bxslider-style',get_template_directory_uri()."/assets/css/bxslider.css");
	
	//Load Theme Structure File. Contains Orientation of the Theme.
	wp_enqueue_style('seller-theme-structure', get_template_directory_uri()."/assets/css/main.css");

	//Load the File Containing Color/Font Information
	wp_enqueue_style('seller-theme-style', get_template_directory_uri()."/assets/css/theme.css");
	
	//Load Tooltipster Plugin Style and Skin
	wp_enqueue_style('tooltipster-style', get_template_directory_uri()."/assets/css/tooltipster.css");
	wp_enqueue_style('tooltipster-skin', get_template_directory_uri()."/assets/css/tooltipster-shadow.css");
	
	//Load Bootstrap JS
	wp_enqueue_script('bootstrap-js', get_template_directory_uri()."/assets/frameworks/bootstrap/js/bootstrap.min.js", array('jquery'));

	//Load Bx Slider Js 
	wp_enqueue_script('bxslider-js', get_template_directory_uri()."/assets/js/bxslider.min.js", array('jquery'));

	//Tooltipster JS
	wp_enqueue_script('tooltipster-js', get_template_directory_uri()."/assets/js/tooltipster.js", array('jquery'));

	//Load Theme Specific JS
	wp_enqueue_script('custom-js', get_template_directory_uri()."/assets/js/custom.js", array('jquery','hoverIntent'));


	//Load Navigation js. This is Responsible for Converting the Main Menu into Responsive, when the browser width is switched.
	wp_enqueue_script( 'seller-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

	//Comes with _s Framework.
	wp_enqueue_script( 'seller-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

	//For the Default WordPress Comment's Reply System
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'seller_scripts' );

/**
 * Enqueue Scripts for Admin
 */
function seller_custom_wp_admin_style() {
        wp_enqueue_style( 'seller-admin_css', get_template_directory_uri() . '/assets/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'seller_custom_wp_admin_style' );

/*
 *	This function Contains All The scripts that Will be Loaded in the Theme Header including Slider, Custom CSS, etc.
 */
function seller_initialize_header() {
	
	global $option_setting; //Global theme options variable
	
	//CSS Begins
	echo "<style>";
	
	// Echo the Custom CSS Entered via Theme Options
	echo esc_html( get_theme_mod('seller_custom_css') );	
	
	if (is_front_page()) :
		echo ".header-title { border: none; }";
	endif;
		
	if ( get_theme_mod('seller_site_titlecolor') ) :
		echo "#masthead .site-title a { color: ".get_theme_mod('seller_site_titlecolor', '#e10d0d')."; }";
	endif;
	
	echo "</style>";
	//CSS Ends
	
	
}
add_action('wp_head', 'seller_initialize_header');

/*
 * Pagination Function. Implements core paginate_links function.
 */
function seller_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}
if (class_exists('woocommerce')) {
	/**
	 * Set Default Thumbnail Sizes for Woo Commerce Product Pages, on Theme Activation
	 */
	global $pagenow;
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) 			add_action( 'init', 'seller_woocommerce_image_dimensions', 1 );
	/**
	 * Define image sizes
	 */
	function seller_woocommerce_image_dimensions() {
	  	$catalog = array(
			'width' 	=> '600',	// px
			'height'	=> '600',	// px
			'crop'		=> 1 		// true
		);
		$single = array(
			'width' 	=> '600',	// px
			'height'	=> '600',	// px
			'crop'		=> 1 		// true
		);	 
		$thumbnail = array(
			'width' 	=> '250',	// px
			'height'	=> '250',	// px
			'crop'		=> 0 		// false
		);	 
		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
}
/*
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';