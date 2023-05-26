<?php
/**
 * The Header for our theme.
 * @package The WP Fitness
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

  <?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
  } else {
    do_action( 'wp_body_open' );
  }?>

  <?php if(get_theme_mod('the_wp_fitness_preloader',true)){ ?>
    <?php if(get_theme_mod( 'the_wp_fitness_preloader_type','Square') == 'Square'){ ?>
      <div id="overlayer"></div>
      <span class="tg-loader">
        <span class="tg-loader-inner"></span>
      </span>
    <?php }else if(get_theme_mod( 'the_wp_fitness_preloader_type') == 'Circle') {?>    
      <div class="preloader text-center">
        <div class="preloader-container">
          <span class="animated-preloader"></span>
        </div>
      </div>
    <?php }?>
  <?php }?>
  
  <header role="banner">
    <a class="screen-reader-text skip-link" href="#maincontent"><?php esc_html_e( 'Skip to content', 'the-wp-fitness' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Skip to content', 'the-wp-fitness' ); ?></span></a>
    <div id="header">
      <?php if(get_theme_mod('the_wp_fitness_top_header',false)== true || get_theme_mod('the_wp_fitness_hide_topbar_responsive',true) == true){ ?>
        <div class="header-top text-md-start text-center">
          <div class="container">
            <div class="row">
              <div class="top-contact col-lg-3 col-md-3">
                <?php if( get_theme_mod( 'the_wp_fitness_contact_corporate','' ) != '') { ?>
                  <span class="call"><a href="tel:<?php echo esc_attr( get_theme_mod( 'the_wp_fitness_contact_corporate','' ) ); ?>"><i class="fa fa-phone me-2" aria-hidden="true"></i><?php echo esc_html( get_theme_mod('the_wp_fitness_contact_corporate','' )); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('the_wp_fitness_contact_corporate','' )); ?></span></a></span>
                <?php } ?>
              </div>   
              <div class="top-contact col-lg-4 col-md-4">
                <?php if( get_theme_mod( 'the_wp_fitness_email_corporate','' ) != '') { ?>
                  <span class="email_corporate"><a href="mailto:<?php echo esc_attr( get_theme_mod( 'the_wp_fitness_email_corporate','' ) ); ?>"><i class="fa fa-envelope me-2" aria-hidden="true"></i><?php echo esc_html( get_theme_mod('the_wp_fitness_email_corporate','') ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('the_wp_fitness_email_corporate','' )); ?></span></a></span>
                <?php } ?>
              </div>
              <div class="social-media text-md-end text-center col-lg-5 col-md-5">
                <?php if( get_theme_mod( 'the_wp_fitness_youtube_url' ) != '') { ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'the_wp_fitness_youtube_url','' ) ); ?>"><i class="fab fa-youtube ms-3" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Youtube', 'the-wp-fitness' ); ?></span></a>
                <?php } ?>
                <?php if( get_theme_mod( 'the_wp_fitness_facebook_url') != '') { ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'the_wp_fitness_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f ms-3" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'the-wp-fitness' ); ?></span></a>
                <?php } ?>
                <?php if( get_theme_mod( 'the_wp_fitness_twitter_url') != '') { ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'the_wp_fitness_twitter_url','' ) ); ?>"><i class="fab fa-twitter ms-3" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'the-wp-fitness' ); ?></span></a>
                <?php } ?>
                <?php if( get_theme_mod( 'the_wp_fitness_rss_url') != '') { ?>
                  <a href="<?php echo esc_url( get_theme_mod( 'the_wp_fitness_rss_url','' ) ); ?>"><i class="fas fa-rss ms-3" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'RSS', 'the-wp-fitness' ); ?></span></a>
                <?php } ?>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      <?php }?>
      <?php if (has_nav_menu('primary')){ ?>
        <div class="toggle-menu responsive-menu p-2">
          <button role="tab" class="mobiletoggle"><i class="<?php echo esc_html(get_theme_mod('the_wp_fitness_menu_open_icon','fas fa-bars')); ?> me-2">  </i><?php echo esc_html( get_theme_mod('the_wp_fitness_mobile_menu_label', __('Menu','the-wp-fitness'))); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('the_wp_fitness_mobile_menu_label', __('Menu','the-wp-fitness'))); ?></span>
            </button>
        </div>
      <?php }?>
      <div class="menu-sec <?php if( get_theme_mod( 'the_wp_fitness_sticky_header') != '') { ?> sticky-header"<?php } else { ?>close-sticky <?php } ?>">
        <div class="container">
          <div class="row">
            <div class="logo col-lg-4 col-md-4 wow bounceInDown py-2 px-3 text-md-start text-center align-self-center">
              <?php if ( has_custom_logo() ) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
              <?php endif; ?>
              <?php $blog_info = get_bloginfo( 'name' ); ?>
              <?php if ( ! empty( $blog_info ) ) : ?>
                <?php if( get_theme_mod('the_wp_fitness_show_site_title',true) != ''){ ?>
                  <?php if ( is_front_page() && is_home() ) : ?>
                    <h1 class="site-title p-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php else : ?>
                    <p class="site-title m-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                  <?php endif; ?>
                <?php }?>
              <?php endif; ?>
              <?php if( get_theme_mod('the_wp_fitness_show_tagline',true) != ''){ ?>
                <?php
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) :
                ?>
                  <p class="site-description m-0">
                    <?php echo esc_html($description); ?>
                  </p>
                <?php endif; ?>
              <?php }?>
            </div>        
            <div class="menubox col-lg-8 col-md-8 align-self-center">
              <div id="sidelong-menu" class="nav side-nav">
                <nav id="primary-site-navigation" class="nav-menu" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'the-wp-fitness' ); ?>">
                  <?php if (has_nav_menu('primary')){ 
                    wp_nav_menu( array( 
                      'theme_location' => 'primary',
                      'container_class' => 'main-menu-navigation clearfix' ,
                      'menu_class' => 'clearfix',
                      'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                      'fallback_cb' => 'wp_page_menu',
                    ) ); 
                  } ?>
                  <a href="javascript:void(0)" class="closebtn responsive-menu p-1"><?php echo esc_html( get_theme_mod('the_wp_fitness_close_menu_label', __('Close Menu','the-wp-fitness'))); ?><i class="<?php echo esc_html(get_theme_mod('the_wp_fitness_menu_close_icon','fas fa-times-circle')); ?> m-3"></i><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('the_wp_fitness_close_menu_label', __('Close Menu','the-wp-fitness'))); ?></span></a>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <?php if(get_theme_mod('the_wp_fitness_post_featured_image') == 'banner' ){
    if( is_singular() ) {?>
      <div id="page-site-header">
        <div class='page-header'> 
          <?php the_title( '<h1>', '</h1>' ); ?>
        </div>
      </div>
    <?php }
  }?>