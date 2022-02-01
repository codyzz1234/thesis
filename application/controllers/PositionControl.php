<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PositionControl extends CI_Controller {

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
			$this->load->view('PositionView',$data);
		}
		else{
			redirect('Login');
		}
	}
	public function fetch()
	{
		$this->load->model('PositionModel');
		$verify = $this->PositionModel->fetch();
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

	public function addPosition()
	{
		$this->form_validation->set_rules('PositionName','Position Name Field','required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('Description','Position Description Field','required|min_length[3]|max_length[50]');


		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$ajax_data = array(
				'Position'=> $this->input->post('PositionName'),
				'Description' => $this->input->post('Description'),
			);
			$this->load->model('PositionModel');
			$verify = $this->PositionModel->addPosition($ajax_data);

			if($verify == false){
				$data = array('response' => 'failed', 'message' => "There was an error inserting new position");
			}
			else{
				$data = array('response' => 'success', 'message' => "Position Added Successfully");
			}
		}
		echo json_encode($data);

	}
	public function editPosition()
	{
		$this->form_validation->set_rules('PositionId','Position Id','trim|numeric|required|min_length[1]|max_length[50]|callback_verifyId',
		array(
			'verifyId'=> "An Attempt to insert an invalid position id has been detected",
		));
		$this->form_validation->set_rules('PositionName','Position Name Field','required|min_length[3]|max_length[50]');

		$this->form_validation->set_rules('Description','Position Description Field','required|min_length[3]|max_length[50]');



		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}
		else{
			$ajax_data = array(
				'Position' => $this->input->post('PositionName'),
				'Description' => $this->input->post('Description'),
			);

			$PositionId =  $this->input->post('PositionId');
			$this->load->model('PositionModel');
			$verify = $this->PositionModel->editPosition($ajax_data,$PositionId);
			if($verify == "none"){
				$data = array('response' => 'none', 'message' => "No Changes Made");
			}
			else if($verify == "failed"){
				$data = array('response' => 'failed', 'message' => "An Error Occured when attempting to edit");
			}
			else{
				$data = array('response' => 'success', 'message' => "Successfully Edited Position");
			}
		}
		echo json_encode($data);

	}

	//delete record

	public function deleteRecord()
	{
		
		$this->form_validation->set_rules('PositionId','Position Id','trim|numeric|required|min_length[1]|max_length[50]|callback_verifyId',
		array(
			'verifyId'=> "An Attempt to insert an invalid position id has been detected",
		));

		if ($this->form_validation->run() == FALSE) {
			$data = array('response' => 'failed', 'message' => validation_errors());
		}

		else{
			$ajax_data = array(
				'PositionId' => $this->input->post('PositionId'),
				'Position' => $this->input->post('Position')
			);
			$this->load->model('PositionModel');
			$verify = $this->PositionModel->deletePosition($ajax_data);
			if($verify == false){
				$data = array('response' => 'failed', 'message' => "Failed To delete Position");
			}
			else{
				$data = array('response' => 'success', 'message' => "Successfully Deleted Position");
			}
		}
		echo json_encode($data);
	}

	//verify functions
	public function verifyId()
	{
		$this->db->trans_start();
		$id = $this->input->post('PositionId');
		
		$this->load->model('PositionModel');
		$this->load->database();
		$sql = 'SELECT * FROM positions where PositionId = ?';
		$results = $this->db->query($sql,array($id));
		$this->db->trans_complete();
		if(count($results->result()) > 0){
			return true;
		}
		else{
			return false;
		}
	}
}