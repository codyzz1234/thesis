<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DeductionControl extends CI_Controller {

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
			$this->load->view('DeductionView',$data);
		}
		else{
			redirect('Login');
		}
	}

	public function fetch()
	{
		$this->load->model('DeductionModel');
		$verify = $this->DeductionModel->fetch();
		if($verify == "none"){
			$data = array('response'=> "none",'message'=>$verify );

		}
		else if($verify == "failed"){
			$data = array('response'=> "failed",'message'=>"Failed to retrieve data");
		}
		else{
			$data = array('response'=> "success",'posts'=>$verify);
		}
		echo json_encode($data);
	}
	//Add Records
	public function addRecord()
	{
		$this->form_validation->set_rules('Deduction','Deduction Name Field','trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
		$this->form_validation->set_rules('Description','Description Field','trim|required|min_length[3]|max_length[50]|alpha_numeric_spaces');
		$this->form_validation->set_rules('Amount','Amount Field','required|trim|numeric|min_length[1]|max_length[15]');

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$ajax_data = array(
				'Deduction'=> $this->input->post('Deduction'),
				'Description' => $this->input->post('Description'),
				'Amount' => $this->input->post('Amount')
			);
			$this->load->model('DeductionModel');
			$verify = $this->DeductionModel->addRecord($ajax_data);
			if($verify == false){
				$data = array('response' => 'failed', 'message' => "Failed To Add Record");
			}
			else{
				$data = array('response' => 'success', 'message' => "Successfully Added Record");
			}
		}
		echo json_encode($data);
	}

	//edit Record

	public function editRecord()
	{
		$this->form_validation->set_rules('DeductionId','Deduction Id Field','trim|required|min_length[1]|max_length[50]|integer');

		$this->form_validation->set_rules('Deduction','Deduction Name Field','trim|required|min_length[2]|max_length[50]|alpha_numeric_spaces');
		$this->form_validation->set_rules('Description','Description Field','trim|required|min_length[3]|max_length[50]|alpha_numeric_spaces');
		$this->form_validation->set_rules('Amount','Amount Field','required|trim|numeric|min_length[1]|max_length[15]');			

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$deductionId = $this->input->post('DeductionId');
			$ajax_data = array(
				'Deduction' => $this->input->post('Deduction'),
				'Description' => $this->input->post('Description'),
				'Amount' => $this->input->post('Amount'),
			);
			$this->load->model('DeductionModel');
			$verify = $this->DeductionModel->editRecord($ajax_data,$deductionId);		
			if($verify == "none"){
				$data = array('response' => 'none', 'message' => "No Changes Made");

			}
			else if($verify == "failed"){
				$data = array('response' => 'failed', 'message' => "Failed To Edit Record");

			}
			else{
				$data = array('response' => 'success', 'message' => "Successfully Edited Record");
			}
		}
		echo json_encode($data);
	}
	


}
