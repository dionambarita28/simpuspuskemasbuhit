<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

function is_logged_in()
{
	$ci = get_instance();

	if (!$ci->session->userdata('username')) {
		redirect('auth');
	}
}

function is_level()
{
	$ci = get_instance();
	return $ci->session->userdata('level');
}

function link_active($title, $title_page)
{
	if ($title == $title_page){
		return 'active';
	}
}


