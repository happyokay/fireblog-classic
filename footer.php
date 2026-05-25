<?php
/**
 * Theme footer.
 *
 * @package FireblogClassic
 */
$footer_markdown = fireblog_classic_get_setting( 'fireblog_footer_markdown' );
?>
		<footer class="site-footer">
			<p><?php echo fireblog_classic_render_footer_markdown( $footer_markdown ); ?></p>
		</footer>
	</main>
</div>
<?php wp_footer(); ?>
</body>
</html>
