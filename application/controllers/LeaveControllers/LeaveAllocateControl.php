<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeaveAllocateControl extends CI_Controller {

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
			$this->load->view('LeaveViews/LeaveAllocateView',$data);
		}
		else{
			redirect('Login');
		}
	}

	//fetch Data for table
	public function fetch()
	{
		$this->load->model('LeaveModels/LeaveAllocateModel');
		$verify = $this->LeaveAllocateModel->fetch();
		if($verify == "failed"){
			$data = array('response' => 'failed', 'message' => "There was an error in establishing connection");
		}
		else if($verify == "none"){
			$data = array('response' => 'none', 'message' => "There are no records to retrieve");

		}
		else{
			$data = array('response' => 'success', 'posts' => $verify);

		}
		echo json_encode($data);
	}
	// Load Searches
	public function loadSearches()
	{
		$this->load->model('LeaveModels/LeaveAllocateModel');
		$verify = $this->LeaveAllocateModel->loadSearches();
		if($verify == "failed"){
			$data = array('response' => 'failed', 'message' => "There was an error in establishing connection");

		}
		else if($verify == "none"){
			$data = array('response' => 'none', 'message' => "No Records Retrieved");
		}
		else{
			$data = array('response' => 'success', 'posts' => $verify);

		}
		echo json_encode($data);
	}
	// Add Allocation
	public function addAllocate()
	{
		$this->form_validation->set_rules('Id','Id Field','required|integer|min_length[1]|max_length[50]|is_unique[leaveallocation.EmployeeId]',
		array(
			'is_unique'=> "This Employee Has Aleady been Allocated",
			'required'=> "Please Select An Employee",
		));
		$this->form_validation->set_rules('Allocate','Allocate Days Field','trim|required|integer|min_length[1]|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$ajax_data = array(
				'id' =>$this->input->post('Id'),
				'Allocate' =>$this->input->post('Allocate')
			);
			$this->load->model('LeaveModels/LeaveAllocateModel');
			$verify = $this->LeaveAllocateModel->addAllocate($ajax_data);
			if($verify == false){
				$data = array('response' => 'failed', 'message' => "Failed To Add allocation");
			}
			else{
				$data = array('response' => 'success', 'message' => "Successfully Added Allocation");
			}
		}
		echo json_encode($data);
	}

}