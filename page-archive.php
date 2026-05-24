<?php
/**
 * Archive page grouped by month.
 *
 * Template Name: Fireblog Monthly Archive
 *
 * Create a page with the slug "archive" to use this template automatically.
 *
 * @package FireblogClassic
 */

get_header();

$archive_query = new WP_Query(
	array(
		'post_type'              => 'post',
		'post_status'            => 'publish',
		'posts_per_page'         => -1,
		'orderby'                => 'date',
		'order'                  => 'DESC',
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	)
);

$current_month = '';
?>
<section class="archive-index">
	<form class="archive-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="archive-search-field"><?php esc_html_e( 'Search', 'fireblog-classic' ); ?></label>
		<input id="archive-search-field" name="s" type="text" value="<?php echo esc_attr( get_search_query() ); ?>">
		<input type="submit" value="<?php esc_attr_e( 'Search', 'fireblog-classic' ); ?>">
	</form>

	<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?>，<?php esc_html_e( '已发布的文章', 'fireblog-classic' ); ?></h1>

	<?php if ( $archive_query->have_posts() ) : ?>
		<?php while ( $archive_query->have_posts() ) : ?>
			<?php
			$archive_query->the_post();
			$post_month = get_the_date( 'F Y' );

			if ( $post_month !== $current_month ) :
				$current_month = $post_month;
				?>
				<h2 class="archive-month"><?php echo esc_html( $current_month ); ?></h2>
			<?php endif; ?>

			<p class="archive-entry">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<small><?php echo esc_html( get_the_date( 'j M Y' ) ); ?></small>
			</p>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No posts found.', 'fireblog-classic' ); ?></p>
	<?php endif; ?>
</section>
<?php
wp_reset_postdata();
get_footer();
