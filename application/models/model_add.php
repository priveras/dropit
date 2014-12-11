<?php

class Model_add extends CI_Model{

	public function get_url(){

		$url = $this->input->post('add');

		if(isset($url)) {

		//Check if its a valid URL
			if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
				die('Not a valid URL');
			}else{
				function file_get_contents_curl($url){
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

					$data = curl_exec($ch);
					curl_close($ch);
					
				}

				$html = file_get_contents_curl($url);

				//parsing begins here:
				$doc = new DOMDocument();
				@$doc->loadHTML($html);
				$nodes = $doc->getElementsByTagName('title');

				//get and display what you need:
				$title = $nodes->item(0)->nodeValue;
				$metas = $doc->getElementsByTagName('meta');

				for ($i = 0; $i < $metas->length; $i++){
					$meta = $metas->item($i);
					if($meta->getAttribute('name') == 'description')
						$description = $meta->getAttribute('content');
					if($meta->getAttribute('name') == 'keywords')
						$keywords = $meta->getAttribute('content');
					if($meta->getAttribute('name') == 'twitter:image')
						$twitter_image = $meta->getAttribute('content');
					if($meta->getAttribute('name') == 'twitter:image:src')
						$twitter_image_src = $meta->getAttribute('content');
					if($meta->getAttribute('property') == 'og:site_name')
						$site_name = $meta->getAttribute('content');
					if($meta->getAttribute('name') == 'twitter:creator')
						$twitter_creator = $meta->getAttribute('content');
					if($meta->getAttribute('name') == 'twitter:site')
						$twitter_site = $meta->getAttribute('value');
					if($meta->getAttribute('name') == 'twitter:title')
						$twitter_title = $meta->getAttribute('content');
					if($meta->getAttribute('property') == 'og:title')
						$title_property = $meta->getAttribute('content');
					if($meta->getAttribute('property') == 'og:image')
						$image_property = $meta->getAttribute('content');
					if($meta->getAttribute('property') == 'og:description')
						$description_property = $meta->getAttribute('content');
				}

				if(empty($twitter_image)){
					$image = $twitter_image_src;
					if(empty($twitter_image_src)){
						if(empty($image_property)){
							$image = "http://www.mexicode.com.mx/images/image" . rand(1,6) . ".png";
						}else{
							$image = $image_property;
						}                
					}else{
						$image = $twitter_image_src;
					}
				}else{
					$image = $twitter_image;
				}

				if(empty($description)){
					$description = $description_property;
				}

				if(empty($site_name)){
					if(empty($twitter_creator)){
						if(empty($twitter_title)){
							if(empty($twitter_site)){
								$site_name = "Dropit";
							}else{
								$site_name = $twitter_site;
							}
						}else{
							$site_name = $twitter_title;
						}
					}else{
						$site_name = $twitter_creator;
					}
				}

				//$title = str_replace("'", "", $title);
				$title = substr($title,0,110);
				//$description = str_replace("'", "", $description);

				date_default_timezone_set('EST');
				$created_at = date('m/d/y H:i:s');

				$favicon = "http://www.google.com/s2/favicons?domain=" . $url;

				$data = array(
					'url' => $url,
					'title' => $title,
					'description' => $description,
					'keywords' => $keywords,
					'image' => $image,
					'site_name' => $site_name,
					'favicon' => $favicon,
					'created_at' => $created_at,
					'rank' => 1,
					'is_logged_in' => 1
					);

				$this->load->library('session');
				$this->session->set_userdata($data);

				return true;
			}
		}
	}

	public function unique_url(){

		$this->db->where('url', $this->input->post('add'));
		$query = $this->db->get('posts');

		if($query->num_rows == 1){
			return false;
		}else{
			return true;
		}
	}

	public function add_url(){
		
		$data = array(
			'url' => $this->session->userdata('url'),
			'title' => $this->session->userdata('title'),
			'description' => $this->session->userdata('description'),
			'keywords' => $this->session->userdata('keywords'),
			'image' => $this->session->userdata('image'),
			'site_name' => $this->session->userdata('site_name'),
			'favicon' => $this->session->userdata('favicon'),
			'created_at' => $this->session->userdata('created_at'),
			'rank' => $this->session->userdata('rank')
			);

		$query = $this->db->insert('posts', $data);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function post_user(){

		$this->db->where('username', $this->session->userdata('username'));
		$query_user = $this->db->get('users');

		$this->db->where('url', $this->input->post('add'));
		$query_post = $this->db->get('posts');


		if($query_user && $query_post){
			$row_user = $query_user->row();
			$row_post = $query_post->row();

			$data = array(
				'user_id' => $row_user->id,
				'post_id' => $row_post->id
				);
		}

		$add_posts_users = $this->db->insert('posts_users', $data);

		if($add_posts_users){
			return true;
		}else{
			return false;
		}
	}

	public function update(){

		date_default_timezone_set('EST');
		$created_at = date('m/d/y H:i:s');

		$data = array(
			'created_at' =>  $created_at
			);

		$this->db->where('url', $this->input->post('add'));
		$this->db->set('rank', 'rank+1', FALSE);
		$update = $this->db->update('posts', $data); 

		if($update){
			return true;
		}else{
			return false;
		}
	}

	public function delete($id){

		$user_id = $this->session->userdata('user_id');

		$this->db->where('user_id', $user_id);
		$this->db->where('post_id', $id);
		$delete = $this->db->delete('posts_users'); 

		if($delete){
			return true;
		}else{
			return false;
		}
	}

	public function tutorial(){

		$this->db->where('email', $this->session->userdata('email'));
		$query_user = $this->db->get('users');

		if($query_user){
			$row_user = $query_user->row();

			$data = array(
				'user_id' => $row_user->id,
				);
		}

		$user_id = $data['user_id'];

		$data = array(
			'user_id' => $user_id,
			'post_id' => 1
			);

		$add_tutorial = $this->db->insert('posts_users', $data);

		if($add_tutorial){
			return true;
		}else{
			return false;
		}

	}
}