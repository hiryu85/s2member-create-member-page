<?php 
/*
Plugin Name: s2member - user's page after user registration
Description: Create a member page after user registration 
Author: Chialastri Mirko <chialastri.mirko@gmail.ccom>
Tags: s2member, member page, protected area
Text Domain: s2member_member_page
*/
define('S2MEMBER_PRIVATE_PAGE_OPTION_GROUP', 's2member_private_page');
define('S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX', 's2m_pp_');

register_activation_hook(__FILE__, 's2_personal_page_activate');

// Add page after new user registered
add_action( 'user_register', 's2_personal_page' );

add_filter( 'plugin_row_meta', 's2_register_plugin_links', 10, 2 );
add_filter( 'plugin_action_links', 's2_register_plugin_links', 10, 2 );


function s2_personal_page_activate() {	
	add_option( S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_title', '{{username}}');
	add_option( S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_content', '');
	add_option( S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_template', 'page.php');
	add_option( S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_parent', 0);
}

function s2_register_plugin_links( $links, $file ) {
	$base = plugin_basename( __FILE__ );

	if ( $file == $base ) {
		$links[] = '<a href="options-general.php?page=s2member-private-page-settings">' . _( 'Settings' ) . '</a>';
	}

	return $links;
}

function s2_personal_page($user_id) {
	
	$user_info = get_userdata($user_id);
	$username  = $user_info->user_login;

	$post                 = array();
	$post['post_name']    = $username; 
	$post['post_type']    = 'page';

	$post['post_content'] = esc_attr(
		get_option(S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_content', '')
	);

	$post['post_author']  = 1;
	$post['post_status']  = 'publish';                               
	
	$post['post_title']   = str_replace(
		array('{{username}}'), 
		array($username), 
		get_option(S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_title', 0)
	);

	$post['post_parent']  = get_option(S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_parent', 0);


	$post_id = wp_insert_post($post);

	if (!$post_id) {
		wp_die('Error creating user page');
	} 

	update_post_meta(
		$post_id, 
		'_wp_page_template', 
		get_option(S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_template', 'page.php')
	);

	$user = new WP_User($user_id);
	$user->add_cap(sprintf('access_s2member_ccap_%s', $username));
	
	update_post_meta($post_id, 's2member_ccaps_req', $username);

	$new_options = Array(); // s2member array for security level
	$new_options["ws_plugin__s2member_level0_pages"] = $post_id; // set Level0 for this Page

	// s2member update
	c_ws_plugin__s2member_menu_pages::update_all_options ($new_options, true, false, array ("page-conflict-warnings"), true); 

	return;
}



require dirname(__FILE__). '/options.php';