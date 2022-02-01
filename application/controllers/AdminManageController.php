<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminManageController extends CI_Controller {

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
	 */
	public function __construct()
	{
		parent:: __construct();
		$this->load->library('session');
	}
	// index, first function that will activate
	public function index()
	{
		$sessionData = $this->session->userdata('username');
		if($sessionData != ''){
			$data = array(
				'username' => $sessionData,
				'adminId' => $this->session->userdata('adminId')
			);
			$this->load->view('template/DashBoardHead',$data);
			$this->load->view('AdminManageView',$data);
		}
		else{
			redirect('Login');
		}
	}
	// logout
	public function logOut()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
	// load table
	public function loadAdmins()
	{
		$this->load->model('AdminManageModel');
		$verify = $this->AdminManageModel->loadTable();
		if($verify == false){
			$data = array('response'=>'failed','message'=> 'An error has occured,failed to retrieve data');
		}
		else{
			$data = array('response'=>'success','posts'=>$verify);
		}
		echo json_encode($data);
	}
	// Load Forms
	public function loadEditForm()
	{
		$id = $this->input->post('id');
		$this->load->model('AdminManageModel');
		$verify = $this->AdminManageModel->loadEditForm($id);
		if($verify == false){
			$data = array('response'=>'failed','message'=> 'An error has occured,failed to retrieve data');
		}
		else{
			$data = array('response'=>'success','posts'=>$verify);
		}
		echo json_encode($data);
	}

	public function loadDeleteForm()
	{
		$id = $this->input->post('id');
		$this->load->model('AdminManageModel');
		$verify = $this->AdminManageModel->loadDeleteForm($id);
		if($verify == false){
			$data = array('response'=>'failed','message'=> 'An error has occured,failed to retrieve data');
		}
		else{
			$data = array('response'=>'success','posts'=>$verify);
		}
		echo json_encode($data);
	}

	// update administrator
	public function updateAdmin()
	{
		$this->load->database();
		$this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|min_length[2]|max_length[50]');

		$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|min_length[2]|max_length[30]');

		$this->form_validation->set_rules('UserName', 'UserName', 'trim|required|min_length[2]|max_length[30]|callback_checkUserName',
	array(
		'checkUserName'=>'This username has already been taken',
	));

	$this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[6]|max_length[30]|callback_passCheck',array(
		'passCheck' => "The password should be at least 6 characters long. <br/>
						The password has at least one uppercase letter. <br/>
						The password has at least one lowercase letter. <br/>
						The password has at least one digit <br/>.
						The password has at least one special character. <br/>"
	));

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$password = $this->input->post('Password');
			$password = password_hash($password, PASSWORD_DEFAULT);
			$ajax_data = array(
				'Id' => $this->input->post('Id'),
				'FirstName' => $this->input->post('FirstName'),
				'LastName' => $this->input->post('LastName'),
				'UserName' => $this->input->post('UserName'),
				'Password' => $password,
			);
			$username = $this->session->userdata('username');
			$adminId = $this->session->userdata('adminId');

			$this->load->model('AdminManageModel');
			$verify = $this->AdminManageModel->updateAdmin($ajax_data,$adminId);
			if($verify['response'] == "success"){
				$data = array('response'=>"success",'message'=>'Data Updated');
			}
			else if ($verify['response'] == "failed" ){
				$data = array('response'=>"failed",'message'=>'Failed to update data');
			}
			else if($verify['response'] == "none" ){
				$data = array('response'=> "none",'message'=>'No data was changed');
			}
		}
		echo json_encode($data);
	}
	// verification functions
	public function checkUserName()
	{
		$id = $this->input->post('Id');
		$username = $this->input->post('UserName');
		$this->load->model('AdminManageModel');
		$verify = $this->AdminManageModel->checkUserName($id,$username);
		if($verify == false){
			return false;
		}
		else{
			return true;
		}
		
	}
   // Add Administrator
	public function addAdmin()
	{
		$this->load->database();
		$this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|min_length[2]|max_length[50]');

		$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|min_length[2]|max_length[30]');

		$this->form_validation->set_rules('UserName', 'UserName', 'trim|required|alpha_dash|min_length[2]|max_length[30]|is_unique[adminlogin.Username]',
	array(
		'is_unique'=>'This username has already been taken, sad life this is'
	));
		$this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[6]|max_length[30]|callback_passCheck',array(
			'passCheck' => "The password should be at least 6 characters long. <br/>
							The password has at least one uppercase letter. <br/>
							The password has at least one lowercase letter. <br/>
							The password has at least one digit <br/>.
							The password has at least one special character. <br/>"
		));

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$password = $this->input->post('Password');
			$password = password_hash($password, PASSWORD_DEFAULT);
			$ajax_data = array(
				'UserName' => $this->input->post('UserName'),
				'Password' =>  $password,
				'FirstName' => $this->input->post('FirstName'),
				'LastName' => $this->input->post('LastName')
			);	
			$this->load->model('AdminManageModel');
			$verify = $this->AdminManageModel->addAdmin($ajax_data);
			if($verify == false ){
				$data = array('response'=>'failed','message'=>'There was an error in adding Administrator');
			}
			else{
				$data = array('response'=>'success','message'=>'Admin Successfully added');
			}
		}
		echo json_encode($data);
	}
	// delete administrator

	public function deleteAdmin()
	{
		$id = $this->input->post('id');
		$ajax_data = array(
			'id' =>  $this->input->post('id'),
			'UserName' => $this->input->post('username'),
		);

		$this->load->model('AdminManageModel');
		$verify = $this->AdminManageModel->deleteAdmin($ajax_data);
		if($verify == false){
			$data = array('response'=>'failed','message'=>'There was in deleting administrator');
		}
		else if($verify === "loggedIn"){
			$data = array('response'=>'failed','message'=>'You Are Currently Logged Ina');
		}
		else{
			$data = array('response'=>'success','message'=>'Administrator Deleted');
		}
		echo json_encode($data);
	}
	// Password Complexiy Check
	public function passCheck()
	{
		$password = $this->input->post('Password');

		if(!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,})/',$password)){
			return false;
		}
		else{
			return true;
		}
	
	}
}
