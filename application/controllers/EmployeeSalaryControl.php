<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeSalaryControl extends CI_Controller {

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
			);
			$this->load->view('template/DashBoardHead',$data);
			$this->load->view('EmpSalView',$data);
		}
		else{
			redirect('Login');
		}

	}
	
	public function fetch()
	{
		$this->load->model('EmpSalModel');
		$verify = $this->EmpSalModel->fetch();
		if($verify == false){
			$data = array('response'=>'failed','message'=> 'An error has occured,failed to retrieve data');
		}
		else if($verify == "none"){
			$data = array('response'=>'none','message'=> 'There are no records to be retrieved');
		}
		else{
			$data = array('response'=>'success','posts'=>$verify);
		}
		echo json_encode($data);
	}

	public function editSalary()
	{
		$this->load->database();

		$this->form_validation->set_rules('EmployeeId', 'Employee Id Field', 'trim|required|numeric');

		$this->form_validation->set_rules('FirstName', 'FirstName Field', 'required');


		$this->form_validation->set_rules('LastName', 'LastName Field', 'required');



		$this->form_validation->set_rules('BaseSalary', 'Base Salary Field', 'trim|required|numeric');



		$this->form_validation->set_rules('PagIbig', 'PagIbig Field', 'trim|required|numeric');



		$this->form_validation->set_rules('SSS', 'SSS Field', 'trim|required|numeric');



		$this->form_validation->set_rules('PhilHealth', 'PhilHealth Field', 'trim|required|numeric');



		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$this->load->model('EmpSalModel');
			$ajax_data = array(
				'EmployeeId' => $this->input->post('EmployeeId'),
				'BaseSalary' => $this->input->post('BaseSalary'),
				'PagIbig' => $this->input->post('PagIbig'),
				'SSS' => $this->input->post('SSS'),
				'PhilHealth' => $this->input->post('PhilHealth'),
			);
			var_dump($ajax_data);
			$verify = $this->EmpSalModel->editRecord($ajax_data);


			if($verify == false){
				$data = array('response'=>'failed','message'=> 'An error has occured,failed to retrieve data');
			}
			else if($verify == "none"){
				$data = array('response'=>'none','message'=> 'There are no records to be retrieved');
			}
			else{
				$data = array('response'=>'success','posts'=>$verify);
			}

		} 
		echo json_encode($data);
	}
}