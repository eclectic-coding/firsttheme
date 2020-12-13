<?php

require_once( 'lib/helpers.php' );
require_once( 'lib/enqueue-assets.php' );

add_action( '_themename_after_pagination', 'after_pagination', 2 );
/**
 * Note after pagination
 *
 * @return void
 * @since 1.0.0
 *
 */
function after_pagination() {
	echo 'some text';
}

add_action( '_themename_after_pagination', 'after_pagination2', 1 );
/**
 * Note after pagination
 *
 * @return void
 *
 * @since 1.0.0
 *
 */
function after_pagination2() {
	echo 'some text222';
}

add_action( 'pre_get_posts', 'function_to_add' );
/**
 * Set pages per post
 *
 * @param $query
 *
 * @return void
 *
 * @since 1.0.0
 *
 */
function function_to_add( $query ) {
	if ( $query->is_main_query() ) {
		$query->set( 'posts_per_page', 2 );
	}
}

add_filter('_themename_no_posts_text', 'no_posts_text');
function no_posts_text() {
	return esc_html__('No posts', '');
}

?>