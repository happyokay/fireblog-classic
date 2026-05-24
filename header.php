<?php
/**
 * Theme header.
 *
 * @package FireblogClassic
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="site-box">
	<header class="site-banner">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
			<a class="site-wordmark" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php else : ?>
			<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<span class="site-title-mark" aria-hidden="true">&#9733;</span><?php bloginfo( 'name' ); ?>
			</a>
		<?php endif; ?>
	</header>
	<?php get_sidebar(); ?>
	<main id="primary" class="site-main">
