<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'core/MY_Crud.php');

class Model_feed extends MY_Crud {

	public function __construct(){

		$this->load->database();
	}

	public function get_posts(){

		$this->db->where('username', $this->session->userdata('username'));
		$query_users = $this->db->get('users');

		if($query_users){
			$row_users = $query_users->row();

			$data = array(
				'user_id' => $row_users->id,
				);
		}

		$this->session->set_userdata('user_id', $data['user_id']);

		$this->db->where('user_id', $data['user_id']);
		$this->db->order_by('id', 'desc');
		$this->db->limit(12);
		$query_posts_users = $this->db->get('posts_users');

		$posts_users_array = $query_posts_users->result_array();

		$posts = array();
		foreach ($posts_users_array as $row) {

			$this->db->where('id', $row['post_id']);
			$query_posts = $this->db->get('posts');
			$posts_array = $query_posts->result_array();
			array_push($posts, $posts_array);
		}

		return $posts;
	}

	function get_my_products_paginated($user_id, $offset, $limit)
    {

    	$sql   = sprintf('SELECT p.* 
						FROM posts_users pu
						JOIN users u ON pu.user_id = u.id
						JOIN posts p ON pu.post_id = p.id
						WHERE u.id = %d ORDER BY created_at DESC limit %d, %d', $user_id, $offset, $limit);
		
    	$query = $this->executeQuery($sql);
		return $query;
    }
}
