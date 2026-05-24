<?php
/**
 * WordPress taxonomy/date archive template.
 *
 * @package FireblogClassic
 */

get_header();
?>
<section class="archive-index">
	<h1><?php the_archive_title(); ?></h1>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<p class="archive-entry">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<small><?php echo esc_html( get_the_date( 'j M Y' ) ); ?></small>
			</p>
		<?php endwhile; ?>
		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No posts found.', 'fireblog-classic' ); ?></p>
	<?php endif; ?>
</section>
<?php
get_footer();
