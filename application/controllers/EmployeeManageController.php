<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeManageController extends CI_Controller {

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
			$this->load->view('EmployeeManageView',$data);
		}
		else{
			redirect('Login');
		}

	}

	public function loadAddRecordModal()
	{
		$this->load->model('EmployeeManageModel');
		$departments = $this->EmployeeManageModel->loadDepartments();
		$positions = $this->EmployeeManageModel->loadPositions();
		$schedules = $this->EmployeeManageModel->loadSchedules();
		$branches = $this->EmployeeManageModel->loadBranch();
		$data = array('departments'=>$departments,'positions'=>$positions,'schedules'=>$schedules,'branches'=>$branches);
		echo json_encode($data);

	}
	// Generate Employee Number
	function random_str(
		int $length = 64,
		string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	): string {
		if ($length < 1) {
			throw new \RangeException("Length must be a positive integer");
		}
		$pieces = [];
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$pieces []= $keyspace[random_int(0, $max)];
		}
		return implode('', $pieces);
	 }

	public function addEmployee()
	{
			$this->load->database();

			$this->form_validation->set_rules('FirstName', 'FirstName', 'trim|required|min_length[2]|max_length[50]');

			$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|min_length[2]|max_length[30]');


		$this->form_validation->set_rules('BirthDate', 'BirthDate', 'trim|required|callback_checkBirthDate',
			array('checkBirthDate' => 'Please Enter A Valid BirthDate'
			));	

			$this->form_validation->set_rules('Address', 'Address', 'required|min_length[10]|max_length[150]');

			$this->form_validation->set_rules('RFID', 'RFID', 'trim|required|alpha_numeric|is_unique[employees.RFID]',
			array('alpha_numeric'=> 'RFID cannot contain special symbols',
				'is_unique'=> 'An employee has already been assigned that RFID tag'));

			
			$this->form_validation->set_rules('ContactNumber','ContactNumber','trim|required|callback_checkPhoneNumber',
			array(
				'checkPhoneNumber'=>"Input a valid mobile number",
			));

			$this->form_validation->set_rules('ScheduleId','ScheduleId','trim|required|numeric|greater_than[0]',
			array('greater_than'=> 'Please Select a Schedule')	);

			$this->form_validation->set_rules('PositionId','PositionId','trim|required|numeric|greater_than[0]',
			array('greater_than'=> 'Please Select a Position')	);


			$this->form_validation->set_rules('DepartmentId','DepartmentId','trim|required|numeric|greater_than[0]',
			array('greater_than'=> 'Please Select a Department'));

			$this->form_validation->set_rules('BranchId','BranchId','trim|required|numeric|greater_than[0]',
			array('greater_than'=> 'Please Select a Branch'));

			
			$this->form_validation->set_rules('BaseSalary','Base Salary Field','trim|required|numeric|greater_than[0]',
			array(
				'numeric' => 'Base Salary must be in a valid currency form'
			));

			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => 'failed', 'message' => validation_errors());
			} 
			else {
					$employeeId = $this->random_str(6,'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
					$employeeId = date('Y')."-".$employeeId;
					$BirthDate = $this->input->post('BirthDate');
					$BirthDate = date('Y-m-d',strtotime($BirthDate));

					$imagePath = $this->imageUpload($employeeId);

					$contactNum = $this->input->post('ContactNumber');
					
			

					if($imagePath['response'] == "success"){

						$ajax_data = array(
							'FirstName' => $this->input->post('FirstName'),
							'LastName' => $this->input->post('LastName'),
							'EmployeeNumber'=>$employeeId,
							'BirthDate' => $BirthDate,
							'Address' => $this->input->post('Address'),
							'RFID' => $this->input->post('RFID'),
							'ContactNumber' => $contactNum,
							'ScheduleId' => $this->input->post('ScheduleId'),
							'PositionId' => $this->input->post('PositionId'),
							'DepartmentId' => $this->input->post('DepartmentId'),
							'BranchId' => $this->input->post('BranchId'),
							'HireDate' => date('Y-m-d'),
							'Image' => $imagePath['message'],
							);

							$baseSalary = $this->input->post('BaseSalary');
							$baseSalary = round($baseSalary,2);
							
							
							$ajax_data2 = array(
								'EmployeeNumber'=>$employeeId,
								'BaseSalary' => $baseSalary,			
							);
		
							$this->load->model('EmployeeManageModel');
		
							$verify = $this->EmployeeManageModel->addEmployee($ajax_data,$ajax_data2);
							if($verify != true ){
									$data = array('response' => 'failed', 'message' => 'Failed to insert data, try again later');
								}
								else{
									$data = array('response' => 'success', 'message' => "Employee Added Successfully");
						  }	
					}
					else{
						$data = array('response'=>'failed','message'=>$imagePath['message']);
					}
			}
			echo json_encode($data);
	}

// Image Handlers
	public function imageUpload($employeeId)
	{
		$imagePath = "";
		if(isset($_FILES["Image"]["name"])){
			$config['upload_path'] = './assets/EmployeeImages/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $employeeId;
			$config['overwrite'] = TRUE;
			$config['max_size'] = '2000';
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('Image')){
				$response = array('response'=> "failed", 'message'=>$this->upload->display_errors());
			}
			else{
				$imageData = $this->upload->data();
				$this->resizeImage($imageData);
				$imagePath = $config['upload_path'].$imageData['file_name'];
				$response = array('response'=> "success", 'message'=>$imagePath);
			}
		}
		else{
				$imagePath = "./assets/EmployeeImages/default.png";
				$response = array('response'=> "success", 'message'=>$imagePath);
		}
		return $response;
	}

	private function resizeImage($imageData)
	{
		$this->load->library('image_lib');
				$configer =  array(
				'image_library'   => 'gd2',
				'source_image'    => $imageData['full_path'],
				'overwrite'       => TRUE,
				'maintain_ratio'  =>  TRUE,
				'width'           =>  500,
				'height'          =>  500,
				);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
	}

	private function editImageHandler($employeeId)
	{
		$imagePath = "";
		if(isset($_FILES["Image"]["name"])){
			$config['upload_path'] = './assets/EmployeeImages/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['file_name'] = $employeeId;
			$config['overwrite'] = TRUE;
			$config['max_size'] = '2000';
			$this->load->library('upload',$config);
			if(!$this->upload->do_upload('Image')){
				$response = array('response'=> "failed", 'message'=>$this->upload->display_errors());
			}
			else{
				$imageData = $this->upload->data();
				$this->resizeImage($imageData);
				$imagePath = $config['upload_path'].$imageData['file_name'];
				$response = array('response'=> "success", 'message'=>$imagePath);
			}
		}
		else{
				$imagePath = "";
				$response = array('response'=> "success", 'message'=>$imagePath);
		}
		return $response;
	}

// load records
	public function loadRecords()
	{
		$this->load->model('EmployeeManageModel');
		$verify = $this->EmployeeManageModel->loadTable();
		if($verify == false){
			$data = array('response'=>'failed','message'=> 'An error has occured,failed to retrieve data');
		}
		else if($verify == "none"){
			$data = array('response'=>'none','message'=> 'There are No Employee Records to be retrieved.');

		}
		else{
			$data = array('response'=>'success','posts'=>$verify);
		}
		echo json_encode($data);
	}

	public function loadEditForm()
	{
		$employeeId = $this->input->post('employeeId');
		$this->load->model('EmployeeManageModel');
		$verify = $this->EmployeeManageModel->loadEditForm($employeeId);
		if($verify === false){
			$data = array('response'=>"failed",'message'=> "there was a failure in retrieval of data, try again later");
		}
		else{
			$data = array('response'=>"success",'posts'=>$verify);
		}
		echo json_encode($data);
	
	}


	public function updateRecords()
	{
			$this->load->database();
			$this->form_validation->set_rules('FirstName','FirstName', 'trim|required|min_length[2]|max_length[50]');

			$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|min_length[2]|max_length[30]');

	

			$this->form_validation->set_rules('BirthDate', 'BirthDate', 'trim|required|callback_checkBirthDate',
			array('checkBirthDate' => 'Please Enter A Valid BirthDate'
			));	

			$this->form_validation->set_rules('Address', 'Address', 'required|min_length[10]|max_length[150]');

			$this->form_validation->set_rules('RFID', 'RFID', 'trim|required|alpha_numeric|callback_checkRFID',
			array('alpha_numeric'=> 'RFID cannot contain special symbols',
				'checkRFID'=> 'Cannot update RFID number, an employee using this number already exists'));



			$this->form_validation->set_rules('ContactNumber','ContactNumber','trim|required|callback_checkPhoneNumber',
			array(
				'checkPhoneNumber'=>"Input a valid mobile number",
			));

			$this->form_validation->set_rules('ScheduleId','ScheduleId','trim|required|numeric|greater_than[0]',
			array('greater_than'=> 'Please Select a Schedule')	);

			$this->form_validation->set_rules('PositionId','PositionId','trim|required|numeric|greater_than[0]',
			array('greater_than'=> 'Please Select a Position')	);


			$this->form_validation->set_rules('DepartmentId','DepartmentId','trim|required|numeric|greater_than[0]',
			array(
				  'greater_than'=> 'Please Select a Department',
				  'numeric'=>'Please Select a Department',
				   ));

			$this->form_validation->set_rules('BranchId','BranchId','trim|required|numeric|greater_than[0]',
			array('greater_than'=> 'Please Select a Branch'));

			if ($this->form_validation->run() == FALSE) {
				$data = array('response' => 'failed', 'message' => validation_errors());
			} 
			else{

				$BirthDate = $this->input->post('BirthDate');
				$BirthDate = date('Y-m-d',strtotime($BirthDate));
				$employeeNumber = $this->input->post('EmployeeNumber');

				$imagePath = $this->editImageHandler($employeeNumber);

				if($imagePath['response'] == "success"){
					$ajax_data = array(
						'FirstName' => $this->input->post('FirstName'),
						'LastName' => $this->input->post('LastName'),
						'BirthDate' => $BirthDate,
						'Address' => $this->input->post('Address'),
						'RFID' => $this->input->post('RFID'),
						'ContactNumber' => $this->input->post('ContactNumber'),
						'ScheduleId' => $this->input->post('ScheduleId'),
						'PositionId' => $this->input->post('PositionId'),
						'DepartmentId' => $this->input->post('DepartmentId'),
						'BranchId' => $this->input->post('BranchId'),
						'EmployeeId' => $this->input->post('EmployeeId'),
						);
					$this->load->model('EmployeeManageModel');
					$verify = $this->EmployeeManageModel->updateRecords($ajax_data,$imagePath);
					if($verify['response'] == "success"){
						$data = array('response'=>"success",'message'=>'Data Updated');
					}
					else if ($verify['response'] == "failed" ){
						$data = array('response'=>"failed",'message'=>'Failed to update data');
					}
					else if($verify['response'] == "none" ){
						$data = array('response'=> "none",'message'=>'No data was changed');
					}
				  }
				  else{
						$data = array('response'=>"failed",'message'=>$imagePath['message']);
				  }
				}
		echo json_encode($data);
	}
	//verification methods

	public function checkRFID()
	{
		$employeeId = $this->input->post('EmployeeId');;
		$rfid = $this->input->post('RFID');

		$dataCheck = array('RFID'=>$rfid,'employeeId'=>$employeeId);
		$this->load->model('EmployeeManageModel');
		$verify = $this->EmployeeManageModel->checkRFID($dataCheck);
		if($verify == false){
			return false;
		}
		else{
			return true;
		}
	}
	public function checkBirthDate()
	{
		$birthDate = $this->input->post('BirthDate');
		$birthDate = date('Y-m-d',strtotime($birthDate));
		$checkdate = $this->validateDate($birthDate);
		if($checkdate == false){
			return false;
		}
		else{
			return true;
		}
	}
	private function validateDate($birthDate,$format = 'Y-m-d')
	{
		$d = DateTime::createFromFormat($format, $birthDate);
		return $d && $d->format($format) == $birthDate;
	}

	public function loadDeleteForm()
	{
		$id = $this->input->post('id');
		$this->load->model('EmployeeManageModel');
		$verify = $this->EmployeeManageModel->loadDeleteForm($id);
		if($verify == false){
			$data = array('response'=> "failed",'message'=> "There was an error in loading form");
		}
		else{
			$data = array('response'=> "success",'posts'=> $verify);
		}
		echo json_encode($data);
	}

	public function deleteRecord()
	{
		$id = $this->input->post('id');
		$this->load->model('EmployeeManageModel');
		$verify = $this->EmployeeManageModel->deleteRecord($id);
		if($verify == false){
			$data = array('response'=> "failed",'message'=> "There was an error in deleting record");
		}
		else{
			$data = array('response'=> "success",'message'=>"Employee Deleted Successfully");
		}
		echo json_encode($data);
	}
	public function checkPhoneNumber()
	{
		$contactNum = $this->input->post('ContactNumber');
		if(!preg_match('/(^6\d{11}$)|(^0\d{10}$)|(^9\d{9}$)/',$contactNum)){
			return false;
		}
		else{
			return true;
		}
	}
	
}
