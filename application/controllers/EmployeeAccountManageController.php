<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeAccountManageController extends CI_Controller {

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
    public function index()
	{
		$sessionData = $this->session->userdata('username');
		if($sessionData != ''){
			$data = array(
				'username' => $sessionData,
				'adminId' => $this->session->userdata('adminId')

			);
			$this->load->view('template/DashBoardHead',$data);
			$this->load->view('EmployeeAccountManageView',$data);
		}
		else{
			redirect('Login');
		}
	}
	//load table
	public function fetch()
	{
		$this->load->model('EmployeeAccountManageModel');
		$verify = $this->EmployeeAccountManageModel->fetch();
		if($verify == false){
			$data = array('response'=> "failed", 'message'=> "Failed to retrive records");
		}
		else{
			$data = array('response'=> "success", 'posts'=> $verify);
		}
		echo json_encode($data);
	}

	// load Forms Methods
	public function loadEditForm()
	{
		$id = $this->input->post('EmployeeId');
		$this->load->model('EmployeeAccountManageModel');
		$verify = $this->EmployeeAccountManageModel->loadEditForm($id);
		if($verify == false){
			$data = array('response'=> "failed",'message'=>"failed to get records");
		}
		else{
			$data = array('response'=> "success",'posts'=>$verify);
		}
		echo json_encode($data);
	}
	
	public function loadDeleteForm()
	{
		$id = $this->input->post('EmployeeId');
		$this->load->model('EmployeeAccountManageModel');
		$verify = $this->EmployeeAccountManageModel->loadDeleteForm($id);
		if($verify == false){
			$data = array('response'=> "failed",'message'=>"failed to get records");
		}
		else{
			$data = array('response'=> "success",'posts'=>$verify);
		}
		echo json_encode($data);
	}

	//CrudOperations
	public function addAccount()
	{
		$this->load->database();
		$this->form_validation->set_rules('EmployeeId', 'EmployeeId', 'trim|required|numeric|max_length[50]|is_unique[employeelogin.EmployeeId]',
		array(
			'is_unique'=> "",
		));

		$this->form_validation->set_rules('EmployeeNumber', 'EmployeeNumber', 'trim|required|alpha_dash|min_length[2]|max_length[50]|is_unique[employeelogin.EmployeeNumber]',
		array(
			'is_unique'=> "This employee already has an account",
		));
		$this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[6]|max_length[50]');

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$EmployeeId = 	$this->input->post('EmployeeId');
			$EmployeeNumber = $this->input->post('EmployeeNumber');
			$Password = $this->input->post('Password');
			$Password = password_hash($Password,PASSWORD_DEFAULT);
			$ajax_data = array(
				'EmployeeId' => $EmployeeId,
				'EmployeeNumber' =>$EmployeeNumber,
				'Password'=>$Password
			);
			$this->load->model('EmployeeAccountManageModel');
			$verify = $this->EmployeeAccountManageModel->addAccount($ajax_data);
			if($verify == false){
				$data = array('response'=> "failed", 'message'=>"There was an error inserting data");
			}
			else{
				$data = array('response' => "success",'message'=>"Employee Added Successfully");
			}
		}
		echo json_encode($data);
	}

	public function updateAccount()
	{
		$this->load->database();
		$this->form_validation->set_rules('EmployeeId', 'EmployeeId', 'trim|required|numeric|max_length[50]');
		$this->form_validation->set_rules('Password', 'Password', 'trim|required|alpha_numeric|min_length[6]|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$Password = $this->input->post('Password');
			$Password = password_hash($Password,PASSWORD_DEFAULT);
			$ajax_data = array(
				'id' => $this->input->post('EmployeeId'),
				'Password' => $Password,
			);
			$this->load->model('EmployeeAccountManageModel');
			$verify = $this->EmployeeAccountManageModel->updateAccount($ajax_data);
			if($verify == false){
				$data = array('response'=>"failed",'message'=>"Failed to update");
			}
			else{
				$data = array('response'=>"success",'message'=>"Successfully updated employee account");
			}
		}
		echo json_encode($data);
	}
	public function deleteAccount()
	{
		$this->form_validation->set_rules('EmployeeId', 'EmployeeId', 'trim|required|numeric|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$ajax_data = array(
				'id' => $this->input->post('EmployeeId'),
			);
			$this->load->model('EmployeeAccountManageModel');
			$verify = $this->EmployeeAccountManageModel->deleteRecord($ajax_data);
			if($verify == false){
				$data = array('response'=>"failed",'message'=>"Failed to Delete Account");
			}
			else{
				$data = array('response'=>"success",'message'=>"Successfully Deleted Account");
			}
		}
		echo json_encode($data);
	}

	// search
	public function search()
	{
		$this->load->model('EmployeeAccountManageModel');
		$verify = $this->EmployeeAccountManageModel->search();
		$data = array('posts'=>$verify);
		echo json_encode($data);
	}


	//Button Methods

	

	// Custom Verification Methods



}