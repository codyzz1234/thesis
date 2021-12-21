<?php
    class EmployeeAccountManageModel extends CI_Model
    {
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetch()
        {
            $this->db->trans_start();
            $sql = "SELECT employeelogin.EmployeeId, employeelogin.LastLogin,employeelogin.DateCreated, employeelogin.EmployeeNumber, employees.FirstName, employees.LastName,employees.Image
            from employeelogin
            inner JOIN
            employees
            on employeelogin.EmployeeId = employees.EmployeeId
            and employeelogin.EmployeeNumber = employees.EmployeeNumber";
            $results = $this->db->query($sql);
            $this->db->trans_complete();
            if(count($results->result()) > 0 ){
                return $results->result();
            }
            else{
                return false;
            }
        }
        public function search()
        {
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
            return $results->result();
        }

        public function addAccount($ajax_data)
        {
            $this->db->trans_start();
            $sql = "INSERT INTO `employeelogin`(`EmployeeId`, `EmployeeNumber`, `Password`) VALUES (?,?,?)";
            $results = $this->db->query($sql,array(
                $ajax_data['EmployeeId'],
                $ajax_data['EmployeeNumber'],
                $ajax_data['Password'],
            ));
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affectedRows > 0){
                return true;
            }
            else{
                return false;
            }
        }
        public function loadEditForm($id)
        {
            $this->db->trans_start();
            $sql = "select employeelogin.EmployeeId, employeelogin.Password, employeelogin.EmployeeNumber, employees.FirstName, employees.LastName
            from employeelogin
            inner JOIN
            employees
            on employeelogin.EmployeeId = employees.EmployeeId
            and employeelogin.EmployeeNumber = employees.EmployeeNumber
            where employeelogin.EmployeeId = ?";
            $results = $this->db->query($sql,array($id));
            $this->db->trans_complete();
            if(count($results->result()) > 0){
                return $results->result();
            }
            else{
                return false;
            }

        }
        public function updateAccount($ajax_data)
        {
            $this->db->trans_start();
            $sql = "UPDATE `employeelogin` SET 
            `Password`= ?
             WHERE `EmployeeId` = ?";
             $results = $this->db->query($sql,array(
                 $ajax_data['Password'],
                 $ajax_data['id']
             ));
             $affectedRows = $this->db->affected_rows();
             $this->db->trans_complete();
             if($affectedRows > 0){
                 return true;
             }
             else{
                 return false;
             }
        }
        public function loadDeleteForm($id)
        {
            $this->db->trans_start();
            $sql = "select employeelogin.EmployeeId, employeelogin.Password, employeelogin.EmployeeNumber, employees.FirstName, employees.LastName
            from employeelogin
            inner JOIN
            employees
            on employeelogin.EmployeeId = employees.EmployeeId
            and employeelogin.EmployeeNumber = employees.EmployeeNumber
            where employeelogin.EmployeeId = ?";
            $results = $this->db->query($sql,array($id));
            $this->db->trans_complete();
            if(count($results->result()) > 0){
                return $results->result();
            }
            else{
                return false;
            }
        }
        public function deleteRecord($ajax_data)
        {
            $this->db->trans_start();
            $sql = "DELETE FROM `employeelogin` where `EmployeeId` = ?";
            $results = $this->db->query($sql,array(
                $ajax_data['id']
            ));
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
                return false;
            }
            else{
                return true;
            }
        }
 }
