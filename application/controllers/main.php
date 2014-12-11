<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index(){
		$this->login();
	}

	public function login(){
		$this->load->view('login');
	}

	public function signup(){
		$this->load->view('signup');
	}

	public function email_sent(){
		$this->load->view('email_sent');
	}

	public function login_confirmed(){
		$this->load->view('login_confirmed');
	}

	public function members(){
		if($this->session->userdata('is_logged_in')){

			$this->load->model('model_feed');

			$data = [];
			$data['posts'] = $this->model_feed->get_posts();

			$this->load->view('header');
			$this->load->view('body', $data);
			$this->load->view('footer');
		}else{
			redirect('main/restricted');
		}
	}

	public function restricted(){
		$this->load->view('restricted');
	}

	public function login_validation(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim');

		if ($this->form_validation->run()){

			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => 1
				);

			$this->session->set_userdata($data);
			redirect('main/members');
		}else{
			$this->load->view('login');
		}
	}

	public function signup_validation(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]|is_unique[temp_users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]|is_unique[temp_users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

		$this->form_validation->set_message('is_unique', 'That %s address already exists.');

		if($this->form_validation->run()){

			//generate a random key
			$key = md5(uniqid());

			$this->load->library('email', array('mailtype' => 'html'));
			$this->load->model('model_users');

			$this->email->from('verify@mydropit.com', "Dropit");
			$this->email->to($this->input->post('email'));
			$this->email->subject("Confirm your account");

			$message = "<p>Thank you for signing up, you are just one step away to start using Dropit!</p>";
			$message .= "<p><a href='" . base_url() . "main/register_user/$key '>Click here</a> to confirm your account</p>";

			$this->email->message($message);

			//send and email to the user
			if($this->model_users->add_temp_user($key)){
				if($this->email->send()){
					redirect('main/email_sent');
				}else{
					echo "Could not send email";
				}
			}else{
				echo "Problem adding to database.";
			}

			//add them to the temp_user db


		}else{
			$this->load->view('signup');
		}
	}

	public function validate_credentials(){
		$this->load->model('model_users');

		if($this->model_users->can_log_in()){
			return true;
		}else{
			$this->form_validation->set_message('validate_credentials', 'Incorrect username/password.');
			return false;
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('main/login');
	}

	public function register_user($key){
		$this->load->model('model_users');

		if($this->model_users->is_key_valid($key)){
			if($newemail = $this->model_users->add_user($key)){

				$data = array(
					'email' => $newemail,
					'is_logged_in' => 1
					);

				$this->session->set_userdata($data);

				$this->load->model('model_add');
				if($this->model_add->tutorial()){
					redirect('main/login_confirmed');
					echo "<h1>Your account has been confirmed</h1>";
				}else{
					echo "Failed to add welcome message";
				}
			}else{
				echo "Failed to add user, please try again.";
			}
		}else{
			echo "invalid key";
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */