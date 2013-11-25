<?php
/**
 * Framework setup.
 * @package VisitPress
 * @since VisitPress 1.0
*/
function visitpress_bar_menu() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
		$admin_dir = get_admin_url();
		
	$wp_admin_bar->add_menu( array(
	'id' => 'custom_menu',
	'title' => __( 'Nastavení šablony', 'visitpress' ),
	'href' => $admin_dir .'admin.php?page=fw-options.php',
	'meta' => array('title' => 'VisitPress nastavení', 'class' => 'visitpresspanel') ) );
}
add_action('admin_bar_menu', 'visitpress_bar_menu', '1000');
?>