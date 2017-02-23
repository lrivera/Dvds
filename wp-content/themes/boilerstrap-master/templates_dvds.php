<?php /* Template Name: DVD's Search */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<h1><?php the_title(); ?></h1>

			<form class="form-inline" method="post">
			  <div class="form-group">
			    <label class="sr-only" for="query">Search by Name, Actors, Language, Category.</label>
			    <div class="input-group">
			      <input type="text" class="form-control" id="query" placeholder="i.e. Star Wars" name="query" />
			    </div>
			  </div>
			  <button type="submit" class="btn btn-primary">Search</button>
			</form>

			<?php
				global $wpdb;

				$query = "%".$_POST['query']."%";
				$prep = $wpdb->prepare('
					SELECT 
						DISTINCT f.film_id,
						f.title,f.description,
						f.release_year,
			            f.rental_duration,
			            f.rental_rate,
			            f.length,
			            f.replacement_cost,
			            f.rating,
			            f.special_features,
			            c.name as category,
			            l.name as languaje
					FROM film f  
						JOIN film_category fc ON (fc.film_id = f.film_id) 
						JOIN category c ON (fc.category_id = c.category_id)
						JOIN language l ON (l.language_id = f.language_id )
						JOIN film_actor fa ON (fa.film_id = f.film_id) 
						left JOIN actor a ON (a.actor_id = fa.actor_id)
			        WHERE 
						f.title LIKE %s
			            OR a.first_name LIKE %s
			            OR a.last_name LIKE %s
			            OR c.name LIKE %s
			            OR l.name LIKE %s 
					LIMIT 10;',$query,$query,$query,$query,$query);

				$results = $wpdb->get_results( $prep, ARRAY_A );

				// var_dump($results);

				foreach ($results as $film) {
					?>

						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">
						    	<div class="row">
									<div class="col-md-10"><?php echo $film['title']?></div>
									<div class="col-md-2"><?php echo $film['release_year']?></div>
								</div>
						    </h3>
						  </div>
						  <div class="panel-body">
						  	
							<div class="row">
								<div class="col-md-4"><?php echo $film['special_features']?></div>
								<div class="col-md-4"><?php echo $film['category']?></div>
								<div class="col-md-4"><?php echo $film['languaje']?></div>
							</div>
							<div class="row">
								<div class="col-md-12"><?php echo $film['description']?></div>
							</div>
							<div class="row">
								<div class="col-md-4"><?php echo $film['rental_duration']?></div>
								<div class="col-md-4"><?php echo $film['replacement_cost']?></div>
								<div class="col-md-4"><?php echo $film['rating']?></div>
							</div>

						</div>
					  </div>
					<?php
				}
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
