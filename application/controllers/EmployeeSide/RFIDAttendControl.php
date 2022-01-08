<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RFIDAttendControl extends CI_Controller {

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
        $this->load->view('EmployeeSide/RFIDAttendView');

	}
	public function attendance()
	{
		$rfid = $this->input->post('RFID');
		$this->load->model('EmployeeSide/ERFIDAttendModel');
		$verify = $this->ERFIDAttendModel->attendance($rfid);
		if($verify == false){
			$data = array('response' => "failed",'message'=>"There was an error in connection");
		}
		else if($verify == "none"){
			$data = array('response' => "none",'message'=>"Employee RFID not found");
		}
		else{
			$employeeId = "";
			$employeeNumber = "";
			foreach ($verify as $row){
				$employeeId = $row->EmployeeId;
				$employeeNumber = $row->EmployeeNumber;
				$position = $row->Position;
				$timeIn = $row->TimeIn;
				$timeOut = $row->TimeOut;
			}
			$timeIn = date("H:i",strtotime($timeIn));
			$timeOut = date("H:i",strtotime($timeOut));
			
			$recordAttendance = $this->ERFIDAttendModel->timeInOut($employeeId,$employeeNumber,$timeIn,$timeOut);

			if($recordAttendance === false){
				$data = array('response' => "failed",'message'=>"Error Recording Attendance");
			}
			else if($recordAttendance === true){
				$data = array('response' => "success",'posts'=>$verify);
			}
			else if($recordAttendance == "out"){
				$data = array('response' => "out", 'message'=>"You are outside schedule");
			}
		}
		echo json_encode($data);
	}
	
}
