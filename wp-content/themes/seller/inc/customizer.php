<?php
/**
 * seller Theme Customizer
 *
 * @package seller
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function seller_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'seller' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'seller_logo' , array(
	    'default'     => '',
	    'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'seller_logo',
	        array(
	            'label' => __('Upload Logo','seller'),
	            'section' => 'title_tagline',
	            'settings' => 'seller_logo',
	            'priority' => 5,
	        )
		)
	);
		
	$wp_customize->add_section( 'seller_header' , array(
	    'title'      => __( 'Header Settings', 'seller' ),
	    'priority'   => 30,
	) );
	
		
	$wp_customize->add_setting(
	'seller_email',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'seller_email',
	        array(
		        'label' => __('Enter your Email here.','seller'),
	            'section' => 'seller_header',
	            'settings' => 'seller_email',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->add_setting(
	'seller_phone',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'seller_phone',
	        array(
		        'label' => __('Enter your Phone No. here. ','seller'),
	            'section' => 'seller_header',
	            'settings' => 'seller_phone',
	            'type' => 'text'
	        )
	);	
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override seller_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('seller_site_titlecolor', array(
	    'default'     => '#3a85ae',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'seller_site_titlecolor', array(
			'label' => __('Site Title Color','seller'),
			'section' => 'colors',
			'settings' => 'seller_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'seller_hide_title_tagline',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_hide_title_tagline', array(
		    'settings' => 'seller_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'seller' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	function seller_title_visible( $control ) {
		$option = $control->manager->get_setting('seller_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	// SLIDER PANEL
	$wp_customize->add_panel( 'seller_slider_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Main Slider',
	) );
	
	$wp_customize->add_section(
	    'seller_sec_slider_options',
	    array(
	        'title'     => __('Enable/Disable','seller'),
	        'priority'  => 0,
	        'panel'     => 'seller_slider_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'seller_main_slider_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_main_slider_enable', array(
		    'settings' => 'seller_main_slider_enable',
		    'label'    => __( 'Enable Slider.', 'seller' ),
		    'section'  => 'seller_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'seller_main_slider_count',
			array(
				'default' => '0',
				'sanitize_callback' => 'seller_sanitize_positive_number'
			)
	);
	
	// Select How Many Slides the User wants, and Reload the Page.
	$wp_customize->add_control(
			'seller_main_slider_count', array(
		    'settings' => 'seller_main_slider_count',
		    'label'    => __( 'No. of Slides(Min:0, Max: 5)' ,'seller'),
		    'section'  => 'seller_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Save the Settings, and Reload this page to Configure the Slides.','seller'),
		    
		)
	);
	
		
	
	if ( get_theme_mod('seller_main_slider_count') > 0 ) :
		$slides = get_theme_mod('seller_main_slider_count');
		
		for ( $i = 1 ; $i <= $slides ; $i++ ) :
			
			//Create the settings Once, and Loop through it.
			
			$wp_customize->add_setting(
				'seller_slide_img'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
			    new WP_Customize_Image_Control(
			        $wp_customize,
			        'seller_slide_img'.$i,
			        array(
			            'label' => '',
			            'section' => 'seller_slide_sec'.$i,
			            'settings' => 'seller_slide_img'.$i,			       
			        )
				)
			);
			
			
			$wp_customize->add_section(
			    'seller_slide_sec'.$i,
			    array(
			        'title'     => 'Slide '.$i,
			        'priority'  => $i,
			        'panel'     => 'seller_slider_panel'
			    )
			);
			
			$wp_customize->add_setting(
				'seller_slide_title'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'seller_slide_title'.$i, array(
				    'settings' => 'seller_slide_title'.$i,
				    'label'    => __( 'Slide Title','seller' ),
				    'section'  => 'seller_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'seller_slide_desc'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'seller_slide_desc'.$i, array(
				    'settings' => 'seller_slide_desc'.$i,
				    'label'    => __( 'Slide Description','seller' ),
				    'section'  => 'seller_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			
			$wp_customize->add_setting(
				'seller_slide_url'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
					'seller_slide_url'.$i, array(
				    'settings' => 'seller_slide_url'.$i,
				    'label'    => __( 'Target URL','seller' ),
				    'section'  => 'seller_slide_sec'.$i,
				    'type'     => 'url',
				)
			);
			
		endfor;
	
	
	endif;
	
	
	//Showcase
	$wp_customize->add_panel( 'seller_showcase_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Showcases','seller'),
	) );
	
	$wp_customize->add_section(
	    'seller_sec_showcase_options',
	    array(
	        'title'     => __('Enable/Disable','seller'),
	        'priority'  => 0,
	        'panel'     => 'seller_showcase_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'seller_main_showcase_enable',
		array( 'sanitize_callback' => 'seller_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'seller_main_showcase_enable', array(
		    'settings' => 'seller_main_showcase_enable',
		    'label'    => __( 'Enable Showcase.', 'seller' ),
		    'section'  => 'seller_sec_showcase_options',
		    'type'     => 'checkbox',
		)
	);
		
	
		$showcases = 3;
		
		for ( $i = 1 ; $i <= $showcases ; $i++ ) :
			
			//Create the settings Once, and Loop through it.
			
			$wp_customize->add_setting(
				'seller_showcase_img'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
			    new WP_Customize_Image_Control(
			        $wp_customize,
			        'seller_showcase_img'.$i,
			        array(
			            'label' => '',
			            'section' => 'seller_showcase_sec'.$i,
			            'settings' => 'seller_showcase_img'.$i,			       
			        )
				)
			);
			
			
			$wp_customize->add_section(
			    'seller_showcase_sec'.$i,
			    array(
			        'title'     => 'Showcase '.$i,
			        'priority'  => $i,
			        'panel'     => 'seller_showcase_panel'
			    )
			);
			
			$wp_customize->add_setting(
				'seller_showcase_title'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'seller_showcase_title'.$i, array(
				    'settings' => 'seller_showcase_title'.$i,
				    'label'    => __( 'Showcase Title','seller' ),
				    'section'  => 'seller_showcase_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'seller_showcase_desc'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'seller_showcase_desc'.$i, array(
				    'settings' => 'seller_showcase_desc'.$i,
				    'label'    => __( 'Showcase Description','seller' ),
				    'section'  => 'seller_showcase_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			
			$wp_customize->add_setting(
				'seller_showcase_url'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
					'seller_showcase_url'.$i, array(
				    'settings' => 'seller_showcase_url'.$i,
				    'label'    => __( 'Target URL','seller' ),
				    'section'  => 'seller_showcase_sec'.$i,
				    'type'     => 'url',
				)
			);
			
		endfor;
	
	if (class_exists('WP_Customize_Control')) {
		class Seller_WP_Customize_Upgrade_Control extends WP_Customize_Control {
	        /**
	         * Render the control's content.
	         */
	        public function render_content() {
	             printf(
	                '<label class="customize-control-upgrade"><span class="customize-control-title">%s</span> %s</label>',
	                $this->label,
	                $this->description
	            );
	        }
	    }
	}
	
	
	//Upgrade
	$wp_customize->add_section(
	    'seller_sec_upgrade',
	    array(
	        'title'     => __('Discover Seller Pro','seller'),
	        'priority'  => 45,
	    )
	);
	
	$wp_customize->add_setting(
			'seller_upgrade',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new Seller_WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'seller_upgrade',
	        array(
	            'label' => __('More of Everything','seller'),
	            'description' => __('Seller Pro has more of Everything. More New Features, More Options, Unlimited Colors, More Fonts, More Layouts, Configurable Slider, Inbuilt Advertising Options, More Widgets, and a lot more options and comes with Dedicated Support. To Know More about the Pro Version, click here: <a href="http://rohitink.com/product/seller-pro/">Upgrade to Pro</a>.','seller'),
	            'section' => 'seller_sec_upgrade',
	            'settings' => 'seller_upgrade',			       
	        )
		)
	);
		
	
	class Seller_Custom_CSS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize-> add_section(
    'seller_custom_codes',
    array(
    	'title'			=> __('Custom CSS','seller'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','seller'),
    	'priority'		=> 41,
    	)
    );
    
	$wp_customize->add_setting(
	'seller_custom_css',
	array(
		'default'		=> '',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'wp_filter_nohtml_kses',
		'sanitize_js_callback' => 'wp_filter_nohtml_kses'
		)
	);
	
	$wp_customize->add_control(
	    new Seller_Custom_CSS_Control(
	        $wp_customize,
	        'seller_custom_css',
	        array(
	            'section' => 'seller_custom_codes',
	            

	        )
	    )
	);
	
	function seller_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'seller_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','seller'),
    	'description'	=> __('Enter your Own Copyright Text.','seller'),
    	'priority'		=> 42,
    	)
    );
    
	$wp_customize->add_setting(
	'seller_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'seller_footer_text',
	        array(
	            'section' => 'seller_custom_footer',
	            'settings' => 'seller_footer_text',
	            'type' => 'text'
	        )
	);	
	
	
	// Social Icons
	$wp_customize->add_section('seller_social_section', array(
			'title' => __('Social Icons','seller'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','seller'),
					'facebook' => __('Facebook','seller'),
					'twitter' => __('Twitter','seller'),
					'google-plus' => __('Google Plus','seller'),
					'instagram' => __('Instagram','seller'),
					'rss' => __('RSS Feeds','seller'),
					'flickr' => __('Flickr','seller'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'seller_social_'.$x, array(
				'sanitize_callback' => 'seller_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'seller_social_'.$x, array(
					'settings' => 'seller_social_'.$x,
					'label' => __('Icon ','seller').$x,
					'section' => 'seller_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'seller_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'seller_social_url'.$x, array(
					'settings' => 'seller_social_url'.$x,
					'description' => __('Icon ','seller').$x.__(' Url','seller'),
					'section' => 'seller_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function seller_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'flickr',
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function seller_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function seller_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function seller_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'seller_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function seller_customize_preview_js() {
	wp_enqueue_script( 'seller_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'seller_customize_preview_js' );
