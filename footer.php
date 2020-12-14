<?php
$footer_layout  = '3,3,3,3';
$columns        = explode( ',', $footer_layout );
$widgets_active = false;
foreach ( $columns as $i => $column ) {
	if ( is_active_sidebar( 'footer-sidebar-' . ( $i + 1 ) ) ) {
		$widgets_active = true;
	}
}
?>
</div>
<?php if ( $widgets_active ) { ?>
    <?php get_template_part('template-parts/footer/widgets'); ?>
<?php } ?>

<?php get_template_part( 'template-parts/footer/info' ); ?>

<?php wp_footer(); ?>
</body>
</html>