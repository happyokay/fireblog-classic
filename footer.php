<?php
/**
 * Theme footer.
 *
 * @package FireblogClassic
 */
?>
		<footer class="site-footer">
			<p><?php echo esc_html( get_bloginfo( 'name' ) ); ?></p>
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>.</p>
		</footer>
	</main>
</div>
<?php wp_footer(); ?>
</body>
</html>
