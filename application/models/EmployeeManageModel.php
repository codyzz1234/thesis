<?php

    class EmployeeManageModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }

        public function loadBranch()
        {
            $this->db->trans_start();
            $sql = "SELECT `BranchId`, `Branch` FROM `branches`" ;
            $results =  $this->db->query($sql);
            $this->db->trans_complete();
            return $results->result();

        }

        public function loadPositions()
        {
            $this->db->trans_start();
            $sql = "SELECT `PositionId`, `Position` FROM `positions`" ;
            $results =  $this->db->query($sql);
            $this->db->trans_complete();
            return $results->result();
        }


        public function loadDepartments()
        {
            $this->db->trans_start();
            $sql = "SELECT `DepartmentId`, `Department`, `Description`, `DepartmentHead` FROM `departments`" ;
            $results =  $this->db->query($sql);
            $this->db->trans_complete();
            return $results->result();
        }

        public function loadSchedules()
        {
            $this->db->trans_start();
            $sql = "SELECT `ScheduleId`, `TimeIn`, `TimeOut` FROM `schedules`" ;
            $results =  $this->db->query($sql);
            $this->db->trans_complete();
            return $results->result();
        }

        public function addEmployee($ajax_data,$ajax_data2)
        {   
           
            $this->db->trans_start();
            $this->db->insert('employees',$ajax_data); 

        
            $sql = "INSERT INTO employeecalculation (EmployeeId,EmployeeNumber,BaseSalary) 
            VALUES((SELECT MAX(employees.EmployeeId) from employees),?,?)";
            $this->db->query($sql,array(
                $ajax_data2['EmployeeNumber'],
                $ajax_data2['BaseSalary'],
            ));

            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return false;
            } 
            else {
                if($affectedRows <= 0){
                    return false;
                }
                else{
                    $type = 1;
                    $this->activity($ajax_data,$type);
                    return true; 
                }
            }
        }

        public function searchBar()
        {
            $this->db->trans_start();
            $sql = "select EmployeeId,FirstName,LastName from employees";
            $results = $this->db->query($sql);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                return false;
            } 
            else {
                return $results->result();
            }
        }

        public function loadTable()
        {
            $message = "";
            $this->db->trans_start();
            $sql = "SELECT employees.EmployeeId,employees.Image,employees.EmployeeNumber,employees.FirstName,employees.LastName,employees.ContactNumber
            ,departments.Department,branches.Branch,
            positions.Position,
            schedules.TimeIn,schedules.TimeOut
            from employees
            
            left join departments
            on departments.DepartmentId = employees.DepartmentId
            
            left join positions
            on positions.PositionId = employees.PositionId
            
            left join schedules
            on schedules.ScheduleId = employees.ScheduleId
            
            left join branches
            on branches.BranchId = employees.BranchId";

            $results = $this->db->query($sql);
            $this->db->trans_complete();           
            if($this->db->trans_status() == false){
                $message = false;
            }
            else{
                if(count ($results->result()) > 0){
                    $message = $results->result();
                }
                else{
                    $message = "none";
                }
            }
            return $message;
        }

        public function loadEditForm($employeeId)
        {
            $this->db->trans_start();

            $sql = "SELECT `EmployeeId`, `EmployeeNumber`, `RFID`, `FirstName`, `Image`,
            `LastName`, `Address`, `ContactNumber`, 
            DATE_FORMAT(BirthDate,'%m/%d/%Y') AS 'BirthDate', `HireDate`, 
            `DepartmentId`, `PositionId`, `BranchId`, `ScheduleId`, `status` FROM `employees` 
            where EmployeeId = ?";

            $results = $this->db->query($sql,array($employeeId));
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
                return false;
            }
            else{
                if(count ($results->result()) > 0){
                    return $results->result();
                }
                else{
                    return false;
                }
            }
        }

        

        public function checkRFID($dataCheck)
        {
            $this->db->trans_start();
            $sql = 'select * from employees where RFID = ? and EmployeeId != ?';
            $results = $this->db->query($sql,$dataCheck);
            $this->db->trans_complete();
            if(count ($results->result()) > 0){
                return false;
            }
            else{
                return true;
            }
              
        }
        public function updateRecords($ajax_data,$imagePath)
        {
            $this->db->trans_start();
            if($imagePath['message']==""){
                $sql = "UPDATE `employees` SET 
                `RFID`= ?,
                `FirstName`= ?,
                `LastName`= ?,
                `Address`= ?,
                `ContactNumber`= ?,
                `BirthDate`= ?,
                `DepartmentId`= ?,
                `PositionId`= ?,
                `BranchId`= ?,
                `ScheduleId`= ?
                WHERE `EmployeeId` = ?";
                 $this->db->query($sql,
                 array(   
                     $ajax_data['RFID'],
                     $ajax_data['FirstName'],
                     $ajax_data['LastName'],
                     $ajax_data['Address'],
                     $ajax_data['ContactNumber'],
                     $ajax_data['BirthDate'],
                     $ajax_data['DepartmentId'],
                     $ajax_data['PositionId'],
                     $ajax_data['BranchId'],
                     $ajax_data['ScheduleId'],
                     $ajax_data['EmployeeId']            
                    ));
            }
            else{
                $id = $ajax_data['EmployeeId'];
                $sql = "UPDATE `employees` SET `Image` = ?
                WHERE `EmployeeId` = ?";
                $this->db->query($sql,array("",$id));

                $sql = "UPDATE `employees` SET 
                `RFID`= ?,
                `FirstName`= ?,
                `LastName`= ?,
                `Address`= ?,
                `ContactNumber`= ?,
                `BirthDate`= ?,
                `DepartmentId`= ?,
                `PositionId`= ?,
                `BranchId`= ?,
                `ScheduleId`= ?,
                `Image` = ?
                WHERE `EmployeeId` = ?";
                 $this->db->query($sql,
                 array(   
                     $ajax_data['RFID'],
                     $ajax_data['FirstName'],
                     $ajax_data['LastName'],
                     $ajax_data['Address'],
                     $ajax_data['ContactNumber'],
                     $ajax_data['BirthDate'],
                     $ajax_data['DepartmentId'],
                     $ajax_data['PositionId'],
                     $ajax_data['BranchId'],
                     $ajax_data['ScheduleId'],
                     $imagePath['message'],
                     $ajax_data['EmployeeId']        
                    ));
            }
            if ($this->db->affected_rows() > 0) {
                $data = array('response'=>"success",'message'=>'Data Updated');
                $type = 2;
                $this->activity($ajax_data,$type);
            } 
            else {
                if ($this->db->trans_status() == FALSE) {
                    $data = array('response'=>"failed",'message'=>'Failed to update data');
                }
                else{
                    $data = array('response'=>"none",'message'=>'No data was changed');
                }
            }
            $this->db->trans_complete();
            return $data;
        }

        public function loadDeleteForm($id)
        {
            $this->db->trans_start();
            $sql = "SELECT `EmployeeId`, `EmployeeNumber`, `RFID`, `FirstName`, 
            `LastName`, `Address`, `ContactNumber`, 
            DATE_FORMAT(BirthDate,'%m/%d/%Y') AS 'BirthDate', `HireDate`, 
            `DepartmentId`, `PositionId`, `BranchId`, `ScheduleId`, `status`,`Image` FROM `employees` 
            where EmployeeId = ?";

            $result = $this->db->query($sql,array($id));
            $this->db->trans_complete();
            if ($this->db->trans_status() == FALSE) {
                return false;
            }
            else{
                return $result->result();
            }
        }

        
        public function deleteRecord($id)
        {
            $this->db->trans_start();
            $this->unlinkFile($id);
            $sql = "DELETE from `employees` where `EmployeeId` = ?";
            $this->db->query($sql,array($id));
            $this->db->trans_complete();
            if ($this->db->trans_status() == FALSE) {
                return false;
            }
            else{
                return true;
            }
        }

        private function unlinkFile($id)
        {
            $sql = "SELECT `Image` from employees where EmployeeId = ?";
            $results = $this->db->query($sql,array($id));
            if(count ($results->result()) <= 0){
                return;
            }
            else{
                foreach ($results->result() as $row){
                    $filePath = $row->Image;
                    if($filePath == "./assets/EmployeeImages/default.png"){
                        continue;
                    }
                    else{
                        @unlink($filePath);
                    }
                }
            }
        }

        private function activity($ajax_data,$type)
        {
            $activity = "";
            $username = $this->session->userdata('username');
			$adminId = $this->session->userdata('adminId');
            if($type == 1){
                $activity = "Added New Employee ".'"'.$ajax_data['EmployeeNumber'].'"';
            }
            else if($type == 2){
                $activity = "Updated Employee ".'"'.$ajax_data['EmployeeNumber'].'"';
            }
            else if ($type == 3){

            }
            $sql = "INSERT into activitylog(AdminId,Username,Activity,Date) VALUES(?,?,?,CURRENT_DATE)";
            $this->db->query($sql,array($adminId,$username,$activity));

        }

}

?>