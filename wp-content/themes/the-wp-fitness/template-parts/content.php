<?php
/**
 * The template part for displaying post
 * @package The WP Fitness
 * @subpackage the_wp_fitness
 * @since 1.0
 */
?>
<?php 
  $archive_year  = get_the_time('Y'); 
  $archive_month = get_the_time('m'); 
  $archive_day   = get_the_time('d'); 
?> 
<article class="blog-sec p-2 mb-4">
    <div class="box-img">
      <?php if(has_post_thumbnail() && get_theme_mod('the_wp_fitness_featured_image',true) == true) { ?>
        <?php the_post_thumbnail(); ?>
      <?php }?>
    </div>
    <h2><a href="<?php echo esc_url(get_permalink() ); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
    <?php if(get_theme_mod('the_wp_fitness_metafields_date',true)==1 || get_theme_mod('the_wp_fitness_metafields_author',true)==1 || get_theme_mod('the_wp_fitness_metafields_comment',true)==1 || get_theme_mod( 'the_wp_fitness_metafields_time',true) == 1){ ?>
      <div class="post-info py-2">
        <?php if(get_theme_mod('the_wp_fitness_metafields_date',true)==1){ ?>
          <i class="fa fa-calendar" aria-hidden="true"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><span class="entry-date ms-1 me-2"><?php echo esc_html( get_the_date() ); ?></span><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a>
        <?php }?>
        <?php if(get_theme_mod('the_wp_fitness_metafields_author',true)==1){ ?>
          <i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><span class="entry-author ms-1 me-2"> <?php the_author(); ?></span><span class="screen-reader-text"><?php the_author(); ?></span></a>
        <?php }?>
        <?php if(get_theme_mod('the_wp_fitness_metafields_comment',true)==1){ ?>
          <i class="fa fa-comments" aria-hidden="true"></i><span class="entry-comments ms-1 me-2"> <?php comments_number( __('0 Comments','the-wp-fitness'), __('0 Comments','the-wp-fitness'), __('% Comments','the-wp-fitness') ); ?></span> 
        <?php }?>
        <?php if( get_theme_mod( 'the_wp_fitness_metafields_time',true) != '') { ?>
          <span class="entry-comments me-2"><i class="far fa-clock me-1" aria-hidden="true"></i> <?php echo esc_html( get_the_time() ); ?></span>
        <?php }?>
      </div>
    <?php }?>
    <?php if(get_theme_mod('the_wp_fitness_blog_post_content') == 'Full Content'){ ?>
      <?php the_content(); ?>
    <?php }
    if(get_theme_mod('the_wp_fitness_blog_post_content', 'Excerpt Content') == 'Excerpt Content'){ ?>
      <?php if(get_the_excerpt()) { ?>
        <div class="entry-content"><p class="m-0"><?php $excerpt = get_the_excerpt(); echo esc_html( the_wp_fitness_string_limit_words( $excerpt, esc_attr(get_theme_mod('the_wp_fitness_post_excerpt_number','20')))); ?> <?php echo esc_html( get_theme_mod('the_wp_fitness_button_excerpt_suffix','...') ); ?></p></div>
      <?php }?>
    <?php }?>
    <?php if ( get_theme_mod('the_wp_fitness_blog_button_text','Read Full') != '' ) {?>
      <div class="blogbtn mt-3">
        <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read Full', 'the-wp-fitness' ); ?>"><?php echo esc_html( get_theme_mod('the_wp_fitness_blog_button_text',__('Read Full', 'the-wp-fitness')) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('the_wp_fitness_blog_button_text',__('Read Full', 'the-wp-fitness')) ); ?></span></a>
      </div>
    <?php }?>
</article>