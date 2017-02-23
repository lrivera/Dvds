<?php /* Template Name: DVD's Search */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<h1><?php the_title(); ?></h1>

			<?php
				global $wpdb;
				$results = $wpdb->get_results( '
			    	SELECT 
						f.title,f.description,
						f.release_year,
			            f.rental_duration,
			            f.rental_rate,
			            f.length,
			            f.replacement_cost,
			            f.rating,
			            f.special_features,
			            c.name as category,
			            l.name as languaje,
			            a.first_name as actor_firstname,
			            a.last_name as actor_lastname 
					FROM film f  
						JOIN film_category fc ON (fc.film_id = f.film_id) 
						JOIN category c ON (fc.category_id = c.category_id)
						JOIN language l ON (l.language_id = f.language_id )
						JOIN film_actor fa ON (fa.film_id = f.film_id) 
						left JOIN actor a ON (a.actor_id = fa.actor_id)
			        
					', ARRAY_A );

				var_dump($results);
			?>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php comments_template( '', true ); // Remove if you don't want comments ?>

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
