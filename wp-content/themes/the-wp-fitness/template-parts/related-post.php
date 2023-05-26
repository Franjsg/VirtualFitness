<?php $related_posts = the_wp_fitness_related_posts_function(); ?>

<?php if ( $related_posts->have_posts() ): ?>

	<div class="related-posts clearfix py-3">
		<?php if ( get_theme_mod('the_wp_fitness_related_posts_title','You May Also Like') != '' ) {?>
			<h2 class="related-posts-main-title"><?php echo esc_html( get_theme_mod('the_wp_fitness_related_posts_title',__('You May Also Like','the-wp-fitness')) ); ?></h2>
		<?php }?>
		<div class="row">
			<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>

				<div class="col-lg-4 col-md-4">
					<article class="blog-sec p-2 mb-4">
					    <div class="mainimage">
					      <?php 
					        if(has_post_thumbnail() && get_theme_mod('the_wp_fitness_featured_image',true) == true) { 
					          the_post_thumbnail(); 
					        }
					      ?>
					    </div>
					    <h3><a href="<?php echo esc_url(get_permalink() ); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
					    <?php if(get_the_excerpt()) { ?>
					        <div class="entry-content"><p class="m-0"><?php $excerpt = get_the_excerpt(); echo esc_html( the_wp_fitness_string_limit_words( $excerpt, esc_attr(get_theme_mod('the_wp_fitness_post_excerpt_number','20')))); ?> <?php echo esc_html( get_theme_mod('the_wp_fitness_button_excerpt_suffix','...') ); ?></p></div>
					    <?php }?>
					    <?php if ( get_theme_mod('the_wp_fitness_blog_button_text','Read Full') != '' ) {?>
					      <div class="blogbtn mt-3">
					        <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small" title="<?php esc_attr_e( 'Read Full', 'the-wp-fitness' ); ?>"><?php echo esc_html( get_theme_mod('the_wp_fitness_blog_button_text',__('Read Full', 'the-wp-fitness')) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('the_wp_fitness_blog_button_text',__('Read Full', 'the-wp-fitness')) ); ?></span></a>
					      </div>
					    <?php }?>
					</article>
				</div>

			<?php endwhile; ?>
		</div>

	</div><!--/.post-related-->
<?php endif; ?>

<?php wp_reset_postdata(); ?>