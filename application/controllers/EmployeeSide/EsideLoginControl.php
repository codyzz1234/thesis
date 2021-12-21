<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EsideLoginControl extends CI_Controller {

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
		$sessionData = $this->session->userdata('employeeNumber');
		if($sessionData != ''){
			redirect('EmployeeSide/EsideDashControl');
		}
		else{
			$this->load->view('EmployeeSide/EsideLoginView');
		}
	}

	public function login()
	{
		$this->load->database();
		$this->form_validation->set_rules('EmployeeNumber', 'EmployeeNumber','trim|required|min_length[2]|max_length[30]|callback_verifyEmployeeNumber',
		array(
		  'min_length'=>'username is too short',
		  'max_length'=>'username is too long, only a maximum of 30 characters',
		  'verifyEmployeeNumber'=>'Could not find this Employee Number',
		  ));

		$this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[6]|max_length[30]',
		  array(
			  'min_length'=>'Password should be a minimum of 6 characters',
			  'max_length'=> 'Password is too long, only a max of 30 characters allowed')); 

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$EmployeeNumber = $this->input->post('EmployeeNumber');
			$Password= $this->input->post('Password');
			$this->load->model('EmployeeSide/ELoginModel');
			$results = $this->ELoginModel->loginVerify($EmployeeNumber);
			foreach ($results->result() as $row){
					if(password_verify($Password, $row->Password)) {
						$EmployeeId = $row->EmployeeId;
						$EmployeeNumber = $row->EmployeeNumber;
						$scheduleId = $row->ScheduleId;
						$verify = $this->ELoginModel->updateTime($EmployeeId,$EmployeeNumber);
						if($verify == false){
							$data = array('response'=>"failed",'message'=>"Failed to log Log In Time");
						}
						else{
							$session_data = array(
								'employeeId' => $EmployeeId,
								'employeeNumber' => $EmployeeNumber,
								'scheduleId' => $scheduleId
							);
							$this->session->set_userdata($session_data);
							$data = array('response'=>"success",'message'=>"Logging you in...");
						}
					}
					else{
						$data = array('response'=>"failed",'message'=>"Incorrect Password");
					}
			}
		} 
		echo json_encode($data);
	}

	public function verifyEmployeeNumber()
	{
		$EmployeeNumber = $this->input->post('EmployeeNumber');
		$this->load->model('EmployeeSide/ELoginModel');
		$results = $this->ELoginModel->loginVerify($EmployeeNumber);
		if(count($results->result()) <= 0){
			return false;
		}
		else{
			return true;
		}
	}
}