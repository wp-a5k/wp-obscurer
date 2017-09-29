<?php

function run_404()
{
	if(!defined('ABSPATH'))
	{
		if(!file_exists(__DIR__.'/../../../wp-load.php')) { header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found'); die; }
		require_once __DIR__.'/../../../wp-load.php';
	}

	status_header(404);
	global $wp_query;
	$wp_query->set_404();
	get_template_part('404');
	die;
}

run_404();
