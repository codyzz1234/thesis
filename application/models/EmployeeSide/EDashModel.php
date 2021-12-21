<?php
    class EDashModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        
        public function timeInOut($EmployeeId,$EmployeeNumber)
        {
            $this->db->trans_start();
            $sql = "SELECT * from attendance 
            WHERE `EmployeeId` = ?
            AND `EmployeeNumber` = ?
            AND `TimeOut` IS NULL";
            $results = $this->db->query($sql,array($EmployeeId,$EmployeeNumber));
            $rowCount = count($results->result());
            $message = "";
            if($rowCount <= 0){
                $sql = "INSERT into `attendance`(`EmployeeId`,`EmployeeNumber`,`Date`,`TimeIn`) VALUES(?,?,CURDATE(),CURRENT_TIMESTAMP)";
                $results = $this->db->query($sql,array($EmployeeId,$EmployeeNumber));
                $message = "In";
            }
            else{
                $sql = "UPDATE attendance set TimeOut = CURRENT_TIMESTAMP,
                HoursWorked = TIMESTAMPDIFF(HOUR,TimeIn,TimeOut)
                WHERE EmployeeId = ?
                AND EmployeeNumber = ?
                AND TimeOut IS NULL";
                $results = $this->db->query($sql,array($EmployeeId,$EmployeeNumber));
                $message = "Out";
            }
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
                return false;
            }
            else{
                return $message;
            }
        }
}