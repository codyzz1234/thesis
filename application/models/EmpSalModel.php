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
            $sql = "SELECT employeecalculation.EmployeeId,employeecalculation.EmployeeNumber,employeecalculation.BaseSalary,employeecalculation.SSS,employeecalculation.PagIbig,employeecalculation.PhilHealth,employeecalculation.CashAdvance,
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
            $message = "";
            $this->db->trans_start();
            $this->db->where('EmployeeId',$ajax_data['EmployeeId']);
            $this->db->update('employeecalculation',$ajax_data);
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $message = "failed";
            }
            else{
                if($affectedRows <= 0){
                    $message = "none";
                }
                else{
                    $type = 2;
                    $this->activity($ajax_data,$type);
                    $message = "success";
                }
            }
            return $message;
        }
        private function activity($ajax_data,$type)
        {
            $activity = "";
            $username = $this->session->userdata('username');
			$adminId = $this->session->userdata('adminId');
            if($type == 2){
                $activity = "Updated Employee Salary Of ".$ajax_data['EmployeeNumber'];
            }
            $sql = "INSERT into activitylog(AdminId,Username,Activity,Date) VALUES(?,?,?,CURRENT_DATE)";
            $this->db->query($sql,array($adminId,$username,$activity));   
        }
}