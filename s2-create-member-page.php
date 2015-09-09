<?php 

// Add page after new user registered
add_action('user_register', 'create_member_page');

function create_member_page($user_id) {

		$user_info = get_userdata($user_id);
		$username = $user_info->user_login;
		$post = array();
		$post['post_name'] = $username; // The slug for the page
		$post['post_type'] = 'page'; //sets type
		$post['post_content'] = esc_attr($username.' - This page was created for you and any messages that we need to send you with regards to any products, services or changes to your membership will be posted here.'.$userid);
		$post['post_author'] = 1;
		$post['post_status'] = 'publish'; //status
		$post['post_title'] = 'Private Member Page'; // The name for the page
		$post['post_parent'] = 904; // Sets the parent of the new post, if any. Default 0.
		$post_id = wp_insert_post ($post);
		if (!$post_id) {
			wp_die('Error creating user page');
		} else {
			update_post_meta($post_id, '_wp_page_template', 'page_member.php');
			$user = new WP_User($user_id);
			$user->add_cap("access_s2member_ccap_$username");
			update_post_meta($post_id, 's2member_ccaps_req', "$username");
			$new_options = Array(); // s2member array for security level
			$new_options["ws_plugin__s2member_level0_pages"] = $post_id; // set Level0 for this Page
			c_ws_plugin__s2member_menu_pages::update_all_options ($new_options, true, false, array ("page-conflict-warnings"), true); // s2member update
			}
return;
}
