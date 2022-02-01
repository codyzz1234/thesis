<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduleControl extends CI_Controller {

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
			$this->load->view('ScheduleView',$data);
		}
		else{
			redirect('Login');
		}
	}

	public function fetch()
	{
		$this->load->model('ScheduleModel');
		$verify = $this->ScheduleModel->fetch();
		if($verify == "none"){
			$data = array('response'=>"none",'message'=>"No records found");
		}
		else if($verify == "failed"){
			$data = array('response'=>"failed",'message'=>"There was a connection error");
		}
		else{
			$data = array('response'=>"success",'posts'=>$verify);
		}
		echo json_encode($data);
	}

	public function addSchedule()
	{
		$this->form_validation->set_rules('TimeIn','Time In Field','required|callback_checkTimeIn',
		array(
			'checkTimeIn' => "Please Input a Valid Time In Format<br />
							  12 Hour Format: 9:00 AM/9:00 PM
							  24 Hour Format: 06:30/23:00"
		));
		$this->form_validation->set_rules('TimeOut','TimeOut Field','required|callback_checkTimeOut',
		array(
			'checkTimeOut' => "Please Input a Valid Time Out Format<br />
							   12 Hour Format: 9:00 AM/9:00 PM
							   24 Hour Format: 06:30/23:00"
		));
		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$timeIn = $this->input->post('TimeIn');
			$timeOut = $this->input->post('TimeOut');

			$timeIn = date("H:i",strtotime($timeIn));
			$timeOut = date("H:i",strtotime($timeOut));
			
			$ajax_data = array(
				'TimeIn' => $timeIn,
				'TimeOut' => $timeOut,
			);
			$this->load->model('ScheduleModel');
			$verify = $this->ScheduleModel->addSchedule($ajax_data);
			if($verify == false){
				$data = array('response' => 'failed', 'message' => "There was error adding the Schedule");
			}
			else{
				$data = array('response' => 'success', 'message' => "Schedule Added Successfully");
			}
		}
		echo json_encode($data);
	}

	public function checkTimeIn()
	{
		$time = $this->input->post('TimeIn');
		$dateObj = DateTime::createFromFormat('H:i A',$time);   
		$dateObj2 = DateTime::createFromFormat('H:i',$time);
		$dateObj3 = DateTime::createFromFormat('H:i:s',$time);
		if ($dateObj == false && $dateObj2 == false && $dateObj3 == false) { 
			return false;
		}
		else{
			return true;
		}
	}

	public function checkTimeOut()
	{
		$time = $this->input->post('TimeOut');
		$dateObj = DateTime::createFromFormat('H:i A',$time);   
		$dateObj2 = DateTime::createFromFormat('H:i',$time);
		$dateObj3 = DateTime::createFromFormat('H:i:s',$time);
		if ($dateObj == false && $dateObj2 == false && $dateObj3 == false) { 
			return false;
		}
		else{
			return true;
		}
	}

	//edit schedule
	public function editSchedule()
	{
		$this->form_validation->set_rules('ScheduleId','Schedule Id Fied','required|numeric|min_length[1]');
		$this->form_validation->set_rules('TimeIn','TimeIn Field','required|callback_checkTimeIn',
		array(
			'checkTimeIn' => "Please Input a Valid Time In Format<br />
							  12 Hour Format: 9:00 AM/9:00 PM
							  24 Hour Format: 06:30/23:00"
		));
		$this->form_validation->set_rules('TimeOut','TimeOut Field','required|callback_checkTimeOut',
		array(
			'checkTimeOut' => "Please Input a Valid Time Out Format<br />
							   12 Hour Format: 9:00 AM/9:00 PM
							   24 Hour Format: 06:30/23:00"
		));

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		
		else{
			$schedId = $this->input->post('ScheduleId');
			$timeIn = $this->input->post('TimeIn');
			$timeOut = $this->input->post('TimeOut');


			
			$timeIn = date("H:i",strtotime($timeIn));
			$timeOut = date("H:i",strtotime($timeOut));


			
			$ajax_data = array(
				'TimeIn' => $timeIn,
				'TimeOut' => $timeOut,
			);
			$this->load->model('ScheduleModel');
			$verify = $this->ScheduleModel->editSchedule($ajax_data,$schedId);
			if($verify == false){
				$data = array('response' => 'failed', 'message' => "There was error adding the Schedule");
			}
			else if($verify == "none"){
				$data = array('response' => 'none', 'message' => "No Changes Were Made");
			}
			else{
				$data = array('response' => 'success', 'message' => "Schedule Edited Successfully");
			}
		}
		echo json_encode($data);
	}

	//delete schedule
	public function deleteRecord()
	{
		$scheduleId = $this->input->post('ScheduleId');
		$ajax_data = array(
			'ScheduleId' => $this->input->post('ScheduleId')
		);
		$this->load->model('ScheduleModel');
		$verify = $this->ScheduleModel->deleteSchedule($ajax_data);
		if($verify == false){
			$data = array('response' => 'failed', 'message' => "Failed To delete Position");
		}
		else{
			$data = array('response' => 'success', 'message' => "Successfully Deleted Position");

		}
		echo json_encode($data);
	}


}
