<?php
class User_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function register_user(){
		#fix name capitalization for the lousy chaps :) - OCD
		$first_name = ucfirst(strtolower($this->input->post("first_name")));
		$last_name = ucfirst(strtolower($this->input->post("last_name")));

		$user = array(
			"first_name" => $first_name,
			"last_name" => $last_name,
			"email" => $this->input->post("email"),
			"password"=> md5(md5($this->input->post("password"))) #my crude sec hack
			);

		return $this->db->insert("user",$user);
	}

	function get_user($arg,$array=FALSE){
		if($arg > 0){
			#mid
			$this->db->where("uid",$arg);
		}else{
			#email assumed
			$this->db->where("email",$arg);
		}
		$result = $this->db->get("user");
		if($result->num_rows > 0){
			if($array){
				$result = $result->result_array();
			}else{
				$result = $result->result();
			}
			return $result[0];
		}
		return FALSE;
	}

	function user_login($email,$password){
		$this->db->where(
			array(
				"email"=>$email,
				"password"=>md5(md5($password))
				)
			);
		$result = $this->db->get("user");
		if($result->num_rows > 0){
			$result = $result->result_array();
			return $result[0];
		}
		return FALSE;
	}

	function get_user_count(){
		$result = $this->db->get("member");
		return $result->num_rows();
	}
}