<?php


include 'wp-load.php'; // Load WordPress

$find = array("http://dev-url.com/"); // Array of development urlss. Used as an array allowing for changes in folder names, subdomains, etc.
$replace = array("http://production-url.com/"); // Array of production urls to replace dev URLs. Each URL must match the position in the Array of the URL its replacing.

if(count($find) !== count($replace)){
	die("Production urls must equal development urls");
}	

// Query all content posts
$rows = $wpdb->get_results("SELECT ID, post_content FROM wp_posts");

foreach($rows AS $row){

	$row->post_content = str_replace($find, $replace, $row->post_content);

	$wpdb->update('wp_posts', array('post_content' => $row->post_content), array('ID' => $row->ID), array( '%s' ), array( '%d' ) );
	
}