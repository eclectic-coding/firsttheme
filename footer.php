<?php
$footer_layout  = sanitize_text_field(get_theme_mod('_themename_footer_layout', '3,3,3,3'));
$footer_layout = preg_replace('/\s+/', '', $footer_layout);
$columns        = explode( ',', $footer_layout );
$widgets_active = false;
foreach ( $columns as $i => $column ) {
	if ( is_active_sidebar( 'footer-sidebar-' . ( $i + 1 ) ) ) {
		$widgets_active = true;
	}
}
?>
</div>
<footer role="contentinfo" id="footer">
	<?php if ( $widgets_active ) { ?>
		<?php get_template_part( 'template-parts/footer/widgets' ); ?>
	<?php } ?>

	<?php get_template_part( 'template-parts/footer/info' ); ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>

