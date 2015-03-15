<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		$this->load->model("user_model");
		$this->data['active'] = "home";
	}

	private function is_logged_in(){
		return $this->session->userdata("is_logged_in");
	}

	private function _load_view(){
		$this->load->view("inc/temp",$this->data);
	}

	public function index()
	{
		$this->data['user_number'] = $this->user_model->get_user_count();
		$this->data['main'] = "home/index";
		$this->_load_view();
	}

	public function about(){
		$this->data['main'] = "home/about";
		$this->data['active'] = "about";
		$this->_load_view();
	}

	public function register($mode="form"){
		if($mode=="form"){
			$this->data['main'] = "home/register";
			$this->_load_view();
		}
		elseif($mode=="submit"){
			#process submitted form
			$this->load->library("form_validation");

			$rules = array(
					array(
						'field'=>'first_name',
						'label'=>'First Name',
						'rules'=>'required'
					),
					array(
						'field'=>'last_name',
						'label'=>'Last Name',
						'rules'=>'required'
					),
					array(
						'field'=>'email',
						'label'=>'Email',
						'rules'=>'required|valid_email|is_unique[user.email]'
					),
					array(
						'field'=>'password',
						'label'=>'Password',
						'rules'=>'required'
					),
					array(
						'field'=>'password_confirm',
						'label'=>'Confirm Password',
						'rules'=>'required|matches[password]'
					)
					);
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run()){
				if($this->user_model->register_user()){
					#email user, later will add verification code
					$this->load->model("email_model");

					$name = $this->input->post("first_name");
					$to_email = $this->input->post("email");

					$_msg['html'] = "<p>Hello {name},<br/>
Thank you for signing up for our service. You'll enjoy it :-)</p>
					";
					$_msg['subject'] = "Welcome to TweetDaily";

					$msg = $_msg['html'];
					$msg = str_replace("{name}", $name, $msg);
					$subject = $_msg['subject'];

					$this->email_model->send($to_email,$subject,$msg);

					#auto-login user
					$user = $this->user_model->get_user($this->input->post("email"),TRUE);
					$this->session->set_userdata($user);
					$this->session->set_userdata("is_logged_in",TRUE);

					redirect("user");
				}else{
					#almost impossible to get here?
				}
			}else{
				$this->register();
			}	
		}
		else{
			#404
			redirect("home/register");
		}
	}

	public function user($mode="login",$mode2="form"){
		if($mode == "login"){
			if($mode2=="form"){
				$this->data['main'] = "home/login";
				$this->_load_view();
			}
			if($mode2=="submit"){
				$this->load->library("form_validation");
				$rules = array(
					array(
						"field" => "email",
						"label" => "Email",
						"rules"=>"valid_email|required"
						),
					array(
						"field" => "password",
						"label" => "Password",
						"rules"=>"required"
						)
					);
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run()){
					$email = $this->input->post("email");
					$password = $this->input->post("password");
					$user = $this->user_model->user_login($email,$password);
					if(is_array($user)){
						$this->session->set_userdata($user);
						$this->session->set_userdata("is_logged_in",TRUE);

						redirect("user");
					}else{
						$this->session->set_flashdata("msg","Wrong Password/Email");
						redirect("home/user/login");
					}
				}else{
					$this->user("login");
				}
			}
		}

		if($mode=="logout"){
			$this->session->sess_destroy();
			redirect("home");
		}
	}
}