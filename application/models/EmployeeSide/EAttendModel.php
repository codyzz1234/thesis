<?php
    class EAttendModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetch($EmployeeId,$EmployeeNumber)
        {

            $this->db->trans_start();
            $sql = "select attendance.EmployeeNumber,employees.FirstName,employees.LastName,departments.Department,
            branches.Branch,attendance.Date, TIME_FORMAT(TimeIn, '%r') As TimeIn,
            TIME_FORMAT(TimeOut, '%r') As TimeOut, attendance.HoursWorked from attendance 
            left JOIN employees on attendance.EmployeeNumber = employees.EmployeeNumber 
            left join departments on departments.DepartmentId = employees.DepartmentId 
            left join positions on positions.PositionId = employees.PositionId 
            left join branches on branches.BranchId = employees.BranchId where attendance.EmployeeId = ?
            and attendance.EmployeeNumber = ?;
            ";
            $message = "";
            $results = $this->db->query($sql,array($EmployeeId,$EmployeeNumber));
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $message = "error";
                return $message;
            }
            else{
                if(count($results->result()) <= 0){
                    $message = "none";
                    return $message;
                }
                else{
                    return $results->result();
                }

           }
        }
    
}