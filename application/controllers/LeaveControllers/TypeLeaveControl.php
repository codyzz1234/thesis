<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TypeLeaveControl extends CI_Controller {

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
			$this->load->view('LeaveViews/TypeLeaveView',$data);
		}
		else{
			redirect('Login');
		}
	}

	public function fetch()
	{
		$this->load->model('LeaveModels/TypeLeaveModel');
		$verify = $this->TypeLeaveModel->fetch();
		if($verify == "none"){
			$data = array('response'=>"none",'message'=>"No Records Retrieved");
		}
		else if($verify == "failed"){
			$data = array('response'=>"failed",'message'=>"No Records Retrieved");
		}
		else{
			$data = array('response'=>"success",'posts'=>$verify);
		}
		echo json_encode($data);
	}

	public function addLeaveType()
	{
		$this->form_validation->set_rules('LeaveType', 'Leave Type Field', 'trim|required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('Description', 'Description Field', 'trim|required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('Days', 'Days Allocated Field', 'trim|required|integer|min_length[1]|max_length[50]');

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		} 
		else{
			$type = $this->input->post('LeaveType');
			$ajax_data = array(
				'Type' => $this->input->post('LeaveType'),
				'Description'=> $this->input->post('Description'),
				'DaysAllocated' => $this->input->post('Days'),
			);
			$this->load->model('LeaveModels/TypeLeaveModel');
			$verify = $this->TypeLeaveModel->add($ajax_data);
			if($verify == false){
				$data = array('response' => 'failed', 'message' =>"Failed To Insert Leave Type");
			}
			else{
				$data = array('response' => 'success', 'message' =>"Successfully To Added Leave Type");
			}
		}
		echo json_encode($data);
	}
	// Edit Leave Type
	public function editLeaveType()
	{

		$this->form_validation->set_rules('LeaveId', 'Leave Id Field', 'trim|integer|required|min_length[1]|max_length[50]|callback_checkLeaveId',
		array(
			'checkLeaveId'=> "An attempt to insert an incorret leave id has been detected",
		));

		$this->form_validation->set_rules('Type', 'Type Field', 'required|min_length[3]|max_length[50]');

		$this->form_validation->set_rules('Description', 'Description Field', 'required|min_length[3]|max_length[50]');

		$this->form_validation->set_rules('Days', 'Days Allocated Field', 'trim|integer|required|min_length[1]|max_length[50]',
		array(
			'integer'=>"Days Allocated Must Be A Whole Number",
		));

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$ajax_data = array(
				'Id' => $this->input->post('LeaveId'),
				'Type' => $this->input->post('Type'),
				'Description' => $this->input->post('Description'),
				'DaysAllocated' => $this->input->post('Days'),
			);
			$this->load->model('LeaveModels/TypeLeaveModel');
			$verify = $this->TypeLeaveModel->edit($ajax_data);
			if($verify == "none"){
				$data = array('response' => 'none', 'message' => "No Changes were Made");
			}
			else if($verify == "failed"){
				$data = array('response' => 'failed', 'message' => "Faied To Update Leave Type");
			}
			else{
				$data = array('response' => 'success', 'message' => "Successfully Update Leave Type");
			}
		}
		echo json_encode($data);
	}
	public function deleteLeaveType()
	{
		$this->form_validation->set_rules('LeaveId', 'Leave Id Field', 'trim|integer|required|min_length[1]|max_length[50]|callback_checkLeaveId',
		array(
			'checkLeaveId'=> "An attempt to insert an incorret leave id has been detected",
		));
		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$id = $this->input->post('LeaveId');
			$this->load->model('LeaveModels/TypeLeaveModel');
			$verify = $this->TypeLeaveModel->delete($id);
			if($verify == false){
				$data = array('response' => 'failed', 'message' => "There was an error deleting Type");
			}
			else{
				$data = array('response' => 'success', 'message' =>"Leave Type Deleted");
			}
		}
		echo json_encode($data);
	}
	//validation rules
	public function checkLeaveId()
	{
		$this->load->database();
	    $id = $this->input->post('LeaveId');
		$this->db->trans_start();
		$sql = "SELECT LeaveId from leavetype where LeaveId = ?";
		$verify = $this->db->query($sql,array($id));
		$this->db->trans_complete();
		if(count($verify->result()) > 0){
			return true;
		}
		else{
			return false;
		}
	}
}