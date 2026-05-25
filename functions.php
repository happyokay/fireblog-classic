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

function fireblog_classic_theme_defaults() {
	$site_name = get_bloginfo( 'name' );
	if ( '' === $site_name ) {
		$site_name = 'Fireblog Classic';
	}

	return array(
		'fireblog_author_name'        => 'happy xiao',
		'fireblog_author_url'         => 'https://aa.ee',
		'fireblog_sponsor_title'      => '',
		'fireblog_sponsor_text'       => '',
		'fireblog_footer_credit'      => sprintf( '© %s %s', wp_date( 'Y' ), $site_name ),
		'fireblog_footer_author_name' => 'happy xiao',
		'fireblog_footer_author_url'  => 'https://aa.ee',
		'fireblog_footer_rss_label'   => 'RSS',
		'fireblog_footer_rss_url'     => home_url( '/feed' ),
	);
}

function fireblog_classic_get_setting( $key ) {
	$defaults = fireblog_classic_theme_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';

	return get_theme_mod( $key, $default );
}

function fireblog_classic_sanitize_setting( $key, $value ) {
	if ( false !== strpos( $key, '_url' ) ) {
		return esc_url_raw( $value );
	}

	if ( 'fireblog_sponsor_text' === $key ) {
		return sanitize_textarea_field( $value );
	}

	return sanitize_text_field( $value );
}

function fireblog_classic_settings_fields() {
	return array(
		'fireblog_author_name'        => array(
			'label'       => __( 'Sidebar byline name', 'fireblog-classic' ),
			'type'        => 'text',
			'description' => __( 'The name shown after “By” in the left sidebar.', 'fireblog-classic' ),
		),
		'fireblog_author_url'         => array(
			'label'       => __( 'Sidebar byline URL', 'fireblog-classic' ),
			'type'        => 'url',
			'description' => __( 'The link used by the sidebar byline name.', 'fireblog-classic' ),
		),
		'fireblog_footer_credit'      => array(
			'label'       => __( 'Footer copyright text', 'fireblog-classic' ),
			'type'        => 'text',
			'description' => __( 'For example: © 2026 火米博客.', 'fireblog-classic' ),
		),
		'fireblog_footer_author_name' => array(
			'label'       => __( 'Footer author name', 'fireblog-classic' ),
			'type'        => 'text',
			'description' => __( 'The name shown after “by” in the footer.', 'fireblog-classic' ),
		),
		'fireblog_footer_author_url'  => array(
			'label'       => __( 'Footer author URL', 'fireblog-classic' ),
			'type'        => 'url',
			'description' => __( 'The footer author link.', 'fireblog-classic' ),
		),
		'fireblog_footer_rss_label'   => array(
			'label'       => __( 'Footer RSS label', 'fireblog-classic' ),
			'type'        => 'text',
			'description' => __( 'The RSS link text in the footer.', 'fireblog-classic' ),
		),
		'fireblog_footer_rss_url'     => array(
			'label'       => __( 'Footer RSS URL', 'fireblog-classic' ),
			'type'        => 'url',
			'description' => __( 'The RSS feed link in the footer.', 'fireblog-classic' ),
		),
		'fireblog_sponsor_title'      => array(
			'label'       => __( 'Sidebar extra title', 'fireblog-classic' ),
			'type'        => 'text',
			'description' => __( 'Optional small block below the sidebar menu.', 'fireblog-classic' ),
		),
		'fireblog_sponsor_text'       => array(
			'label'       => __( 'Sidebar extra text', 'fireblog-classic' ),
			'type'        => 'textarea',
			'description' => __( 'Optional text shown below the sidebar menu.', 'fireblog-classic' ),
		),
	);
}

function fireblog_classic_admin_menu() {
	add_theme_page(
		__( 'Fireblog Classic Settings', 'fireblog-classic' ),
		__( 'Fireblog Classic', 'fireblog-classic' ),
		'edit_theme_options',
		'fireblog-classic',
		'fireblog_classic_render_settings_page'
	);
}
add_action( 'admin_menu', 'fireblog_classic_admin_menu' );

function fireblog_classic_save_settings_page() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	if ( 'POST' !== $_SERVER['REQUEST_METHOD'] ) {
		return;
	}

	check_admin_referer( 'fireblog_classic_save_settings' );

	foreach ( fireblog_classic_settings_fields() as $key => $field ) {
		$raw_value = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';
		set_theme_mod( $key, fireblog_classic_sanitize_setting( $key, $raw_value ) );
	}

	add_settings_error(
		'fireblog_classic_messages',
		'fireblog_classic_saved',
		__( 'Settings saved.', 'fireblog-classic' ),
		'updated'
	);
}

function fireblog_classic_render_settings_page() {
	fireblog_classic_save_settings_page();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Fireblog Classic Settings', 'fireblog-classic' ); ?></h1>
		<?php settings_errors( 'fireblog_classic_messages' ); ?>
		<form method="post">
			<?php wp_nonce_field( 'fireblog_classic_save_settings' ); ?>
			<table class="form-table" role="presentation">
				<tbody>
					<?php foreach ( fireblog_classic_settings_fields() as $key => $field ) : ?>
						<tr>
							<th scope="row">
								<label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
							</th>
							<td>
								<?php if ( 'textarea' === $field['type'] ) : ?>
									<textarea class="large-text" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" rows="4"><?php echo esc_textarea( fireblog_classic_get_setting( $key ) ); ?></textarea>
								<?php else : ?>
									<input class="regular-text" id="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" type="<?php echo esc_attr( $field['type'] ); ?>" value="<?php echo esc_attr( fireblog_classic_get_setting( $key ) ); ?>">
								<?php endif; ?>
								<?php if ( ! empty( $field['description'] ) ) : ?>
									<p class="description"><?php echo esc_html( $field['description'] ); ?></p>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

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
