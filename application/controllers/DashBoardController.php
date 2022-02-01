<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashBoardController extends CI_Controller {

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
				'adminId' => $this->session->userdata('adminId')

			);
			$this->load->view('template/DashBoardHead',$data);
			$this->load->view('DashBoardView',$data);
		}
		else{
			redirect('Login');
		}
	}
	
	public function logOut()
	{
		$this->load->model('DashBoardModel');
		$this->DashBoardModel->logOut();
		$this->session->sess_destroy();
		redirect('Login');
	}

	public function fetch()
	{
		$this->load->model('DashBoardModel');
		$dataArray = $this->DashBoardModel->fetchAllEmployees();
		if($dataArray == false){
			$dataArray = array('response'=> "failed", 'message'=> "Error Loading The Data to Cards");
		}
		else{
			$dataArray = array('response'=> "success", 'posts' => $dataArray);
		}
		echo json_encode($dataArray);
	}

}
