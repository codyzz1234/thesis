<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PayrollControl extends CI_Controller {

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
			$this->load->view('PayrollView',$data);
		}
		else{
			redirect('Login');
		}
	}
	public function fetch()
	{
		$startDate = $this->input->post('StartDate');
		$endDate = $this->input->post('EndDate');

		$this->load->model('PayrollModel');
		$verify = $this->PayrollModel->fetch($startDate,$endDate);
		
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
}
	