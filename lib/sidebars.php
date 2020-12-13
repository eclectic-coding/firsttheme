<?php
/**
 * Description
 *
 * @since   1.0.0
 * @author  Chuck Smith
 * @link    https://chucksmith.dev
 * @license GNU General Public License 2.0+
 */

add_action( 'widgets_init', '_themename_sidebar_widgets' );
/**
 * Description
 *
 * @return void
 *
 * @since 1.0.0
 *
 */
function _themename_sidebar_widgets() {
	register_sidebar( array(
		'id' => 'primary-sidebar',
		'name' => esc_html__( 'Primary Sidebar', '_themename'),
		'description' => esc_html__( 'This sidebar appears in the blog posts page.', '_themename'),
		'before_widget' => '<section id="%1$s" class="c-sidebar-widget u-margin-bottom-20 %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h5>',
		'after_title' => '</h5>'
	) );
}
