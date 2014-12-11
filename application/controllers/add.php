<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ob_start();

class Add extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('model_add');
	}

	public function add_validation(){

		/*if (isset($_POST["add_submit"])) {
			$this->insert_url();
		}else{  
			echo "N0, add_submit is not set";
		}*/

		$this->load->library('form_validation');	
		$this->form_validation->set_rules('add', 'Add', 'required|trim|callback_insert_url');

		if ($this->form_validation->run()){
			echo "The form validation ran";
			//redirect('main/members');
		}else{
			echo "The form validation didn't ran";
			//redirect('main/members');
		}
	}

	public function insert_url(){

		if($this->model_add->get_url()){
			if($this->model_add->unique_url()){
				if($this->model_add->add_url()){
					if($this->model_add->post_user()){
						echo "The post was inserted to posts and posts_users";
					}else{
						echo "The post was inserted to posts but not posts_users";
					}
				}else{
					echo "The post wasn't inserted to posts";
				}
			}else{
				echo "We got the url but it's not unique";
				if($this->model_add->post_user()){
					if($this->model_add->update()){
						echo "Created_at was updated";
					}else{
						echo "Couldn't update created_at";
					}
					echo "The post wasn't unique but it was inserted to posts_users";
				}else{
					echo "The post wasn't unique but it was NOT inserted to posts_users";
				}
			}
		}else{
			echo "We didn't get the url info";
		}
	}

	public function delete($id){

		if($this->model_add->delete($id)){
			echo "The post was deleted";
			redirect('main/members');
		}else{
			echo "The post wasn't deleted";
		}
	}
}