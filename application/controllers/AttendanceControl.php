<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AttendanceControl extends CI_Controller {

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
			$this->load->view('AttendanceView',$data);
		}
		else{
			redirect('Login');
		}
	}
	public function fetch()
	{
		$this->load->model('AttendanceModel');
		$verify = $this->AttendanceModel->fetch();
		if($verify == "failed"){
			$data = array('response'=>"failed",'message'=>"failed to retrieve records due to connection error");
		}
		else if($verify == "none"){
			$data = array('response'=>"none",'message'=>"There are no records to be retrieved");
		}
		else{
			$data = array('response'=>"success",'posts'=>$verify);
		}
		echo json_encode($data);
	}
	
}