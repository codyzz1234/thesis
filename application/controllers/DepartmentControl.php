<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepartmentControl extends CI_Controller {

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
			$this->load->view('DepartmentView',$data);
		}
		else{
			redirect('Login');
		}
	}
	// fetch Records
    public function fetch()
    {
        $this->load->model('DepartmentModel');
        $verify = $this->DepartmentModel->fetch();
		if($verify == "none"){
			$data = array('response'=>"none",'message'=> "No records Found");
		}
		else if($verify == "failed"){
			$data = array('response'=>"failed",'message'=> "An Error has occurred, failed to retrieve records");
		}
		else{
			$data = array('response'=>"success",'posts'=>$verify);
		}
		echo json_encode($data);
    }

	//Add New Department
	public function addDepartment()
	{
		$this->load->database();
		$this->form_validation->set_rules('DepartmentName', 'Department Name','required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('Description', 'Description','required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('Head', 'Head','trim|numeric|max_length[50]|callback_checkHead',
		array(
			'checkHead'=>"This Employee Does not exist",
		));

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$this->load->model('DepartmentModel');
			$ajax_data = array(
				'Department' => $this->input->post('DepartmentName'),
				'Description' => $this->input->post('Description'),
				'DepartmentHead' => $this->input->post('Head'),
			);
			$verify = $this->DepartmentModel->addDepartment($ajax_data);
			if($verify == true){
				$data = array('response' => 'success', 'message' => "Department Added Successfully");
			}
			else{
				$data = array('response' => 'failed', 'message' => validation_errors());
			}
		}
		echo json_encode($data); 
	}




	//loadSearches
	public function loadSearches()
	{
		$this->load->model('DepartmentModel');
		$verify = $this->DepartmentModel->loadSearches();
		if($verify == false){
			$data = array('response'=>"failed",'message'=>"An Error occured, unable to search for employees at the moment");

		}
		else{
			$data = array('response'=>"success",'posts'=>$verify);
		}
		echo json_encode($data);
	}

	//loadEditForm
	public function loadEditForm()
	{
		$id = $this->input->post('Id');
		$this->load->model('DepartmentModel');
		$verify = $this->DepartmentModel->loadEditForm($id);
		if($verify == false){
			$data = array('response'=>"failed",'message'=>"Failed To Load Form");
		}
		else{
			$data = array('response'=>"success",'posts'=>$verify);
		}
		echo json_encode($data);
	}

	//Update Recorsd
	public function updateRecord()
	{
		$this->form_validation->set_rules('DepartmentId', 'Department Id','trim|required|numeric|callback_checkDeptId',
		array(
			'checkDeptId' => "An Attempt to insert an incorrect department Id has been detected",
		));

		$this->form_validation->set_rules('Head', 'Head','trim|numeric|max_length[50]|callback_checkHead',
		array(
			'checkHead'=>"This Employee Does not exist",
		));

		$this->form_validation->set_rules('Description', 'Description Field','required|min_length[3]|max_length[50]');

		$this->form_validation->set_rules('DepartmentName', 'DepartmentName Field','required|min_length[3]|max_length[50]');

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$ajax_data = array(
				'DepartmentId' => $this->input->post('DepartmentId'),
				'Department'=> $this->input->post('DepartmentName'),
				'Description' =>  $this->input->post('Description'),
				'DepartmentHead'=> $this->input->post('Head'),
			);

			$this->load->model('DepartmentModel');
			$verify = $this->DepartmentModel->editRecords($ajax_data);
			if($verify == "none"){
				$data = array('response' => 'none', 'message' =>"NO changes were made");
			}
			else if($verify == "failed"){
				$data = array('response' => 'failed', 'message' =>"An error has occured, Failed to update data");
			}
			else{
				$data = array('response' => 'success', 'message' => "Successfully updated department");
			}
			
		}
		echo json_encode($data);
	}
	// delete department
	public function deleteRecord()
	{
		$departmentId = $this->input->post('DepartmentId');
		$this->load->model('DepartmentModel');
		$verify = $this->DepartmentModel->deleteDepartment($departmentId);
		if($verify == false){
			$data = array('response' => 'failed', 'message' => "There was an error deleting department");
		}
		else{
			$data = array('response' => 'success', 'message' => "Successfully deleted department");
		}
		echo json_encode($data);
	}

	//validation rules
	public function checkHead()
	{
		$id = $this->input->post('Head');

		if(empty($id)){
			return true;
		}
		else{
			$this->load->model('DepartmentModel');
			$verify = $this->DepartmentModel->checkHead($id);
			if($verify == false){
				return false;
			}
			else{
				return true;
			}
		}
	}

	public function checkDeptId()
	{
		$departmentId = $this->input->post('DepartmentId');
		$this->load->model('DepartmentModel');
		$verify = $this->DepartmentModel->checkDepartment($departmentId);
		if($verify == false){
			return false;
		}
		else{
			return true;
		}
	}

}