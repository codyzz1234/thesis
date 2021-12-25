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
            $sql = "select employees.EmployeeId as TotalEmployees
            from employees";
            $numEmployees = $this->db->query($sql);
            $numEmployees = $numEmployees->num_rows();

            $sql = "select DISTINCT attendance.EmployeeId
            from attendance
            where (attendance.TimeInStatus = 1 OR attendance.TimeInStatus = 2) AND attendance.Date = CURRENT_DATE();";
            
            $presentEmployees = $this->db->query($sql);
            $presentEmployees = $presentEmployees->num_rows();

            $this->db->trans_complete();

            $dataArray = array(
                'TotalEmployees' => $numEmployees,
                'PresentEmployees' => $presentEmployees
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