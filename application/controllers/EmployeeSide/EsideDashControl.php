<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EsideDashControl extends CI_Controller {
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
		$employeeNumber = $this->session->userdata('employeeNumber');
		$employeeId =  $this->session->userdata('employeeId');
		$scheduleId = $this->session->userdata('scheduleId');
		if($employeeNumber != ''){
			$data = array(
				'employeeNumber' => $employeeNumber,
				'employeeId' => $employeeId,
				'scheduleId' => $scheduleId
			);
			$this->load->view('template/EDashBoardHead',$data);
			$this->load->view('EmployeeSide/EsideDashView',$data);
		}
		else{
			redirect('EmployeeSide');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('EmployeeSide');
	}
	public function timeInOut()
	{
		$EmployeeId = $this->input->post('EmployeeId');
		$EmployeeNumber = $this->input->post('EmployeeNumber');
		$ScheduleId = $this->input->post('ScheduleId');
		$this->load->model('EmployeeSide/EDashModel');
		$verify = $this->EDashModel->timeInOut($EmployeeId,$EmployeeNumber);
		if($verify == false){
			$data = array('response'=>"failed",'message' => $verify);
		}
		else if($verify == "In"){
			$data = array('response'=>"success",'message' => "Time In");
		}
		else if($verify == "Out"){
			$data = array('response'=>"success",'message' => "Time Out");
		}
		echo json_encode($data);
	}

}