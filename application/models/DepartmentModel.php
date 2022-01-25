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
                    return true;
                }
                else{
                    return false;        
                }
            }

        }

        public function loadSearches()
        {
            $message = "";
            $this->db->trans_start();
            $sql = "select employees.EmployeeId,employees.EmployeeNumber,employees.FirstName, employees.LastName,employees.ContactNumber,employees.Image,
            departments.Department,
            branches.Branch,
            positions.Position,
            schedules.TimeIn,
            schedules.TimeOut
            from employees 
            inner join departments on employees.DepartmentId = departments.DepartmentId
            inner join positions on employees.PositionId = positions.PositionId
            inner join schedules on employees.ScheduleId = schedules.ScheduleId
            inner join branches on employees.BranchId = branches.BranchId";
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
        public function deleteDepartment($departmentId)
        {
            $this->db->trans_start();
            $sql = "DELETE FROM departments where departmentId = ?";
            $this->db->query($sql,array($departmentId));
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                return false;
            }
            else{
                return true;
            }
            
        }
}

?>