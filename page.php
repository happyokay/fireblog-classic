<?php
/**
 * Static page template.
 *
 * @package FireblogClassic
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content' ); ?>>
		<h1><?php the_title(); ?></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
