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
            $sql = "select COUNT(employees.EmployeeId)
            from employees";
            $result = $this->db->query($sql);
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
                
            }
            else{

            }
        }
}

?>