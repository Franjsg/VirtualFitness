<?php
/**
 * The template for displaying search forms in The WP Fitness
 * @package The WP Fitness
 */
?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'the-wp-fitness' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( get_theme_mod('the_wp_fitness_search_placeholder', __('Search', 'the-wp-fitness')) ); ?>" value="<?php the_search_query(); ?>" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_html_x( 'Search', 'submit button', 'the-wp-fitness' ); ?>">
</form>