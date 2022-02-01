<?php
    class DepartmentModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        // fetch records
        public function fetch()
        {
            $message = "";
            $this->db->trans_start();
            $sql = "select departments.Description,departments.DepartmentId,departments.Department,concat(employees.FirstName , ' ' , employees.LastName) as Head,(SELECT COUNT(DepartmentId) from employees WHERE employees.DepartmentId = departments.DepartmentId) as NumberOfEmployees,employees.EmployeeNumber
            from departments
            left JOIN
            employees
            On departments.DepartmentHead = employees.EmployeeId";
            $results = $this->db->query($sql);
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $message = "failed";
            }
            else{
                if(count($results->result()) > 0){
                    $message = $results->result();
                }
                else{
                $message = "none";
                }
            }
            return $message;
        }


        public function addDepartment($ajax_data)
        {
            $this->db->trans_start();
            $this->db->set($ajax_data);
            if($ajax_data['DepartmentHead'] == ""){
                $ajax_data['DepartmentHead'] = null;
            }
            $this->db->insert('departments',$ajax_data);
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                return false;
            }
            else{
                if($affectedRows > 0){
                    $type = 1;
                    $this->activity($ajax_data,$type);
                    return true;
                }
                else{
                    return false;        
                }
            }

        }

        public function loadSearches()
        {
            $this->db->trans_start();
            $sql = "SELECT employees.EmployeeId,employees.EmployeeNumber,employees.FirstName, employees.LastName,employees.ContactNumber,employees.Image,
            departments.Department,
            branches.Branch,
            positions.Position,
            schedules.TimeIn,
            schedules.TimeOut
            FROM employees 
            LEFT join departments on employees.DepartmentId = departments.DepartmentId
            LEFT join positions on employees.PositionId = positions.PositionId
            LEFT join schedules on employees.ScheduleId = schedules.ScheduleId
            LEFT join branches on employees.BranchId = branches.BranchId";
            $results = $this->db->query($sql);
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                  return false;
            }
            else{
                
                return $results->result();
            }
    
        }

        public function loadEditForm($id)
        {
            $this->db->trans_start();
            $sql = "SELECT departments.DepartmentId,departments.Department,departments.Description,employees.EmployeeNumber,employees.EmployeeId
            from departments
            left join 
            employees
            on employees.EmployeeId = departments.DepartmentHead
            where departments.DepartmentId = ?";
            $results = $this->db->query($sql,array($id));
            $this->db->trans_complete();
            if(count($results->result()) > 0){
                return $results->result();
            }
            else{
                return false;
            }
        }
        // Edit Records
        public function editRecords($ajax_data)
        {
            $this->db->trans_start();
            if(empty($ajax_data['DepartmentHead'])){
                $ajax_data['DepartmentHead'] = null;
            }

            $message = "";
            $sql = "UPDATE `departments`
                    SET `Department`= ?,
                    `Description`= ?,
                    `DepartmentHead`= ?
                     WHERE DepartmentId = ?";
            $results = $this->db->query($sql,array(
                $ajax_data['Department'],
                $ajax_data['Description'],
                $ajax_data['DepartmentHead'],
                $ajax_data['DepartmentId'],
            ));
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $message = "failed";
            }
            else{
                if($affectedRows > 0){
                    $type = 2;
                    $this->activity($ajax_data,$type);
                    $message = "success";
                }
                else{
                    $message = "none";
                }
            }
            return $message;  
        }

        //validation rules
        
        public function checkHead($id)
        {
            $this->db->trans_start();
            $sql = "SELECT EmployeeId from employees where EmployeeId = ?";
            $results = $this->db->query($sql,array($id));
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                return false;
            }
            else{
                if(count($results->result()) > 0){
                    return true;
                }
                else{
                    return false;
                }
            }
        }
        public function checkDepartment($departmentId)
        {
            $this->db->trans_start();
            $sql = "SELECT DepartmentId from departments where departmentId = ?";
            $results = $this->db->query($sql,array($departmentId));
            $this->db->trans_complete();
            if(count($results->result()) > 0){
                return true;
            }
            else{
                return false;
            }
        }

        // delete department
        public function deleteDepartment($ajax_data)
        {
            $this->db->trans_start();
            $sql = "DELETE FROM departments where departmentId = ?";
            $this->db->query($sql,array(
                $ajax_data['DepartmentId']
            ));
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                return false;
            }
            else{
                $type = 3;
                $this->activity($ajax_data,$type);
                return true;
            }
            
        }
        private function activity($ajax_data,$type)
        {
            $activity = "";
            $username = $this->session->userdata('username');
			$adminId = $this->session->userdata('adminId');
            if($type == 1){
                $activity = "Added new department ".$ajax_data['Department'];
            }
            else if ($type == 2){
                $activity = "Edited department ".$ajax_data['Department'];
            }
            else if ($type == 3){
                $activity = "Deleted department ".$ajax_data['Department'];
            }
            $sql = "INSERT into activitylog(AdminId,Username,Activity,Date) VALUES(?,?,?,CURRENT_DATE)";
            $this->db->query($sql,array($adminId,$username,$activity));   
        }
}

?>