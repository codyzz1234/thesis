<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * 
	 * 
	 */
	public function __construct()
	{
		parent:: __construct();
		$this->load->library('session');
	}
	public function index()
	{
		$sessionData = $this->session->userdata('username');
		if($sessionData != ''){
			redirect('DashBoard');
		}
		else{
			$this->load->view('LoginView');
		}
	}
	public function login()
	{
		$this->load->database();
		$this->form_validation->set_rules('username', 'username','trim|required|min_length[2]|max_length[30]|callback_verifyUsername',
	  	array(
			'min_length'=>'username is too short',
		  	'max_length'=>'username is too long, only a maximum of 30 characters',
			'verifyUsername'=>'Could not find this username',
			));

		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[30]',
		array(
			'min_length'=>'password is to short',
			'max_length'=> 'Password is too long, only a max of 30 characters allowed'));

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		} 
		else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('LoginModel');
			$result = $this->LoginModel->loginVerify($username);
			foreach ($result->result() as $row){
						if(password_verify($password, $row->Password)) {
							$session_data = array(
								'username' => $username,
							);
							$this->LoginModel->loginUpdate($username);
							$this->session->set_userdata($session_data);
							$data = array('response' => 'success', 'message' => 'Logging In..');
						}
						else{
							$data = array('response' => 'failed', 'message' => 'Wrong Password');
						}
				}
		}
		echo json_encode($data);
	}

	public function verifyUsername()
	{
		$username = $this->input->post('username');
		$this->load->model('LoginModel');
		$results = $this->LoginModel->loginVerify($username);
		if(count($results->result()) <= 0){
			return false;
		}
		else{
			return true;
		}
	}
}
