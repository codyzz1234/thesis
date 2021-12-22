<?php
    class DashBoardModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetchAllEmployees()
        {
            $this->db->trans_start();
            $sql = "select COUNT(EmployeeId) as TotalEmployees
            from employees";
            $numEmployees = $this->db->query($sql);
            $sql = "select COUNT(attendance.AttendanceId) as "
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
                return false;
            }
            else{
                return $result;
            }
        }
}

?>