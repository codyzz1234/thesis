<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EsideAttendControl extends CI_Controller {
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
			$this->load->view('EmployeeSide/EsideAttendView',$data);
		}
		else{
			redirect('EmployeeSide/EsideLogin');
		}
	}

	public function fetch()
	{
		$EmployeeId = $this->input->post('EmployeeId');
		$EmployeeNumber = $this->input->post('EmployeeNumber');
		$this->load->model('EmployeeSide/EAttendModel');
		$verify = $this->EAttendModel->fetch($EmployeeId,$EmployeeNumber);
		if($verify == "error"){
			$data = array('response'=>"failed",'message'=>"Failed to retrieve records, connection error");
		}
		else if($verify == "none"){
			$data = array('response'=>"none",'message'=>"You have no attendance records");
		}
		else{
			$data = array('response'=>"success",'posts'=>$verify);
		}
		echo json_encode($data);
	}
}