<?php
if (!is_admin()) {
	return;
}

add_action( 'admin_menu', 's2member_private_page_menu' );
add_action( 'admin_init', 's2member_private_page_init' );


function s2member_private_page_init() {	
	register_setting( S2MEMBER_PRIVATE_PAGE_OPTION_GROUP, S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_title' );
	register_setting( S2MEMBER_PRIVATE_PAGE_OPTION_GROUP, S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_content' );
	register_setting( S2MEMBER_PRIVATE_PAGE_OPTION_GROUP, S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_template' );
	register_setting( S2MEMBER_PRIVATE_PAGE_OPTION_GROUP, S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_parent', 'intval' );
}

function s2member_private_page_menu() {
	add_options_page( 
		_('s2member - member\'s page'), 
		_('S2Member - member\'s page'), 
		'manage_options', 
		's2member-private-page-settings', 
		's2member_private_page_content'
	);
}

function s2member_private_page_content() {
	require 'template/options.php';
}
