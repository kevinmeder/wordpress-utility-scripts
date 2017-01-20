<?php

include 'wp-load.php';

$rows = $wpdb->get_results("SELECT ID, post_content FROM wp_posts");

foreach($rows AS $row){

	// $row->post_content = preg_replace('/(<[^>]+) id=".*?"/i', '$1', $row->post_content); // Remove all classes attributes 
	// $row->post_content = preg_replace('/(<[^>]+) class=".*?"/i', '$1', $row->post_content); // Remove all id attributes
	$row->post_content = preg_replace('/\<[\/]{0,1}div[^\>]*\>/i', '', $row->post_content); // Remove all div tags

	$wpdb->update('wp_posts', array('post_content' => $row->post_content), array('ID' => $row->ID), array( '%s' ), array( '%d' ) );

}