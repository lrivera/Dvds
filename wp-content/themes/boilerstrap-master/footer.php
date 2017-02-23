<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Boilerstrap
 * @since Boilerstrap 1.0
 */
?>
  	</div><!-- #main .wrapper -->
  	<footer id="colophon" role="contentinfo">
  		<div class="site-info">
  			<?php if ( is_active_sidebar( 'footer' ) ) : ?>
  				<div class="footer-sidebar" role="complementary">
  					<?php dynamic_sidebar( 'footer' ); ?>
  				</div><!-- #secondary -->
  			<?php endif; ?>
  		</div><!-- .site-info -->
  	</footer><!-- #colophon -->
  </div><!-- #page -->

  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <?php wp_footer(); ?>

</body>
</html>