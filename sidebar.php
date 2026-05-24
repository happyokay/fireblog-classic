<?php
/**
 * Theme sidebar.
 *
 * @package FireblogClassic
 */

$author_name   = get_theme_mod( 'fireblog_author_name', get_bloginfo( 'name' ) );
$sponsor_title = get_theme_mod( 'fireblog_sponsor_title', '' );
$sponsor_text  = get_theme_mod( 'fireblog_sponsor_text', '' );
?>
<aside class="site-sidebar" aria-label="<?php esc_attr_e( 'Site navigation', 'fireblog-classic' ); ?>">
	<p>
		<?php esc_html_e( 'By', 'fireblog-classic' ); ?>
		<strong><?php echo esc_html( $author_name ); ?></strong>
	</p>

	<?php
	if ( has_nav_menu( 'sidebar' ) ) {
		wp_nav_menu(
			array(
				'theme_location' => 'sidebar',
				'container'      => false,
				'depth'          => 1,
				'fallback_cb'    => false,
			)
		);
	} else {
		fireblog_classic_default_sidebar_menu();
	}
	?>

	<?php if ( $sponsor_title || $sponsor_text ) : ?>
		<div class="sidebar-sponsor">
			<?php if ( $sponsor_title ) : ?>
				<span class="sidebar-sponsor-title"><?php echo esc_html( $sponsor_title ); ?></span>
			<?php endif; ?>
			<?php if ( $sponsor_text ) : ?>
				<p><?php echo esc_html( $sponsor_text ); ?></p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</aside>
