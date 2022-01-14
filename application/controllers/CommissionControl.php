<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommissionControl extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URLP
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
			);
			$this->load->view('template/DashBoardHead',$data);
			$this->load->view('CommissionView',$data);
		}
		else{
			redirect('Login');
		}
	}
	
	public function logOut()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
    public function fetchSearches()
	{
		$this->load->model('CommissionModel');
		$results = $this->CommissionModel->loadSearches();
		echo json_encode($results);
	}

	//add Record
	public function addRecord()
	{
		$this->form_validation->set_rules('EmployeeId','Employee','trim|numeric|required',
		array(
			'numeric' => "Please Select an Employee",
			'required' => "Please Select an Employee",
		));
		$this->form_validation->set_rules('DatePicker','Date Field','trim|required|callback_checkDate',
		array(
			'checkDate'=> "input a valid date",
		));
		$this->form_validation->set_rules('Amount','Amount Field','trim|required|numeric');

		if($this->form_validation->run() == false){
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$date = $this->input->post('DatePicker');
			$date = date('Y-m-d',strtotime($date));
		

			$ajax_data = array(
				'EmployeeId' => $this->input->post('EmployeeId'),
				'Date' => $date,
				'Amount' => $this->input->post('Amount'),
				'Description' =>$this->input->post('Description')
			);
			$this->load->model('CommissionModel');
			$verify = $this->CommissionModel->addRecord($ajax_data);
			if($verify === true){
				$data = array('response' => 'success', 'message' => "Commission added successfully");
			}
			else if($verify === false){
				$data = array('response' => 'failed', 'message' => "There was an error inserting data");
			}
		}
		echo json_encode($data);
	}

	public function fetch()
	{
		$startDate = $this->input->post('StartDate');
		$endDate =  $this->input->post('EndDate');
		$this->load->model('CommissionModel');
		$verify = $this->CommissionModel->fetch($startDate,$endDate);
		if($verify === "none"){
			$data = array('response' => "none" , 'message' => "no records found");
		}
		else if($verify === false){
			$data = array('response' => "failed" , 'message' => "no records found");

		}
		else{
			$data = array('response' => "success" , 'posts' => $verify);

		}
		echo json_encode($data);
	}

	public function checkDate()
	{
		$date = $this->input->post('DatePicker');
		$date = date('Y-m-d',strtotime($date));
		$checkdate = $this->validateDate($date);
		if($checkdate == false){
			return false;
		}
		else{
			return true;
		}
		
	}
	private function validateDate($date,$format = 'Y-m-d')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	


}
