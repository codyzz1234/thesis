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
    public function fetch()
    {
        
    }

}
