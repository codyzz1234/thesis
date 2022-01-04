<?php
    class AttendanceModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetch($start,$end)
        {
            $message = "";
            $this->db->trans_start();
            $sql = "SELECT attendance.AttendanceId,attendance.EmployeeNumber,attendance.TimeIn,attendance.TimeOut,attendance.HoursWorked,attendance.Date,attendance.TimeInStatus,attendance.TimeOutStatus,attendance.OverTimeHours,employees.FirstName,employees.LastName,employees.Image, departments.Department, positions.Position from attendance 
            left JOIN employees on attendance.EmployeeId = employees.EmployeeId 
            left join departments on employees.DepartmentId = departments.DepartmentId 
            left join positions on employees.PositionId = positions.PositionId
            WHERE attendance.Date BETWEEN ? AND ?";
            $results = $this->db->query($sql,array($start,$end));
            
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
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
        
}

?>