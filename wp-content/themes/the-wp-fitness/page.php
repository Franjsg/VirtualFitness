<?php
/**
 * The template for displaying all pages.
 * @package The WP Fitness
 */
get_header(); ?>

<?php do_action('the_wp_fitness_page_footer'); ?>

<main id="maincontent" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="title-box py-4 mb-4 text-center">
        	<div class="container">
        		<h1><?php the_title(); ?></h1>
        	</div>
        </div>
        <div class="main-wrap-box py-4">
            <div class="container">
                <?php $the_wp_fitness_page_layout = get_theme_mod( 'the_wp_fitness_single_page_layout','One Column');
                if($the_wp_fitness_page_layout == 'One Column'){ ?>
                    <div id="wrapper">
                        <?php if(get_theme_mod('the_wp_fitness_single_post_breadcrumb',true) != ''){ ?>
                            <div class="bradcrumbs">
                                <?php the_wp_fitness_the_breadcrumb(); ?>
                            </div>
                        <?php }?> 
                        <div class="feature-box">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="entry-content"><?php the_content(); ?> </div>
                        <?php wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title p-3">' . __( 'Pages:', 'the-wp-fitness' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span class="page-number py-2 px-3">',
                                'link_after'  => '</span>',
                                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'the-wp-fitness' ) . ' </span>%',
                                'separator'   => '<span class="screen-reader-text">, </span>',
                        )   ); ?>       
                        <div class="clearfix"></div>
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) {
                                comments_template();
                            }
                        ?>
                    </div>
                <?php }else if($the_wp_fitness_page_layout == 'Left Sidebar'){ ?>
                    <div class="row">
                        <div  id="sidebar" class="col-lg-4 col-md-4">
                            <?php dynamic_sidebar('sidebar-2'); ?>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div id="wrapper">
                                <?php if(get_theme_mod('the_wp_fitness_single_post_breadcrumb',true) != ''){ ?>
                                    <div class="bradcrumbs">
                                        <?php the_wp_fitness_the_breadcrumb(); ?>
                                    </div>
                                <?php }?> 
                                <div class="feature-box">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="entry-content"><?php the_content(); ?> </div>
                                <?php wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title p-3">' . __( 'Pages:', 'the-wp-fitness' ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span class="page-number py-2 px-3">',
                                        'link_after'  => '</span>',
                                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'the-wp-fitness' ) . ' </span>%',
                                        'separator'   => '<span class="screen-reader-text">, </span>',
                                )   ); ?>       
                                <div class="clearfix"></div>
                                <?php
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if ( comments_open() || get_comments_number() ) {
                                        comments_template();
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php }else if($the_wp_fitness_page_layout == 'Right Sidebar'){ ?>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div id="wrapper">
                                <?php if(get_theme_mod('the_wp_fitness_single_post_breadcrumb',true) != ''){ ?>
                                    <div class="bradcrumbs">
                                        <?php the_wp_fitness_the_breadcrumb(); ?>
                                    </div>
                                <?php }?> 
                                <div class="feature-box">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="entry-content"><?php the_content(); ?> </div>
                                <?php wp_link_pages( array(
                                        'before'      => '<div class="page-links"><span class="page-links-title p-3">' . __( 'Pages:', 'the-wp-fitness' ) . '</span>',
                                        'after'       => '</div>',
                                        'link_before' => '<span class="page-number py-2 px-3">',
                                        'link_after'  => '</span>',
                                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'the-wp-fitness' ) . ' </span>%',
                                        'separator'   => '<span class="screen-reader-text">, </span>',
                                )   ); ?>       
                                <div class="clearfix"></div>
                                <?php
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if ( comments_open() || get_comments_number() ) {
                                        comments_template();
                                    }
                                ?>
                            </div>
                        </div>
                        <div  id="sidebar" class="col-lg-4 col-md-4">
                            <?php dynamic_sidebar('sidebar-2'); ?>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    <?php endwhile; // end of the loop. 
    wp_reset_postdata();?>
</main>

<?php do_action('the_wp_fitness_page_footer'); ?>

<?php get_footer(); ?>