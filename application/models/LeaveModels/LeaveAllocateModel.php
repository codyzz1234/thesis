<?php
    class LeaveAllocateModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        // Load Table

        public function fetch()
        {
            $message ="";
            $this->db->trans_start();
            $sql = "select leaveallocation.LeaveId,employees.EmployeeNumber,employees.FirstName,employees.LastName,leaveallocation.LeaveAllocated,leaveallocation.LeaveUse,leaveallocation.LeaveBalance
            from leaveallocation
            left JOIN
            employees
            On leaveallocation.EmployeeId = employees.EmployeeId
            where leaveallocation.EmployeeId = employees.EmployeeId";
            $results = $this->db->query($sql);
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

        // Load Searches
        public function loadSearches()
        {
            $message = "";
            $this->db->trans_start();
            $sql = "select employees.EmployeeId,employees.EmployeeNumber,employees.FirstName, employees.LastName, employees.Email, employees.ContactNumber,employees.Image,
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
                  $message = "failed";
            }
            else{
                if(count($results->result())> 0){
                    $message = $results->result();
                }
                else{
                    $message = "none";
                }
            }
            return $message;
        }
        public function addAllocate($ajax_data)
        {

            $this->db->trans_start();
            $sql = "INSERT into leaveallocation(EmployeeId,LeaveAllocated,LeaveBalance) values(?,?,?)";
            $results = $this->db->query($sql,array(
                $ajax_data['id'],
                $ajax_data['Allocate'],
                $ajax_data['Allocate'],
            ));
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                return false;
            }  
            else{
                if($affectedRows < 0){
                    return false;
                }
                else{
                    return true;
                }
            }
        }
    }
