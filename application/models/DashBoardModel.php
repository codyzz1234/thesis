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
            $sql = "SELECT COUNT(employees.EmployeeId) as TotalEmployees
            from employees";

            $numEmployees = $this->db->query($sql);
            foreach($numEmployees->result_array() as $row){
                $numEmployees = $row['TotalEmployees'];
            }

            $sql = "SELECT COUNT(DISTINCT attendance.EmployeeId) AS PresentEmployees
            from attendance
            where (attendance.TimeInStatus = 1 OR attendance.TimeInStatus = 2) AND attendance.Date = CURRENT_DATE();";
            $presentEmployees = $this->db->query($sql);
            foreach($presentEmployees->result_array() as $row){
                $presentEmployees = $row['PresentEmployees'];
            }

            $sql = "SELECT COUNT(DISTINCT attendance.EmployeeId) AS LateEmployees
            from attendance
            where attendance.TimeInStatus = 2 AND attendance.Date = CURRENT_DATE()";
            $lateEmployees = $this->db->query($sql);
            foreach($lateEmployees->result_array() as $row){
                $lateEmployees = $row['LateEmployees'];
            }

            $this->db->trans_complete();

            $dataArray = array(
                'TotalEmployees' => $numEmployees,
                'PresentEmployees' => $presentEmployees,
                'LateEmployees' => $lateEmployees
            );


            if($this->db->trans_status() == false){
                return false;
            }
            else{
                return $dataArray;
            }
        }
}

?>