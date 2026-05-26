<?php
/**
 * Single post template.
 *
 * @package FireblogClassic
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
		<h1 class="article-title"><?php the_title(); ?></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<p class="single-dateline">
			<span aria-hidden="true">&#9733;</span> <em><?php echo esc_html( fireblog_classic_post_short_date() ); ?></em>
		</p>
	</article>
	<?php
	the_post_navigation();
endwhile;

get_footer();
