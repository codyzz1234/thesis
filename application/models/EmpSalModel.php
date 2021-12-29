<?php

    class EmpSalModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetch()
        {
            $message = "";
            $this->db->trans_start();
            $sql = "SELECT employeecalculation.EmployeeId,employeecalculation.EmployeeNumber,employeecalculation.BaseSalary,employeecalculation.SSS,employeecalculation.PagIbig,employeecalculation.PhilHealth,
            employees.Image,employees.FirstName,employees.LastName
            from employeecalculation
            left JOIN employees
            on employeecalculation.EmployeeId = employees.EmployeeId;";
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

        public function editRecord($ajax_data)
        {
            echo "Here in edit record";

        }
}