<?php
    class ELoginModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }

        public function loginVerify($EmployeeNumber)
        {
            $this->db->trans_start();
            $sql = "select employeelogin.EmployeeId,employeelogin.EmployeeNumber,employeelogin.Password,employees.ScheduleId
            from employeelogin
            inner JOIN
            employees
            on employeelogin.EmployeeId = employees.EmployeeId
            and employeelogin.EmployeeNumber = employees.EmployeeNumber
            where employeelogin.EmployeeNumber = ?";
            $results =  $this->db->query($sql,array($EmployeeNumber));
            $this->db->trans_complete();
            return $results;
        }

        public function updateTime($EmployeeId,$EmployeeNumber)
        {
            $this->db->trans_start();
            $sql = "UPDATE `employeelogin`
            set `LastLogin` = CURRENT_TIMESTAMP
            Where `EmployeeNumber` = ?
            AND `EmployeeId` = ?";
            $this->db->query($sql,array($EmployeeNumber,$EmployeeId));
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affectedRows > 0){
                return true;
            }
            else{
                return false;
            }
        }

}