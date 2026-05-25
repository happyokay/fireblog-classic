<?php
/**
 * Theme footer.
 *
 * @package FireblogClassic
 */
$footer_credit      = fireblog_classic_get_setting( 'fireblog_footer_credit' );
$footer_author_name = fireblog_classic_get_setting( 'fireblog_footer_author_name' );
$footer_author_url  = fireblog_classic_get_setting( 'fireblog_footer_author_url' );
$footer_rss_label   = fireblog_classic_get_setting( 'fireblog_footer_rss_label' );
$footer_rss_url     = fireblog_classic_get_setting( 'fireblog_footer_rss_url' );
?>
		<footer class="site-footer">
			<p>
				<?php echo esc_html( $footer_credit ); ?>
				<?php esc_html_e( 'by', 'fireblog-classic' ); ?>
				<?php if ( $footer_author_url ) : ?>
					<a href="<?php echo esc_url( $footer_author_url ); ?>"><?php echo esc_html( $footer_author_name ); ?></a>
				<?php else : ?>
					<?php echo esc_html( $footer_author_name ); ?>
				<?php endif; ?>
				<strong class="footer-separator">·</strong>
				<?php if ( $footer_rss_url ) : ?>
					<a href="<?php echo esc_url( $footer_rss_url ); ?>"><?php echo esc_html( $footer_rss_label ); ?></a>
				<?php else : ?>
					<?php echo esc_html( $footer_rss_label ); ?>
				<?php endif; ?>
			</p>
		</footer>
	</main>
</div>
<?php wp_footer(); ?>
</body>
</html>
