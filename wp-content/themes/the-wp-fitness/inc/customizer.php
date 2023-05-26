<?php
/**
 * The WP Fitness Theme Customizer
 * @package The WP Fitness
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function the_wp_fitness_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-selector.php' );

	class The_WP_Fitness_WP_Customize_Range_Control extends WP_Customize_Control{
	    public $type = 'custom_range';
	    public function enqueue(){
	        wp_enqueue_script(
	            'cs-range-control',
	            false,
	            true
	        );
	    }
	    public function render_content(){?>
	        <label>
	            <?php if ( ! empty( $this->label )) : ?>
	                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	            <?php endif; ?>
	            <div class="cs-range-value"><?php echo esc_html($this->value()); ?></div>
	            <input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
	            <?php if ( ! empty( $this->description )) : ?>
	                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
	            <?php endif; ?>
	        </label>
        <?php }
	}		

	//add home page setting pannel
	$wp_customize->add_panel( 'the_wp_fitness_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'the-wp-fitness' ),
	    'description' => __( 'Description of what this panel does.', 'the-wp-fitness' ),
	) );

	// Add the Theme Color Option section.
	$wp_customize->add_section( 'the_wp_fitness_theme_color_option', array( 
		'panel' => 'the_wp_fitness_panel_id', 
		'title' => esc_html__( 'Global Color Settings', 'the-wp-fitness' ) 
	) );

  	$wp_customize->add_setting( 'the_wp_fitness_first_theme_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_first_theme_color', array(
  		'label' => 'Color Option 1',
	    'description' => __('One can change complete theme global color settings on just one click.', 'the-wp-fitness'),
	    'section' => 'the_wp_fitness_theme_color_option',
	    'settings' => 'the_wp_fitness_first_theme_color',
  	)));

  	$wp_customize->add_setting( 'the_wp_fitness_second_theme_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_second_theme_color', array(
  		'label' => 'Color Option 2',
	    'description' => __('One can change complete theme global color settings on just one click.', 'the-wp-fitness'),
	    'section' => 'the_wp_fitness_theme_color_option',
	    'settings' => 'the_wp_fitness_second_theme_color',
  	)));

    $the_wp_fitness_font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammersmith One' =>'Hammersmith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

	//Typography
	$wp_customize->add_section( 'the_wp_fitness_typography', array(
    	'title'      => __( 'Typography', 'the-wp-fitness' ),
		'priority'   => null,
		'panel' => 'the_wp_fitness_panel_id'
	) );
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'the_wp_fitness_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_paragraph_color', array(
		'label' => __('Paragraph Color', 'the-wp-fitness'),
		'section' => 'the_wp_fitness_typography',
		'settings' => 'the_wp_fitness_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('the_wp_fitness_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control(
	    'the_wp_fitness_paragraph_font_family', array(
	    'section'  => 'the_wp_fitness_typography',
	    'label'    => __( 'Paragraph Fonts','the-wp-fitness'),
	    'type'     => 'select',
	    'choices'  => $the_wp_fitness_font_array,
	));

	$wp_customize->add_setting('the_wp_fitness_paragraph_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('the_wp_fitness_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_typography',
		'setting'	=> 'the_wp_fitness_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'the_wp_fitness_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_atag_color', array(
		'label' => __('"a" Tag Color', 'the-wp-fitness'),
		'section' => 'the_wp_fitness_typography',
		'settings' => 'the_wp_fitness_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('the_wp_fitness_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control(
	    'the_wp_fitness_atag_font_family', array(
	    'section'  => 'the_wp_fitness_typography',
	    'label'    => __( '"a" Tag Fonts','the-wp-fitness'),
	    'type'     => 'select',
	    'choices'  => $the_wp_fitness_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'the_wp_fitness_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_li_color', array(
		'label' => __('"li" Tag Color', 'the-wp-fitness'),
		'section' => 'the_wp_fitness_typography',
		'settings' => 'the_wp_fitness_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('the_wp_fitness_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control(
	    'the_wp_fitness_li_font_family', array(
	    'section'  => 'the_wp_fitness_typography',
	    'label'    => __( '"li" Tag Fonts','the-wp-fitness'),
	    'type'     => 'select',
	    'choices'  => $the_wp_fitness_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'the_wp_fitness_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_h1_color', array(
		'label' => __('H1 Color', 'the-wp-fitness'),
		'section' => 'the_wp_fitness_typography',
		'settings' => 'the_wp_fitness_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('the_wp_fitness_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control(
	    'the_wp_fitness_h1_font_family', array(
	    'section'  => 'the_wp_fitness_typography',
	    'label'    => __( 'H1 Fonts','the-wp-fitness'),
	    'type'     => 'select',
	    'choices'  => $the_wp_fitness_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('the_wp_fitness_h1_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('the_wp_fitness_h1_font_size',array(
		'label'	=> __('H1 Font Size','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_typography',
		'setting'	=> 'the_wp_fitness_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'the_wp_fitness_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_h2_color', array(
		'label' => __('H2 Color', 'the-wp-fitness'),
		'section' => 'the_wp_fitness_typography',
		'settings' => 'the_wp_fitness_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('the_wp_fitness_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control(
	    'the_wp_fitness_h2_font_family', array(
	    'section'  => 'the_wp_fitness_typography',
	    'label'    => __( 'H2 Fonts','the-wp-fitness'),
	    'type'     => 'select',
	    'choices'  => $the_wp_fitness_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('the_wp_fitness_h2_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('the_wp_fitness_h2_font_size',array(
		'label'	=> __('H2 Font Size','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_typography',
		'setting'	=> 'the_wp_fitness_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'the_wp_fitness_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_h3_color', array(
		'label' => __('H3 Color', 'the-wp-fitness'),
		'section' => 'the_wp_fitness_typography',
		'settings' => 'the_wp_fitness_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('the_wp_fitness_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control(
	    'the_wp_fitness_h3_font_family', array(
	    'section'  => 'the_wp_fitness_typography',
	    'label'    => __( 'H3 Fonts','the-wp-fitness'),
	    'type'     => 'select',
	    'choices'  => $the_wp_fitness_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('the_wp_fitness_h3_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('the_wp_fitness_h3_font_size',array(
		'label'	=> __('H3 Font Size','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_typography',
		'setting'	=> 'the_wp_fitness_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'the_wp_fitness_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_h4_color', array(
		'label' => __('H4 Color', 'the-wp-fitness'),
		'section' => 'the_wp_fitness_typography',
		'settings' => 'the_wp_fitness_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('the_wp_fitness_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control(
	    'the_wp_fitness_h4_font_family', array(
	    'section'  => 'the_wp_fitness_typography',
	    'label'    => __( 'H4 Fonts','the-wp-fitness'),
	    'type'     => 'select',
	    'choices'  => $the_wp_fitness_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('the_wp_fitness_h4_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('the_wp_fitness_h4_font_size',array(
		'label'	=> __('H4 Font Size','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_typography',
		'setting'	=> 'the_wp_fitness_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'the_wp_fitness_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_h5_color', array(
		'label' => __('H5 Color', 'the-wp-fitness'),
		'section' => 'the_wp_fitness_typography',
		'settings' => 'the_wp_fitness_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('the_wp_fitness_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control(
	    'the_wp_fitness_h5_font_family', array(
	    'section'  => 'the_wp_fitness_typography',
	    'label'    => __( 'H5 Fonts','the-wp-fitness'),
	    'type'     => 'select',
	    'choices'  => $the_wp_fitness_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('the_wp_fitness_h5_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('the_wp_fitness_h5_font_size',array(
		'label'	=> __('H5 Font Size','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_typography',
		'setting'	=> 'the_wp_fitness_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'the_wp_fitness_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_h6_color', array(
		'label' => __('H6 Color', 'the-wp-fitness'),
		'section' => 'the_wp_fitness_typography',
		'settings' => 'the_wp_fitness_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('the_wp_fitness_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control(
	    'the_wp_fitness_h6_font_family', array(
	    'section'  => 'the_wp_fitness_typography',
	    'label'    => __( 'H6 Fonts','the-wp-fitness'),
	    'type'     => 'select',
	    'choices'  => $the_wp_fitness_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('the_wp_fitness_h6_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('the_wp_fitness_h6_font_size',array(
		'label'	=> __('H6 Font Size','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_typography',
		'setting'	=> 'the_wp_fitness_h6_font_size',
		'type'	=> 'text'
	));

	//Topbar section
	$wp_customize->add_section('the_wp_fitness_topbar_icon',array(
		'title'	=> __('Topbar Section','the-wp-fitness'),
		'description'	=> __('Add Header Content here','the-wp-fitness'),
		'priority'	=> null,
		'panel' => 'the_wp_fitness_panel_id',
	));

	$wp_customize->add_setting('the_wp_fitness_top_header',array(
       'default' => false,
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_top_header',array(
       'type' => 'checkbox',
       'label' => __('Enable Top Header','the-wp-fitness'),
       'section' => 'the_wp_fitness_topbar_icon'
    ));

    $wp_customize->add_setting('the_wp_fitness_topbar_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('the_wp_fitness_topbar_padding',array(
		'label'	=> esc_html__('Topbar Padding','the-wp-fitness'),
		'section'=> 'the_wp_fitness_topbar_icon',
	));

    $wp_customize->add_setting('the_wp_fitness_top_topbar_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_top_topbar_padding',array(
		'description'	=> __('Top','the-wp-fitness'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'the_wp_fitness_topbar_icon',
		'type'=> 'number',
	));

	$wp_customize->add_setting('the_wp_fitness_bottom_topbar_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_bottom_topbar_padding',array(
		'description'	=> __('Bottom','the-wp-fitness'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'the_wp_fitness_topbar_icon',
		'type'=> 'number',
	));

    $wp_customize->add_setting('the_wp_fitness_sticky_header',array(
       'default' => '',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_sticky_header',array(
       'type' => 'checkbox',
       'label' => __('Stick header on Desktop','the-wp-fitness'),
       'section' => 'the_wp_fitness_topbar_icon'
    ));

    $wp_customize->add_setting('the_wp_fitness_sticky_header_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('the_wp_fitness_sticky_header_padding',array(
		'label'	=> esc_html__('Sticky Header Padding','the-wp-fitness'),
		'section'=> 'the_wp_fitness_topbar_icon',
		'type' => 'hidden',
	));

    $wp_customize->add_setting('the_wp_fitness_top_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_top_sticky_header_padding',array(
		'description'	=> __('Top','the-wp-fitness'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'the_wp_fitness_topbar_icon',
		'type'=> 'number'
	));

	$wp_customize->add_setting('the_wp_fitness_bottom_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_bottom_sticky_header_padding',array(
		'description'	=> __('Bottom','the-wp-fitness'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'the_wp_fitness_topbar_icon',
		'type'=> 'number'
	));

	$wp_customize->add_setting('the_wp_fitness_search_placeholder',array(
       'default' => __('Search','the-wp-fitness'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('the_wp_fitness_search_placeholder',array(
       'type' => 'text',
       'label' => __('Search Placeholder text','the-wp-fitness'),
       'section' => 'the_wp_fitness_topbar_icon'
    ));

	$wp_customize->add_setting('the_wp_fitness_contact_corporate',array(
		'default'	=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_phone_number'
	));
	$wp_customize->add_control('the_wp_fitness_contact_corporate',array(
		'label'	=> __('Add Phone Number','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_topbar_icon',
		'setting'	=> 'the_wp_fitness_contact_corporate',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('the_wp_fitness_email_corporate',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));	
	$wp_customize->add_control('the_wp_fitness_email_corporate',array(
		'label'	=> __('Add Email','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_topbar_icon',
		'setting'	=> 'the_wp_fitness_email_corporate',
		'type'		=> 'text'
	));

	$wp_customize->add_section('the_wp_fitness_header',array(
		'title'	=> __('Header','the-wp-fitness'),
		'priority'	=> null,
		'panel' => 'the_wp_fitness_panel_id',
	));

	$wp_customize->add_setting('the_wp_fitness_menu_case',array(
        'default' => 'uppercase',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_menu_case',array(
        'type' => 'select',
        'label' => __('Menu Case','the-wp-fitness'),
        'section' => 'the_wp_fitness_header',
        'choices' => array(
            'uppercase' => __('Uppercase','the-wp-fitness'),
            'capitalize' => __('Capitalize','the-wp-fitness'),
        ),
	) );

	$wp_customize->add_setting( 'the_wp_fitness_menu_font_size', array(
		'default'=> '14',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_menu_font_size', array(
        'label'  => __('Menu Font Size','the-wp-fitness'),
        'section'  => 'the_wp_fitness_header',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));

    $wp_customize->add_setting('the_wp_fitness_menu_font_weight',array(
        'default' => '',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menu Font Weight','the-wp-fitness'),
        'section' => 'the_wp_fitness_header',
        'choices' => array(
            '100' => __('100','the-wp-fitness'),
            '200' => __('200','the-wp-fitness'),
            '300' => __('300','the-wp-fitness'),
            '400' => __('400','the-wp-fitness'),
            '500' => __('500','the-wp-fitness'),
            '600' => __('600','the-wp-fitness'),
            '700' => __('700','the-wp-fitness'),
            '800' => __('800','the-wp-fitness'),
            '900' => __('900','the-wp-fitness'),
        ),
	) );

	//Social Icons(topbar)
	$wp_customize->add_section('the_wp_fitness_topbar_header',array(
		'title'	=> __('Social Icon Section','the-wp-fitness'),
		'description'	=> __('Add Header Content here','the-wp-fitness'),
		'priority'	=> null,
		'panel' => 'the_wp_fitness_panel_id',
	));

	$wp_customize->add_setting('the_wp_fitness_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('the_wp_fitness_youtube_url',array(
		'label'	=> __('Add Youtube link','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_topbar_header',
		'setting'	=> 'the_wp_fitness_youtube_url',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('the_wp_fitness_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('the_wp_fitness_facebook_url',array(
		'label'	=> __('Add Facebook link','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_topbar_header',
		'setting'	=> 'the_wp_fitness_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('the_wp_fitness_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('the_wp_fitness_twitter_url',array(
		'label'	=> __('Add Twitter link','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_topbar_header',
		'setting'	=> 'the_wp_fitness_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('the_wp_fitness_rss_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('the_wp_fitness_rss_url',array(
		'label'	=> __('Add RSS link','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_topbar_header',
		'setting'	=> 'the_wp_fitness_rss_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting( 'the_wp_fitness_social_icons_font_size', array(
		'default'=> '16',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_social_icons_font_size', array(
        'label'  => __('Social Icons Font Size','the-wp-fitness'),
        'section'  => 'the_wp_fitness_topbar_header',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));

	//home page slider
	$wp_customize->add_section( 'the_wp_fitness_slidersettings' , array(
    	'title'   => __( 'Slider Settings', 'the-wp-fitness' ),
		'priority'   => null,
		'panel' => 'the_wp_fitness_panel_id'
	) );

	$wp_customize->add_setting('the_wp_fitness_slider_hide',array(
       'default' => false,
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_slider_hide',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','the-wp-fitness'),
       'section' => 'the_wp_fitness_slidersettings'
    ));

	$wp_customize->add_setting('the_wp_fitness_slider_title',array(
        'default' => true,
        'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
	));
	$wp_customize->add_control('the_wp_fitness_slider_title',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Slider Title','the-wp-fitness'),
      	'section' => 'the_wp_fitness_slidersettings'
	));

	$wp_customize->add_setting('the_wp_fitness_slider_button',array(
        'default' => true,
        'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
	));
	$wp_customize->add_control('the_wp_fitness_slider_button',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Slider Button','the-wp-fitness'),
      	'section' => 'the_wp_fitness_slidersettings'
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'the_wp_fitness_slidersettings_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'the_wp_fitness_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'the_wp_fitness_slidersettings_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'the-wp-fitness' ),
			'section'  => 'the_wp_fitness_slidersettings',
			'type'     => 'dropdown-pages'
		) 	);
	}

	$wp_customize->add_setting( 'the_wp_fitness_slider_speed', array(
		'default'              => 3000,
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	) );
	$wp_customize->add_control( 'the_wp_fitness_slider_speed', array(
		'label'       => esc_html__( 'Slider Speed','the-wp-fitness' ),
		'section'     => 'the_wp_fitness_slidersettings',
		'type'        => 'number',
		'settings'    => 'the_wp_fitness_slider_speed',
		'input_attrs' => array(
			'step'             => 500,
			'min'              => 500,
			'max'              => 5000,
		),
	) );

	//content Alignment
    $wp_customize->add_setting('the_wp_fitness_slider_alignment_option',array(
    'default' => 'Right Align',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_slider_alignment_option',array(
        'type' => 'radio',
        'label' => __('Slider Content Alignment','the-wp-fitness'),
        'section' => 'the_wp_fitness_slidersettings',
        'choices' => array(
            'Center Align' => __('Center Align','the-wp-fitness'),
            'Left Align' => __('Left Align','the-wp-fitness'),
            'Right Align' => __('Right Align','the-wp-fitness'),
        ),
	) );

	$wp_customize->add_setting('the_wp_fitness_slider_image_overlay',array(
        'default' => true,
        'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
	));
	$wp_customize->add_control('the_wp_fitness_slider_image_overlay',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Slider Image Overlay','the-wp-fitness'),
      	'section' => 'the_wp_fitness_slidersettings',
	));

	$wp_customize->add_setting( 'the_wp_fitness_slider_overlay_color', array(
	    'default' => '#000',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_slider_overlay_color', array(
	    'label' => __('Slider Overlay Color', 'the-wp-fitness'),
	    'section' => 'the_wp_fitness_slidersettings',
  	)));

	//Opacity
	$wp_customize->add_setting('the_wp_fitness_slider_opacity_color',array(
      'default'              => 0.7,
      'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control( 'the_wp_fitness_slider_opacity_color', array(
		'label'       => esc_html__('Slider Image Opacity', 'the-wp-fitness'),
		'section'     => 'the_wp_fitness_slidersettings',
		'type'        => 'select',
		'settings'    => 'the_wp_fitness_slider_opacity_color',
		'choices' => array(
	      '0' =>  esc_attr('0','the-wp-fitness'),
	      '0.1' =>  esc_attr('0.1','the-wp-fitness'),
	      '0.2' =>  esc_attr('0.2','the-wp-fitness'),
	      '0.3' =>  esc_attr('0.3','the-wp-fitness'),
	      '0.4' =>  esc_attr('0.4','the-wp-fitness'),
	      '0.5' =>  esc_attr('0.5','the-wp-fitness'),
	      '0.6' =>  esc_attr('0.6','the-wp-fitness'),
	      '0.7' =>  esc_attr('0.7','the-wp-fitness'),
	      '0.8' =>  esc_attr('0.8','the-wp-fitness'),
	      '0.9' =>  esc_attr('0.9','the-wp-fitness')
		),
	));

	$wp_customize->add_setting( 'the_wp_fitness_slider_button_label', array(
		'default' => __('READ MORE','the-wp-fitness' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'the_wp_fitness_slider_button_label', array(
		'label' => esc_html__( 'Slider Button Label','the-wp-fitness' ),
		'section'     => 'the_wp_fitness_slidersettings',
		'type'        => 'text',
		'settings'    => 'the_wp_fitness_slider_button_label'
	) );

	$wp_customize->add_setting( 'the_wp_fitness_slider_height', array(
		'default'          => '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	) );
	$wp_customize->add_control( 'the_wp_fitness_slider_height', array(
		'label'   => esc_html__( 'Slider Height','the-wp-fitness' ),
		'section' => 'the_wp_fitness_slidersettings',
		'type'    => 'number',
		'description' => __('Measurement is in pixel.','the-wp-fitness'),
		'input_attrs' => array(
			'step' => 1,
			'min'  => 500,
			'max'  => 1000,
		),
	) );

	//Trainer
	$wp_customize->add_section('the_wp_fitness_about',array(
		'title'	=> __('Trainer Section','the-wp-fitness'),
		'description'=> __('This section will appear below the slider.','the-wp-fitness'),
		'panel' => 'the_wp_fitness_panel_id',
	));	
	
	$wp_customize->add_setting('the_wp_fitness_sec1_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('the_wp_fitness_sec1_title',array(
		'label'	=> __('Section Title','the-wp-fitness'),
		'section'=> 'the_wp_fitness_about',
		'setting'=> 'the_wp_fitness_sec1_title',
		'type'=> 'text'
	));
	
	$wp_customize->add_setting('the_wp_fitness_sec1_subtitle',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('the_wp_fitness_sec1_subtitle',array(
		'label'	=> __('Section Sub-Title','the-wp-fitness'),
		'section'=> 'the_wp_fitness_about',
		'setting'=> 'the_wp_fitness_sec1_subtitle',
		'type'=> 'text'
	));

	$wp_customize->add_setting('the_wp_fitness_trainer_name',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('the_wp_fitness_trainer_name',array(
		'label'	=> __('read more text','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_about',
		'setting'	=> 'the_wp_fitness_trainer_name',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('the_wp_fitness_trainer_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control('the_wp_fitness_trainer_link',array(
		'label'	=> __('read more link','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_about',
		'type'		=> 'text'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('the_wp_fitness_blogcategory_setting',array(
		'default'	=> 'select',
		'sanitize_callback' => 'the_wp_fitness_sanitize_choices',
	));
	$wp_customize->add_control('the_wp_fitness_blogcategory_setting',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display Latest Post','the-wp-fitness'),
		'section' => 'the_wp_fitness_about',
	));

	//Gallery
	$wp_customize->add_section('the_wp_fitness_gallery',array(
		'title'	=> __('Gallery Section','the-wp-fitness'),
		'description'	=> __('Add Gallery sections below.','the-wp-fitness'),
		'panel' => 'the_wp_fitness_panel_id',
	));

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
	$i = 0;
	$pst[]='Select';  
	foreach($post_list as $post){
		$pst[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('the_wp_fitness_gallery1_setting',array(
		'sanitize_callback' => 'the_wp_fitness_sanitize_choices',
	));
	$wp_customize->add_control('the_wp_fitness_gallery1_setting',array(
		'type'    => 'select',
		'choices' => $pst,
		'label' => __('Select post','the-wp-fitness'),
		'section' => 'the_wp_fitness_gallery',
	));

	$wp_customize->add_setting('the_wp_fitness_gallery2_setting',array(
		'sanitize_callback' => 'the_wp_fitness_sanitize_choices',
	));
	$wp_customize->add_control('the_wp_fitness_gallery2_setting',array(
		'type'    => 'select',
		'choices' => $pst,
		'label' => __('Select post','the-wp-fitness'),
		'section' => 'the_wp_fitness_gallery',
	));

	$wp_customize->add_setting('the_wp_fitness_gallery3_setting',array(
		'sanitize_callback' => 'the_wp_fitness_sanitize_choices',
	));
	$wp_customize->add_control('the_wp_fitness_gallery3_setting',array(
		'type'    => 'select',
		'choices' => $pst,
		'label' => __('Select post','the-wp-fitness'),
		'section' => 'the_wp_fitness_gallery',
	));

	$wp_customize->add_setting('the_wp_fitness_gallery4_setting',array(
		'sanitize_callback' => 'the_wp_fitness_sanitize_choices',
	));
	$wp_customize->add_control('the_wp_fitness_gallery4_setting',array(
		'type'    => 'select',
		'choices' => $pst,
		'label' => __('Select post','the-wp-fitness'),
		'section' => 'the_wp_fitness_gallery',
	));

	$wp_customize->add_setting('the_wp_fitness_gallery5_setting',array(
		'sanitize_callback' => 'the_wp_fitness_sanitize_choices',
	));
	$wp_customize->add_control('the_wp_fitness_gallery5_setting',array(
		'type'    => 'select',
		'choices' => $pst,
		'label' => __('Select post','the-wp-fitness'),
		'section' => 'the_wp_fitness_gallery',
	));

	//About
	$wp_customize->add_section('the_wp_fitness_about1',array(
		'title'	=> __('About Section','the-wp-fitness'),
		'description'	=> __('Add About sections below.','the-wp-fitness'),
		'panel' => 'the_wp_fitness_panel_id',
	));

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
	$i = 0;
	$pst1[]='Select';  
	foreach($post_list as $post){
		$pst1[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('the_wp_fitness_about_setting',array(
		'sanitize_callback' => 'the_wp_fitness_sanitize_choices',
	));
	$wp_customize->add_control('the_wp_fitness_about_setting',array(
		'type'    => 'select',
		'choices' => $pst1,
		'label' => __('Select post','the-wp-fitness'),
		'section' => 'the_wp_fitness_about1',
	));

	$wp_customize->add_setting('the_wp_fitness_about_name',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('the_wp_fitness_about_name',array(
		'label'	=> __('read more text','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_about1',
		'setting'	=> 'the_wp_fitness_about_name',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('the_wp_fitness_about_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control('the_wp_fitness_about_link',array(
		'label'	=> __('read more link','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_about1',
		'type'		=> 'text'
	));

	//layout setting
	$wp_customize->add_section( 'the_wp_fitness_theme_layout', array(
    	'title'      => __( 'Blog Settings', 'the-wp-fitness' ),
		'priority'   => null,
		'panel' => 'the_wp_fitness_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('the_wp_fitness_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'	        
	) );
	$wp_customize->add_control('the_wp_fitness_layout', array(
        'type' => 'radio',
        'section' => 'the_wp_fitness_theme_layout',
   		'label' => __('Blog Layout','the-wp-fitness'),
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','the-wp-fitness'),
            'Right Sidebar' => __('Right Sidebar','the-wp-fitness'),
            'One Column' => __('One Column','the-wp-fitness'),
            'Three Columns' => __('Three Columns','the-wp-fitness'),
            'Four Columns' => __('Four Columns','the-wp-fitness'),
            'Grid Layout' => __('Grid Layout','the-wp-fitness')
        ),
    ));

    $wp_customize->add_setting('the_wp_fitness_blog_post_display_type',array(
        'default' => 'blocks',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
    ));
	$wp_customize->add_control('the_wp_fitness_blog_post_display_type', array(
        'type' => 'select',
        'label' => __( 'Blog Page Display Type', 'the-wp-fitness' ),
        'section' => 'the_wp_fitness_theme_layout',
        'choices' => array(
            'blocks' => __('Blocks','the-wp-fitness'),
            'without blocks' => __('Without Blocks','the-wp-fitness'),
        ),
    ));

    $wp_customize->add_setting('the_wp_fitness_metafields_date',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_metafields_date',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Date ','the-wp-fitness'),
       'section' => 'the_wp_fitness_theme_layout'
    ));

    $wp_customize->add_setting('the_wp_fitness_metafields_author',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_metafields_author',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Author','the-wp-fitness'),
       'section' => 'the_wp_fitness_theme_layout'
    ));

    $wp_customize->add_setting('the_wp_fitness_metafields_comment',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_metafields_comment',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Comments','the-wp-fitness'),
       'section' => 'the_wp_fitness_theme_layout'
    ));

    $wp_customize->add_setting('the_wp_fitness_metafields_time',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_metafields_time',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Time','the-wp-fitness'),
       'section' => 'the_wp_fitness_theme_layout'
    ));

    $wp_customize->add_setting('the_wp_fitness_featured_image',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_featured_image',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Featured Image','the-wp-fitness'),
       'section' => 'the_wp_fitness_theme_layout'
    ));

    $wp_customize->add_setting('the_wp_fitness_post_navigation',array(
       'default' => 'true',
       'sanitize_callback' => 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_post_navigation',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Post Navigation','the-wp-fitness'),
       'section' => 'the_wp_fitness_theme_layout'
    ));

    $wp_customize->add_setting('the_wp_fitness_metabox_seperator',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('the_wp_fitness_metabox_seperator',array(
       'type' => 'text',
       'label' => __('Metabox Seperator','the-wp-fitness'),
       'description' => __('Ex: "/", "|", "-", ...','the-wp-fitness'),
       'section' => 'the_wp_fitness_theme_layout'
    ));

    $wp_customize->add_setting('the_wp_fitness_blog_post_content',array(
    	'default' => 'Excerpt Content',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_blog_post_content',array(
        'type' => 'radio',
        'label' => __('Blog Post Content Type','the-wp-fitness'),
        'section' => 'the_wp_fitness_theme_layout',
        'choices' => array(
            'No Content' => __('No Content','the-wp-fitness'),
            'Full Content' => __('Full Content','the-wp-fitness'),
            'Excerpt Content' => __('Excerpt Content','the-wp-fitness'),
        ),
	) );

   $wp_customize->add_setting( 'the_wp_fitness_post_excerpt_number', array(
		'default'              => 20,
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	) );
	$wp_customize->add_control( 'the_wp_fitness_post_excerpt_number', array(
		'label'       => esc_html__( 'Blog Post Excerpt Number (Max 50)','the-wp-fitness' ),
		'section'     => 'the_wp_fitness_theme_layout',
		'type'        => 'number',
		'settings'    => 'the_wp_fitness_post_excerpt_number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
		'active_callback' => 'the_wp_fitness_excerpt_enabled'
	) );

	$wp_customize->add_setting( 'the_wp_fitness_button_excerpt_suffix', array(
		'default'   => '...',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'the_wp_fitness_button_excerpt_suffix', array(
		'label'       => esc_html__( 'Post Excerpt Suffix','the-wp-fitness' ),
		'section'     => 'the_wp_fitness_theme_layout',
		'type'        => 'text',
		'settings'    => 'the_wp_fitness_button_excerpt_suffix',
		'active_callback' => 'the_wp_fitness_excerpt_enabled'
	) );

	$wp_customize->add_setting( 'the_wp_fitness_feature_image_border_radius', array(
		'default'=> '0',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_feature_image_border_radius', array(
        'label'  => __('Featured Image Border Radius','the-wp-fitness'),
        'section'  => 'the_wp_fitness_theme_layout',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        ),
    )));

    $wp_customize->add_setting( 'the_wp_fitness_feature_image_shadow', array(
		'default'=> '0',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_feature_image_shadow', array(
        'label'  => __('Featured Image Shadow','the-wp-fitness'),
        'section'  => 'the_wp_fitness_theme_layout',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        ),
    )));

    $wp_customize->add_setting( 'the_wp_fitness_pagination_type', array(
        'default'			=> 'page-numbers',
        'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'the_wp_fitness_pagination_type', array(
        'section' => 'the_wp_fitness_theme_layout',
        'type' => 'select',
        'label' => __( 'Blog Pagination Style', 'the-wp-fitness' ),
        'choices'		=> array(
            'page-numbers'  => __( 'Number', 'the-wp-fitness' ),
            'next-prev' => __( 'Next/Prev', 'the-wp-fitness' ),
    )));

    $wp_customize->add_setting('the_wp_fitness_blog_nav_position',array(
        'default' => 'bottom',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
    ));
	$wp_customize->add_control('the_wp_fitness_blog_nav_position', array(
        'type' => 'select',
        'label' => __( 'Blog Post Navigation Position', 'the-wp-fitness' ),
        'section' => 'the_wp_fitness_theme_layout',
        'choices' => array(
            'top' => __('Top','the-wp-fitness'),
            'bottom' => __('Bottom','the-wp-fitness'),
            'both' => __('Both','the-wp-fitness')
        ),
    ));

	$wp_customize->add_section( 'the_wp_fitness_single_post_settings', array(
		'title' => __( 'Single Post Options', 'the-wp-fitness' ),
		'panel' => 'the_wp_fitness_panel_id',
	));

	$wp_customize->add_setting('the_wp_fitness_single_post_breadcrumb',array(
       'default' => 'true',
       'sanitize_callback' => 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_single_post_breadcrumb',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Breadcrumb','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

	$wp_customize->add_setting('the_wp_fitness_single_post_date',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_single_post_date',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Date','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

    $wp_customize->add_setting('the_wp_fitness_single_post_author',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_single_post_author',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Author','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

    $wp_customize->add_setting('the_wp_fitness_single_post_comment_no',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_single_post_comment_no',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Comment Number','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

	$wp_customize->add_setting('the_wp_fitness_metafields_tags',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_metafields_tags',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Tags','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

    $wp_customize->add_setting('the_wp_fitness_single_post_image',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_single_post_image',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Featured Image','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

    $wp_customize->add_setting( 'the_wp_fitness_post_featured_image', array(
        'default' => 'in-content',
        'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'the_wp_fitness_post_featured_image', array(
        'section' => 'the_wp_fitness_single_post_settings',
        'type' => 'radio',
        'label' => __( 'Featured Image Display Type', 'the-wp-fitness' ),
        'choices'		=> array(
            'banner'  => __('as Banner Image', 'the-wp-fitness'),
            'in-content' => __( 'as Featured Image', 'the-wp-fitness' ),
    )));

    $wp_customize->add_setting('the_wp_fitness_single_post_nav',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_single_post_nav',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Navigation','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

    $wp_customize->add_setting( 'the_wp_fitness_single_post_prev_nav_text', array(
		'default' => __('Previous','the-wp-fitness' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'the_wp_fitness_single_post_prev_nav_text', array(
		'label' => esc_html__( 'Single Post Previous Nav text','the-wp-fitness' ),
		'section'     => 'the_wp_fitness_single_post_settings',
		'type'        => 'text',
		'settings'    => 'the_wp_fitness_single_post_prev_nav_text'
	) );

	$wp_customize->add_setting( 'the_wp_fitness_single_post_next_nav_text', array(
		'default' => __('Next','the-wp-fitness' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'the_wp_fitness_single_post_next_nav_text', array(
		'label' => esc_html__( 'Single Post Next Nav text','the-wp-fitness' ),
		'section'     => 'the_wp_fitness_single_post_settings',
		'type'        => 'text',
		'settings'    => 'the_wp_fitness_single_post_next_nav_text'
	) );

    $wp_customize->add_setting('the_wp_fitness_single_post_comment',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_single_post_comment',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post comment','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

	$wp_customize->add_setting( 'the_wp_fitness_comment_width', array(
		'default'=> '100',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_comment_width', array(
        'label'  => __('Comment textarea width','the-wp-fitness'),
        'section'  => 'the_wp_fitness_single_post_settings',
        'description' => __('Measurement is in %.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
        ),
    )));

    $wp_customize->add_setting('the_wp_fitness_comment_title',array(
       'default' => __('Leave a Reply','the-wp-fitness'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('the_wp_fitness_comment_title',array(
       'type' => 'text',
       'label' => __('Comment form Title','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

    $wp_customize->add_setting('the_wp_fitness_comment_submit_text',array(
       'default' => __('Post Comment','the-wp-fitness'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('the_wp_fitness_comment_submit_text',array(
       'type' => 'text',
       'label' => __('Comment Submit Button Label','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

	$wp_customize->add_setting('the_wp_fitness_related_posts',array(
       'default' => true,
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_related_posts',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Related Posts','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

    $wp_customize->add_setting('the_wp_fitness_related_posts_title',array(
       'default' => __('You May Also Like','the-wp-fitness'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('the_wp_fitness_related_posts_title',array(
       'type' => 'text',
       'label' => __('Related Posts Title','the-wp-fitness'),
       'section' => 'the_wp_fitness_single_post_settings'
    ));

    $wp_customize->add_setting( 'the_wp_fitness_related_post_count', array(
		'default' => 3,
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	) );
	$wp_customize->add_control( 'the_wp_fitness_related_post_count', array(
		'label' => esc_html__( 'Related Posts Count','the-wp-fitness' ),
		'section' => 'the_wp_fitness_single_post_settings',
		'type' => 'number',
		'settings' => 'the_wp_fitness_related_post_count',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 6,
		),
	) );

    $wp_customize->add_setting( 'the_wp_fitness_post_shown_by', array(
        'default' => 'categories',
        'sanitize_callback'	=> 'the_wp_fitness_sanitize_choices'
    ));
    $wp_customize->add_control( 'the_wp_fitness_post_shown_by', array(
        'section' => 'the_wp_fitness_single_post_settings',
        'type' => 'radio',
        'label' => __( 'Related Posts must be shown:', 'the-wp-fitness' ),
        'choices'		=> array(
            'categories'  => __('By Categories', 'the-wp-fitness'),
            'tags' => __( 'By Tags', 'the-wp-fitness' ),
    )));

	// Button option
	$wp_customize->add_section( 'the_wp_fitness_button_options', array(
		'title' =>  __( 'Button Options', 'the-wp-fitness' ),
		'panel' => 'the_wp_fitness_panel_id',
	));

    $wp_customize->add_setting( 'the_wp_fitness_blog_button_text', array(
		'default'   => __('Read Full','the-wp-fitness'),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'the_wp_fitness_blog_button_text', array(
		'label'       => esc_html__( 'Blog Post Button Label','the-wp-fitness' ),
		'section'     => 'the_wp_fitness_button_options',
		'type'        => 'text',
		'settings'    => 'the_wp_fitness_blog_button_text'
	) );

	$wp_customize->add_setting('the_wp_fitness_button_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('the_wp_fitness_button_padding',array(
		'label'	=> esc_html__('Button Padding','the-wp-fitness'),
		'section'=> 'the_wp_fitness_button_options',
		'active_callback' => 'the_wp_fitness_button_enabled'
	));

	$wp_customize->add_setting('the_wp_fitness_top_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_top_button_padding',array(
		'label'	=> __('Top','the-wp-fitness'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'the_wp_fitness_button_options',
		'type'=> 'number',
		'active_callback' => 'the_wp_fitness_button_enabled'
	));

	$wp_customize->add_setting('the_wp_fitness_bottom_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_bottom_button_padding',array(
		'label'	=> __('Bottom','the-wp-fitness'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'the_wp_fitness_button_options',
		'type'=> 'number',
		'active_callback' => 'the_wp_fitness_button_enabled'
	));

	$wp_customize->add_setting('the_wp_fitness_left_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_left_button_padding',array(
		'label'	=> __('Left','the-wp-fitness'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'the_wp_fitness_button_options',
		'type'=> 'number',
		'active_callback' => 'the_wp_fitness_button_enabled'
	));

	$wp_customize->add_setting('the_wp_fitness_right_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_right_button_padding',array(
		'label'	=> __('Right','the-wp-fitness'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'the_wp_fitness_button_options',
		'type'=> 'number',
		'active_callback' => 'the_wp_fitness_button_enabled'
	));

	$wp_customize->add_setting( 'the_wp_fitness_button_border_radius', array(
		'default'=> 0,
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_button_border_radius', array(
        'label'  => __('Border Radius','the-wp-fitness'),
        'section'  => 'the_wp_fitness_button_options',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        ),
		'active_callback' => 'the_wp_fitness_button_enabled'
    )));

    //Sidebar setting
	$wp_customize->add_section( 'the_wp_fitness_sidebar_options', array(
    	'title'   => __( 'Sidebar options', 'the-wp-fitness' ),
		'priority'   => null,
		'panel' => 'the_wp_fitness_panel_id'
	) );

	$wp_customize->add_setting('the_wp_fitness_single_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
    ));
	$wp_customize->add_control('the_wp_fitness_single_page_layout', array(
        'type' => 'select',
        'label' => __( 'Single Page Layout', 'the-wp-fitness' ),
        'section' => 'the_wp_fitness_sidebar_options',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','the-wp-fitness'),
            'Right Sidebar' => __('Right Sidebar','the-wp-fitness'),
            'One Column' => __('One Column','the-wp-fitness')
        ),
    ));

    $wp_customize->add_setting('the_wp_fitness_single_post_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
    ));
	$wp_customize->add_control('the_wp_fitness_single_post_layout', array(
        'type' => 'select',
        'label' => __( 'Single Post Layout', 'the-wp-fitness' ),
        'section' => 'the_wp_fitness_sidebar_options',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','the-wp-fitness'),
            'Right Sidebar' => __('Right Sidebar','the-wp-fitness'),
            'One Column' => __('One Column','the-wp-fitness')
        ),
    ));

    //Advance Options
	$wp_customize->add_section( 'the_wp_fitness_advance_options', array(
    	'title' => __( 'Advance Options', 'the-wp-fitness' ),
		'priority'   => null,
		'panel' => 'the_wp_fitness_panel_id'
	) );

	$wp_customize->add_setting('the_wp_fitness_preloader',array(
       'default' => 'true',
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_preloader',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Preloader','the-wp-fitness'),
       'section' => 'the_wp_fitness_advance_options'
    ));

    $wp_customize->add_setting( 'the_wp_fitness_preloader_color', array(
	    'default' => '#333333',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_preloader_color', array(
  		'label' => __('Preloader Color', 'the-wp-fitness'),
	    'section' => 'the_wp_fitness_advance_options',
	    'settings' => 'the_wp_fitness_preloader_color',
  	)));

  	$wp_customize->add_setting( 'the_wp_fitness_preloader_bg_color', array(
	    'default' => '#ffffff',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'the_wp_fitness_preloader_bg_color', array(
  		'label' => __('Preloader Background Color', 'the-wp-fitness'),
	    'section' => 'the_wp_fitness_advance_options',
	    'settings' => 'the_wp_fitness_preloader_bg_color',
  	)));

  	$wp_customize->add_setting('the_wp_fitness_preloader_type',array(
        'default' => 'Square',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_preloader_type',array(
        'type' => 'radio',
        'label' => __('Preloader Type','the-wp-fitness'),
        'section' => 'the_wp_fitness_advance_options',
        'choices' => array(
            'Square' => __('Square','the-wp-fitness'),
            'Circle' => __('Circle','the-wp-fitness'),
        ),
	) );

	$wp_customize->add_setting('the_wp_fitness_theme_layout_options',array(
        'default' => 'Default Theme',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_theme_layout_options',array(
        'type' => 'radio',
        'label' => __('Theme Layout','the-wp-fitness'),
        'section' => 'the_wp_fitness_advance_options',
        'choices' => array(
            'Default Theme' => __('Default Theme','the-wp-fitness'),
            'Container Theme' => __('Container Theme','the-wp-fitness'),
            'Box Container Theme' => __('Box Container Theme','the-wp-fitness'),
        ),
	) );

	//404 Page Option
	$wp_customize->add_section('the_wp_fitness_404_settings',array(
		'title'	=> __('404 Page & Search Result Settings','the-wp-fitness'),
		'priority'	=> null,
		'panel' => 'the_wp_fitness_panel_id',
	));

	$wp_customize->add_setting('the_wp_fitness_404_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('the_wp_fitness_404_title',array(
		'label'	=> __('404 Title','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_404_settings',
		'type'		=> 'text'
	));	

	$wp_customize->add_setting('the_wp_fitness_404_button_label',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('the_wp_fitness_404_button_label',array(
		'label'	=> __('404 button Label','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_404_settings',
		'type'		=> 'text'
	));	

	$wp_customize->add_setting('the_wp_fitness_search_result_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('the_wp_fitness_search_result_title',array(
		'label'	=> __('No Search Result Title','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_404_settings',
		'type'		=> 'text'
	));	

	$wp_customize->add_setting('the_wp_fitness_search_result_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('the_wp_fitness_search_result_text',array(
		'label'	=> __('No Search Result Text','the-wp-fitness'),
		'section'	=> 'the_wp_fitness_404_settings',
		'type'		=> 'text'
	));	

	//Responsive Settings
	$wp_customize->add_section('the_wp_fitness_responsive_options',array(
		'title'	=> __('Responsive Options','the-wp-fitness'),
		'panel' => 'the_wp_fitness_panel_id'
	));

	$wp_customize->add_setting('the_wp_fitness_menu_open_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new The_WP_Fitness_Icon_Selector(
        $wp_customize,'the_wp_fitness_menu_open_icon',array(
		'label'	=> __('Menu Open Icon','the-wp-fitness'),
		'section' => 'the_wp_fitness_responsive_options',
		'type'	  => 'icon',
	)));

	$wp_customize->add_setting('the_wp_fitness_mobile_menu_label',array(
       'default' => __('Menu','the-wp-fitness'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('the_wp_fitness_mobile_menu_label',array(
       'type' => 'text',
       'label' => __('Mobile Menu Label','the-wp-fitness'),
       'section' => 'the_wp_fitness_responsive_options'
    ));

	$wp_customize->add_setting('the_wp_fitness_menu_close_icon',array(
		'default' => 'fas fa-times-circle',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new The_WP_Fitness_Icon_Selector(
        $wp_customize,'the_wp_fitness_menu_close_icon',array(
		'label'	=> __('Menu Close Icon','the-wp-fitness'),
		'section' => 'the_wp_fitness_responsive_options',
		'type'	  => 'icon',
	)));

	$wp_customize->add_setting('the_wp_fitness_close_menu_label',array(
       'default' => __('Close Menu','the-wp-fitness'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('the_wp_fitness_close_menu_label',array(
       'type' => 'text',
       'label' => __('Close Menu Label','the-wp-fitness'),
       'section' => 'the_wp_fitness_responsive_options'
    ));

	$wp_customize->add_setting('the_wp_fitness_hide_topbar_responsive',array(
        'default' => true,
        'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
	));
	$wp_customize->add_control('the_wp_fitness_hide_topbar_responsive',array(
     	'type' => 'checkbox',
      	'label' => __('Enable Top Header','the-wp-fitness'),
      	'section' => 'the_wp_fitness_responsive_options',
	));

	//Woocommerce Options
	$wp_customize->add_section('the_wp_fitness_woocommerce',array(
		'title'	=> __('WooCommerce Options','the-wp-fitness'),
		'panel' => 'the_wp_fitness_panel_id',
	));

	$wp_customize->add_setting('the_wp_fitness_shop_page_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_shop_page_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable Shop Page Sidebar','the-wp-fitness'),
       'section' => 'the_wp_fitness_woocommerce'
    ));

    $wp_customize->add_setting('the_wp_fitness_shop_page_navigation',array(
       'default' => true,
       'sanitize_callback' => 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_shop_page_navigation',array(
       'type' => 'checkbox',
       'label' => __('Enable Shop Page Pagination','the-wp-fitness'),
       'section' => 'the_wp_fitness_woocommerce'
    ));

    $wp_customize->add_setting('the_wp_fitness_single_product_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_single_product_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable Single Product Page Sidebar','the-wp-fitness'),
       'section' => 'the_wp_fitness_woocommerce'
    ));

    $wp_customize->add_setting('the_wp_fitness_single_related_products',array(
       'default' => true,
       'sanitize_callback' => 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_single_related_products',array(
       'type' => 'checkbox',
       'label' => __('Enable Related Products','the-wp-fitness'),
       'section' => 'the_wp_fitness_woocommerce'
    ));

    $wp_customize->add_setting('the_wp_fitness_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_products_per_page',array(
		'label'	=> __('Products Per Page','the-wp-fitness'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'the_wp_fitness_woocommerce',
		'type'=> 'number',
	));

	$wp_customize->add_setting('the_wp_fitness_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_products_per_row',array(
		'label'	=> __('Products Per Row','the-wp-fitness'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'the_wp_fitness_woocommerce',
		'type'=> 'select',
	));

	$wp_customize->add_setting('the_wp_fitness_product_border',array(
       'default' => false,
       'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
    ));
    $wp_customize->add_control('the_wp_fitness_product_border',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide product border','the-wp-fitness'),
       'section' => 'the_wp_fitness_woocommerce',
    ));

    $wp_customize->add_setting('the_wp_fitness_product_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('the_wp_fitness_product_padding',array(
		'label'	=> esc_html__('Product Padding','the-wp-fitness'),
		'section'=> 'the_wp_fitness_woocommerce',
	));

	$wp_customize->add_setting( 'the_wp_fitness_product_top_padding',array(
		'default' => 10,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_top_padding', array(
		'label' => esc_html__( 'Top','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('the_wp_fitness_product_bottom_padding',array(
		'default' => 10,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_bottom_padding', array(
		'label' => esc_html__( 'Bottom','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('the_wp_fitness_product_left_padding',array(
		'default' => 10,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_left_padding', array(
		'label' => esc_html__( 'Left','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'the_wp_fitness_product_right_padding',array(
		'default' => 10,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_right_padding', array(
		'label' => esc_html__( 'Right','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'the_wp_fitness_product_border_radius',array(
		'default' => '0',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_product_border_radius', array(
        'label'  => __('Product Border Radius','the-wp-fitness'),
        'section'  => 'the_wp_fitness_woocommerce',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));

	$wp_customize->add_setting('the_wp_fitness_product_button_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('the_wp_fitness_product_button_padding',array(
		'label'	=> esc_html__('Product Button Padding','the-wp-fitness'),
		'section'=> 'the_wp_fitness_woocommerce',
	));

	$wp_customize->add_setting( 'the_wp_fitness_product_button_top_padding',array(
		'default' => 10,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_button_top_padding', array(
		'label' => esc_html__( 'Top','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('the_wp_fitness_product_button_bottom_padding',array(
		'default' => 10,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_button_bottom_padding', array(
		'label' => esc_html__( 'Bottom','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('the_wp_fitness_product_button_left_padding',array(
		'default' => 15,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_button_left_padding', array(
		'label' => esc_html__( 'Left','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'the_wp_fitness_product_button_right_padding',array(
		'default' => 15,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_button_right_padding', array(
		'label' => esc_html__( 'Right','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'the_wp_fitness_product_button_border_radius',array(
		'default' => '0',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_product_button_border_radius', array(
        'label'  => __('Product Button Border Radius','the-wp-fitness'),
        'section'  => 'the_wp_fitness_woocommerce',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));

    $wp_customize->add_setting('the_wp_fitness_product_sale_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_product_sale_position',array(
        'type' => 'radio',
        'label' => __('Product Sale Position','the-wp-fitness'),
        'section' => 'the_wp_fitness_woocommerce',
        'choices' => array(
            'Left' => __('Left','the-wp-fitness'),
            'Right' => __('Right','the-wp-fitness'),
        ),
	) );

	$wp_customize->add_setting( 'the_wp_fitness_product_sale_font_size',array(
		'default' => '13',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_product_sale_font_size', array(
        'label'  => __('Product Sale Font Size','the-wp-fitness'),
        'section'  => 'the_wp_fitness_woocommerce',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));

    $wp_customize->add_setting('the_wp_fitness_product_sale_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('the_wp_fitness_product_sale_padding',array(
		'label'	=> esc_html__('Product Sale Padding','the-wp-fitness'),
		'section'=> 'the_wp_fitness_woocommerce',
	));

	$wp_customize->add_setting( 'the_wp_fitness_product_sale_top_padding',array(
		'default' => 0,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_sale_top_padding', array(
		'label' => esc_html__( 'Top','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('the_wp_fitness_product_sale_bottom_padding',array(
		'default' => 0,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_sale_bottom_padding', array(
		'label' => esc_html__( 'Bottom','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('the_wp_fitness_product_sale_left_padding',array(
		'default' => 0,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_sale_left_padding', array(
		'label' => esc_html__( 'Left','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('the_wp_fitness_product_sale_right_padding',array(
		'default' => 0,
		'sanitize_callback' => 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_product_sale_right_padding', array(
		'label' => esc_html__( 'Right','the-wp-fitness' ),
		'type' => 'number',
		'section' => 'the_wp_fitness_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'the_wp_fitness_product_sale_border_radius',array(
		'default' => '50',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_product_sale_border_radius', array(
        'label'  => __('Product Sale Border Radius','the-wp-fitness'),
        'section'  => 'the_wp_fitness_woocommerce',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));

	//Footer
	$wp_customize->add_section('the_wp_fitness_copy_text',array(
		'title'	=> __('Footer Section','the-wp-fitness'),
		'panel' => 'the_wp_fitness_panel_id',
	));	

	$wp_customize->add_setting('the_wp_fitness_hide_scroll',array(
        'default' => 'true',
        'sanitize_callback'	=> 'the_wp_fitness_sanitize_checkbox'
	));
	$wp_customize->add_control('the_wp_fitness_hide_scroll',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Back To Top','the-wp-fitness'),
      	'section' => 'the_wp_fitness_copy_text',
	));

	$wp_customize->add_setting('the_wp_fitness_back_to_top',array(
        'default' => 'Right',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_back_to_top',array(
        'type' => 'radio',
        'label' => __('Back to Top Alignment','the-wp-fitness'),
        'section' => 'the_wp_fitness_copy_text',
        'choices' => array(
            'Left' => __('Left','the-wp-fitness'),
            'Right' => __('Right','the-wp-fitness'),
            'Center' => __('Center','the-wp-fitness'),
        ),
	) );

	$wp_customize->add_setting('the_wp_fitness_footer_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'the_wp_fitness_footer_bg_color', array(
		'label'    => __('Footer Background Color', 'the-wp-fitness'),
		'section'  => 'the_wp_fitness_copy_text',
	)));

	$wp_customize->add_setting('the_wp_fitness_footer_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'the_wp_fitness_footer_bg_image',array(
        'label' => __('Footer Background Image','the-wp-fitness'),
        'section' => 'the_wp_fitness_copy_text'
	)));

	$wp_customize->add_setting('the_wp_fitness_footer_widget',array(
        'default'           => '4',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices',
    ));
    $wp_customize->add_control('the_wp_fitness_footer_widget',array(
        'type'        => 'radio',
        'label'       => __('No. of Footer columns', 'the-wp-fitness'),
        'section'     => 'the_wp_fitness_copy_text',
        'description' => __('Select the number of footer columns and add your widgets in the footer.', 'the-wp-fitness'),
        'choices' => array(
            '1'     => __('One column', 'the-wp-fitness'),
            '2'     => __('Two columns', 'the-wp-fitness'),
            '3'     => __('Three columns', 'the-wp-fitness'),
            '4'     => __('Four columns', 'the-wp-fitness')
        ),
    )); 

    $wp_customize->add_setting('the_wp_fitness_copyright_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('the_wp_fitness_copyright_padding',array(
		'label'	=> esc_html__('Copyright Padding','the-wp-fitness'),
		'section'=> 'the_wp_fitness_copy_text',
	));

    $wp_customize->add_setting('the_wp_fitness_top_copyright_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_top_copyright_padding',array(
		'description'	=> __('Top','the-wp-fitness'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'the_wp_fitness_copy_text',
		'type'=> 'number'
	));

	$wp_customize->add_setting('the_wp_fitness_bottom_copyright_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'the_wp_fitness_sanitize_float'
	));
	$wp_customize->add_control('the_wp_fitness_bottom_copyright_padding',array(
		'description'	=> __('Bottom','the-wp-fitness'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'the_wp_fitness_copy_text',
		'type'=> 'number'
	));

	$wp_customize->add_setting('the_wp_fitness_copyright_alignment',array(
        'default' => 'center',
        'sanitize_callback' => 'the_wp_fitness_sanitize_choices'
	));
	$wp_customize->add_control('the_wp_fitness_copyright_alignment',array(
        'type' => 'radio',
        'label' => __('Copyright Alignment','the-wp-fitness'),
        'section' => 'the_wp_fitness_copy_text',
        'choices' => array(
            'left' => __('Left','the-wp-fitness'),
            'right' => __('Right','the-wp-fitness'),
            'center' => __('Center','the-wp-fitness'),
        ),
	) );

	$wp_customize->add_setting( 'the_wp_fitness_copyright_font_size', array(
		'default'=> '15',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new The_WP_Fitness_WP_Customize_Range_Control( $wp_customize, 'the_wp_fitness_copyright_font_size', array(
        'label'  => __('Copyright Font Size','the-wp-fitness'),
        'section'  => 'the_wp_fitness_copy_text',
        'description' => __('Measurement is in pixel.','the-wp-fitness'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));
	
	$wp_customize->add_setting('the_wp_fitness_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('the_wp_fitness_footer_text',array(
		'label'	=> __('Copyright Text','the-wp-fitness'),
		'description'	=> __('Add some text for footer like copyright etc.','the-wp-fitness'),
		'section'=> 'the_wp_fitness_copy_text',
		'setting'=> 'the_wp_fitness_footer_text',
		'type'=> 'text'
	));

}
add_action( 'customize_register', 'the_wp_fitness_customize_register' );

// logo resize
load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class The_WP_Fitness_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'The_WP_Fitness_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new The_WP_Fitness_Customize_Section_Pro(
				$manager,
				'the_wp_fitness_pro_link',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Upgrade to Pro', 'the-wp-fitness' ),
					'pro_text' => esc_html__( 'Go Pro', 'the-wp-fitness' ),
					'pro_url'  => esc_url('https://www.themesglance.com/themes/fitness-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'the-wp-fitness-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'the-wp-fitness-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
The_WP_Fitness_Customize::get_instance();