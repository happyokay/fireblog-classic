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
		<h6 class="dateline"><?php echo esc_html( fireblog_classic_post_dateline() ); ?></h6>
		<h1 class="article-title"><?php the_title(); ?></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<p>
			<a class="permalink" href="<?php the_permalink(); ?>" aria-label="<?php esc_attr_e( 'Permanent link', 'fireblog-classic' ); ?>">&#9733;</a>
		</p>
	</article>
	<?php
	the_post_navigation();
endwhile;

get_footer();
