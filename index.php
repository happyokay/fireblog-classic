<?php
/**
 * Main posts template.
 *
 * @package FireblogClassic
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
			<h6 class="dateline"><?php echo esc_html( fireblog_classic_post_dateline() ); ?></h6>
			<h2 class="article-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<a class="permalink" href="<?php the_permalink(); ?>" aria-label="<?php esc_attr_e( 'Permanent link', 'fireblog-classic' ); ?>">&#9733;</a>
			</h2>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading', 'fireblog-classic' ) ); ?>
			</div>
		</article>
		<hr class="post-divider">
		<?php
	endwhile;

	the_posts_navigation();
else :
	?>
	<section class="not-found">
		<h1><?php esc_html_e( 'Nothing published yet.', 'fireblog-classic' ); ?></h1>
	</section>
	<?php
endif;

get_footer();
