<?php
/**
 * Fireblog Classic theme setup.
 *
 * @package FireblogClassic
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function fireblog_classic_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 56,
			'width'       => 420,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption', 'search-form' ) );

	register_nav_menus(
		array(
			'sidebar' => __( 'Sidebar Menu', 'fireblog-classic' ),
		)
	);
}
add_action( 'after_setup_theme', 'fireblog_classic_setup' );

function fireblog_classic_assets() {
	wp_enqueue_style( 'fireblog-classic-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'fireblog_classic_assets' );

function fireblog_classic_prepend_archive_menu_item( $items, $args ) {
	if ( 'sidebar' !== $args->theme_location ) {
		return $items;
	}

	$archive_li  = '<li class="menu-item menu-item-fireblog-archive">';
	$archive_li .= '<a href="' . esc_url( home_url( '/archive/' ) ) . '">' . esc_html__( '归档', 'fireblog-classic' ) . '</a>';
	$archive_li .= '</li>';

	return $archive_li . $items;
}
add_filter( 'wp_nav_menu_items', 'fireblog_classic_prepend_archive_menu_item', 10, 2 );

function fireblog_classic_is_archive_request() {
	global $wp;

	return isset( $wp->request ) && 'archive' === trim( $wp->request, '/' );
}

function fireblog_classic_pre_handle_archive_404( $preempt, $wp_query ) {
	if ( fireblog_classic_is_archive_request() && locate_template( 'page-archive.php' ) ) {
		$wp_query->is_404 = false;
		status_header( 200 );
		return true;
	}

	return $preempt;
}
add_filter( 'pre_handle_404', 'fireblog_classic_pre_handle_archive_404', 10, 2 );

function fireblog_classic_archive_template( $template ) {
	global $wp_query;

	if ( fireblog_classic_is_archive_request() ) {
		$archive_template = locate_template( 'page-archive.php' );
		if ( $archive_template ) {
			if ( $wp_query instanceof WP_Query ) {
				$wp_query->is_404  = false;
				$wp_query->is_page = true;
			}
			status_header( 200 );
			return $archive_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'fireblog_classic_archive_template' );

function fireblog_classic_archive_document_title( $parts ) {
	if ( fireblog_classic_is_archive_request() ) {
		$parts['title'] = __( '归档', 'fireblog-classic' );
	}

	return $parts;
}
add_filter( 'document_title_parts', 'fireblog_classic_archive_document_title' );

function fireblog_classic_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'fireblog_classic_options',
		array(
			'title'    => __( 'Fireblog Options', 'fireblog-classic' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'fireblog_author_name',
		array(
			'default'           => 'happy xiao',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'fireblog_author_name',
		array(
			'label'   => __( 'Sidebar author name', 'fireblog-classic' ),
			'section' => 'fireblog_classic_options',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'fireblog_author_url',
		array(
			'default'           => 'https://aa.ee',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'fireblog_author_url',
		array(
			'label'   => __( 'Sidebar author URL', 'fireblog-classic' ),
			'section' => 'fireblog_classic_options',
			'type'    => 'url',
		)
	);

	$wp_customize->add_setting(
		'fireblog_sponsor_title',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'fireblog_sponsor_title',
		array(
			'label'   => __( 'Sponsor title', 'fireblog-classic' ),
			'section' => 'fireblog_classic_options',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'fireblog_sponsor_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);

	$wp_customize->add_control(
		'fireblog_sponsor_text',
		array(
			'label'   => __( 'Sponsor text', 'fireblog-classic' ),
			'section' => 'fireblog_classic_options',
			'type'    => 'textarea',
		)
	);
}
add_action( 'customize_register', 'fireblog_classic_customize_register' );

function fireblog_classic_default_sidebar_menu() {
	$items = array(
		array( __( '归档', 'fireblog-classic' ), home_url( '/archive/' ) ),
		array( __( 'Linked List', 'fireblog-classic' ), home_url( '/category/linked/' ) ),
		array( __( 'Projects', 'fireblog-classic' ), home_url( '/projects/' ) ),
		array( __( 'Contact', 'fireblog-classic' ), home_url( '/contact/' ) ),
		array( __( 'Colophon', 'fireblog-classic' ), home_url( '/colophon/' ) ),
		array( __( 'Feeds / Social', 'fireblog-classic' ), get_bloginfo( 'rss2_url' ) ),
		array( __( 'Sponsorship', 'fireblog-classic' ), home_url( '/sponsorship/' ) ),
	);
	?>
	<ul>
		<?php foreach ( $items as $item ) : ?>
			<li><a href="<?php echo esc_url( $item[1] ); ?>"><?php echo esc_html( $item[0] ); ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php
}

function fireblog_classic_post_dateline() {
	return get_the_date( 'l, j F Y' );
}
