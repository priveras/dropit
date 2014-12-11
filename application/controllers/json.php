<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller {
	
	public function my_products()
	{
		session_start();
		
		$page_num = (strlen($_REQUEST['page_num'])==0) ? 1 : $_REQUEST['page_num'];
		$page_num = ($page_num - 1)*12;
		
		$this->load->model("model_feed");

		$user_id = $this->session->userdata('user_id');

		$products = $this->model_feed->get_my_products_paginated($user_id, $page_num, 12);
		
		$data = array();
		$i = 0;
		foreach ($products as $row) {
			$data['products'][$i]['row'] = $row;
			
			$i++;
		}
		
		echo json_encode($data);
	}
}