<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BranchControl extends CI_Controller {

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
			$this->load->view('BranchView',$data);
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
		$this->load->model('BranchModel');
		$verify = $this->BranchModel->fetch();
		if($verify === "none"){
			$data = array('response' => "none" , 'message' => "no records found");
		}
		else if($verify === false){
			$data = array('response' => "failed" , 'message' => "no records found");

		}
		else{
			$data = array('response' => "success" , 'posts' => $verify);
		}
		echo json_encode($data);
	}

    public function addRecord()
    {
        $this->form_validation->set_rules('BranchName','Branch Name Field','required|min_length[1]',
        array(
            'required'=> "Please assign a branch Name",
            'min_length' => "Branch name should at least be 1 character in length"
        ));

        $this->form_validation->set_rules('Address','Address Field','required|min_length[1]',
        array(
            'required'=> "Please assign an Address",
            'min_length' => "Address should at least be 1 character in length"
        ));





        if($this->form_validation->run() == false){
			$data = array('response' => 'failed', 'message' => validation_errors());
		}

        else{
			$ajax_data = array(
				'Branch' => $this->input->post('BranchName'),
				'Address' => $this->input->post('Address'),

			);
			$this->load->model('BranchModel');
			$verify = $this->BranchModel->addRecord($ajax_data);
			if($verify === false){
				$data = array('response' => 'failed', 'message' => "Failed To Insert Record");
			}
			else{
				$data = array('response' => 'success', 'message' => "Successfully Inserted Record");

			}

        }
        echo json_encode($data);
    }

    public function editRecord()
    {
        $this->form_validation->set_rules('BranchName','Branch Name Field','required|min_length[1]',
        array(
            'required'=> "Please assign a branch Name",
            'min_length' => "Branch name should at least be 1 character in length"
        ));

        $this->form_validation->set_rules('Address','Address Field','required|min_length[1]',
        array(
            'required'=> "Please assign an Address",
            'min_length' => "Address should at least be 1 character in length"
        ));



        if($this->form_validation->run() == false){
			$data = array('response' => 'failed', 'message' => validation_errors());
		}

        else{
			$ajax_data = array(
                'BranchId' => $this->input->post('BranchId'),
				'Branch' => $this->input->post('BranchName'),
				'Address' => $this->input->post('Address'),
			);
			$this->load->model('BranchModel');
			$verify = $this->BranchModel->editRecord($ajax_data);
            
			if($verify === false){
				$data = array('response' => 'failed', 'message' => "Failed To Insert Record");
			}
            else if($verify === "none"){
                $data = array('response' => 'none', 'message' => "No Changes Made");
            }
			else{
				$data = array('response' => 'success', 'message' => "Successfully To Insert Record");
			}

        }
        echo json_encode($data);
    }

	
    public function deleteRecord()
    {

    }
   

}
