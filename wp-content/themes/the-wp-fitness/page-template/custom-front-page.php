<?php
/**
 * Template Name: Custom home page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action('the_wp_fitness_above_slider_section'); ?>
  
  <?php if( get_theme_mod( 'the_wp_fitness_slider_hide') != '') { ?>
    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="<?php echo esc_attr(get_theme_mod('the_wp_fitness_slider_speed',3000)); ?>"> 
        <?php $the_wp_fitness_content_pages = array();
        for ( $count = 1; $count <= 4; $count++ ) {
          $mod = intval( get_theme_mod( 'the_wp_fitness_slidersettings_page' . $count ));
          if ( 'page-none-selected' != $mod ) {
            $the_wp_fitness_content_pages[] = $mod;
          }
        }
        if( !empty($the_wp_fitness_content_pages) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $the_wp_fitness_content_pages,
            'orderby' => 'post__in'
          );
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) :
          $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <?php the_post_thumbnail(); ?>
              <div class="carousel-caption">
                <div class="inner_carousel">
                  <?php if ( get_theme_mod('the_wp_fitness_slider_title',true) != '' ) {?>
                    <h1><?php the_title(); ?></h1>
                  <?php }?> 
                  <?php if ( get_theme_mod('the_wp_fitness_slider_button_label','READ MORE') != '' && get_theme_mod('the_wp_fitness_slider_button',true) != '') {?>
                    <div class ="read-more">
                      <a href="<?php echo esc_url( get_permalink() );?>"><?php echo esc_html( get_theme_mod('the_wp_fitness_slider_button_label',__('READ MORE','the-wp-fitness')) ); ?><i class="fas fa-arrow-right p-1"></i><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('the_wp_fitness_slider_button_label',__('READ MORE','the-wp-fitness')) ); ?></span></a>
                    </div> 
                  <?php }?>                   
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-caret-left"></i></span>
          <span class="screen-reader-text"><?php echo esc_html_e('Previous','the-wp-fitness'); ?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-caret-right"></i></span>
          <span class="screen-reader-text"><?php echo esc_html_e('Next','the-wp-fitness'); ?></span>
        </a>
      </div>  
      <div class="clearfix"></div>
    </section> 
  <?php }?>

  <?php do_action('the_wp_fitness_after_slider_section'); ?>

  <?php if( get_theme_mod( 'the_wp_fitness_blogcategory_setting') != '' || get_theme_mod( 'the_wp_fitness_sec1_title') != '' || get_theme_mod( 'the_wp_fitness_sec1_subtitle') != '' || get_theme_mod( 'the_wp_fitness_trainer_name') != '') { ?>
    <section id="trainer" class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-8">
            <div class="row">
              <?php 
              $the_wp_fitness_catData = get_theme_mod('the_wp_fitness_blogcategory_setting');
              if($the_wp_fitness_catData){              
                $the_wp_fitness_page_query = new WP_Query(array( 'category_name' => esc_html( $the_wp_fitness_catData ,'the-wp-fitness')));?>
                <?php while( $the_wp_fitness_page_query->have_posts() ) : $the_wp_fitness_page_query->the_post(); ?>
                <div class="col-lg-4 col-md-6">
                  <div class="trainerbox mb-5">
                    <div class="abt-img-box"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?>
                    </div>
                    <h3 class="py-4 text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
                  </div>
                </div>
                <?php endwhile;
                wp_reset_postdata();
              }
              ?>
              <div class="clearfix"></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <?php if( get_theme_mod('the_wp_fitness_sec1_title') != ''){ ?>     
              <h2 class="p-0"><?php echo esc_html(get_theme_mod('the_wp_fitness_sec1_title','')); ?></h2>
              <hr class="images_border">
            <?php }?>
            <?php if( get_theme_mod('the_wp_fitness_sec1_subtitle') != ''){ ?>
              <p class="subtitle mt-4"><?php echo esc_html(get_theme_mod('the_wp_fitness_sec1_subtitle','')); ?>
              </p>
            <?php }?>
            <?php if( get_theme_mod('the_wp_fitness_trainer_link') != ''){ ?>
              <div class ="testbutton">
                <a href="<?php echo esc_url(get_theme_mod('the_wp_fitness_trainer_link','')); ?>"><span><?php echo esc_html(get_theme_mod('the_wp_fitness_trainer_name','')); ?></span><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('the_wp_fitness_trainer_name','')); ?></span></a>
              </div>
            <?php }?>
          </div>
        </div>
      </div>
    </section>
  <?php }?>
    
  <?php do_action('the_wp_fitness_after_trainer_section'); ?>

  <?php if( get_theme_mod( 'the_wp_fitness_gallery1_setting') != '' || get_theme_mod( 'the_wp_fitness_gallery2_setting') != '' || get_theme_mod( 'the_wp_fitness_gallery3_setting') != '' || get_theme_mod( 'the_wp_fitness_gallery4_setting') != '' || get_theme_mod( 'the_wp_fitness_gallery5_setting') != '') { ?>
    <section id="gallery">
      <div class="row m-0">
        <div class="col-lg-4 col-md-4 gal-img p-0">
          <?php
          $the_wp_fitness_postData1 =  get_theme_mod('the_wp_fitness_gallery1_setting');
          if($the_wp_fitness_postData1){
            $args = array( 'name' => esc_html($the_wp_fitness_postData1 ,'the-wp-fitness'));
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="box-image1 text-center">
                  <?php the_post_thumbnail(); ?>
                </div>
              <?php endwhile; 
              wp_reset_postdata();?>
            <?php else : ?>
              <div class="no-postfound"></div>
            <?php
          endif; }?>
        </div>
        <div class="col-lg-8 col-md-8 gal-img p-0">
          <div class="row m-0">
            <div class="col-lg-8 col-md-8 gal-img p-0">
              <?php
              $the_wp_fitness_postData1 =  get_theme_mod('the_wp_fitness_gallery2_setting');
              if($the_wp_fitness_postData1){
                $args = array( 'name' => esc_html($the_wp_fitness_postData1 ,'the-wp-fitness'));
                $query = new WP_Query( $args );
                if ( $query->have_posts() ) :
                  while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="box-image text-center">
                      <?php the_post_thumbnail(); ?>
                    </div>
                  <?php endwhile; 
                  wp_reset_postdata();?>
                <?php else : ?>
                  <div class="no-postfound"></div>
                <?php
              endif; }?>
            </div>
            <div class="col-lg-4 col-md-4 gal-img p-0">
              <?php
              $the_wp_fitness_postData1 =  get_theme_mod('the_wp_fitness_gallery3_setting');
              if($the_wp_fitness_postData1){
                $args = array( 'name' => esc_html($the_wp_fitness_postData1 ,'the-wp-fitness'));
                $query = new WP_Query( $args );
                if ( $query->have_posts() ) :
                  while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="box-image text-center">
                      <?php the_post_thumbnail(); ?>
                    </div>
                  <?php endwhile; 
                  wp_reset_postdata();?>
                <?php else : ?>
                  <div class="no-postfound"></div>
                <?php
              endif; }?>
            </div>
          </div>
          <div class="row m-0">
            <div class="col-lg-4 col-md-4 gal-img p-0">
              <?php
              $the_wp_fitness_postData1 =  get_theme_mod('the_wp_fitness_gallery4_setting');
              if($the_wp_fitness_postData1){
                $args = array( 'name' => esc_html($the_wp_fitness_postData1 ,'the-wp-fitness'));
                $query = new WP_Query( $args );
                if ( $query->have_posts() ) :
                  while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="box-image text-center">
                      <?php the_post_thumbnail(); ?>
                    </div>
                  <?php endwhile; 
                  wp_reset_postdata();?>
                <?php else : ?>
                  <div class="no-postfound"></div>
                <?php
              endif; }?>
            </div>
            <div class="col-lg-8 col-md-8 gal-img p-0">
              <?php
              $the_wp_fitness_postData1 =  get_theme_mod('the_wp_fitness_gallery5_setting');
              if($the_wp_fitness_postData1){
                $args = array( 'name' => esc_html($the_wp_fitness_postData1 ,'the-wp-fitness'));
                $query = new WP_Query( $args );
                if ( $query->have_posts() ) :
                  while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="box-image text-center">
                      <?php the_post_thumbnail(); ?>
                    </div>
                  <?php endwhile; 
                  wp_reset_postdata();?>
                <?php else : ?>
                  <div class="no-postfound"></div>
                <?php
              endif; }?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php }?>

  <?php do_action('the_wp_fitness_after_gallery_section'); ?>

  <?php if( get_theme_mod( 'the_wp_fitness_about_setting') != '' || get_theme_mod( 'the_wp_fitness_about_name') != '') { ?>
    <section class="about py-5">
      <div class="container">
        <div class="row">
          <?php
          $the_wp_fitness_postData1 =  get_theme_mod('the_wp_fitness_about_setting');
          if($the_wp_fitness_postData1){
            $args = array( 'name' => esc_html($the_wp_fitness_postData1 ,'the-wp-fitness'));
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="col-lg-8 col-md-8">
                  <h3><?php the_title(); ?></h3>
                  <p><?php the_excerpt(); ?></p>
                  <div class ="testbutton">
                    <a href="<?php echo esc_url(get_theme_mod('the_wp_fitness_about_link','')); ?>"><span><?php echo esc_html(get_theme_mod('the_wp_fitness_about_name','')); ?></span><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('the_wp_fitness_about_name','')); ?></span></a>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4">
                  <div class="abt-image">
                    <?php the_post_thumbnail(); ?>
                  </div>
                </div>          
              <?php endwhile; 
              wp_reset_postdata();?>
            <?php else : ?>
              <div class="no-postfound"></div>
            <?php
          endif; }?>
        </div>
      </div>
    </section>
  <?php }?>

  <?php do_action('the_wp_fitness_after_about_section'); ?>

  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="entry-content"><?php the_content(); ?></div>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>

<?php get_footer(); ?>