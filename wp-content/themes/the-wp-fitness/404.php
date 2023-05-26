<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package The WP Fitness
 */
get_header(); ?>

<div class="container">
	<main id="maincontent" role="main" id="wrapper">
        <div class="page-content">					
			<div class="notfound py-3 text-center">
				<?php if(get_theme_mod('the_wp_fitness_404_title','404 Not Found')){ ?>
					<h1><?php echo esc_html( get_theme_mod('the_wp_fitness_404_title',__('404 Not Found', 'the-wp-fitness' )) ); ?></h1>
				<?php }?>
				<?php if(get_theme_mod('the_wp_fitness_404_button_label','Back to home page')){ ?>
					<div class="read-moresec mt-3">
		        		<a href="<?php echo esc_url( home_url() ); ?>" class="button py-2 px-4"><?php echo esc_html( get_theme_mod('the_wp_fitness_404_button_label',__('Back to home page', 'the-wp-fitness' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('the_wp_fitness_404_button_label',__('Back to home page', 'the-wp-fitness' )) ); ?></span></a>
					</div>
				<?php }?>
			</div>			
			<div class="clearfix"></div>
        </div>
	</main>
</div>

<?php get_footer(); ?>