<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	private $data;

	function __construct(){
		parent::__construct();
		$this->load->model("user_model");
		$this->data['active'] = "home";

		//for now
		redirect("home");
	}

	private function is_logged_in(){
		return $this->session->userdata("is_logged_in");
	}

	private function _load_view(){
		$this->load->view("inc/temp",$this->data);
	}

	function index(){
		$this->data['main'] = 'user/index';
		$this->_load_view();
	}

	function profile(){

	}

	function logout(){
		$this->session->sess_destroy();
		redirect("home");
	}

}
