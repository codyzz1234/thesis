<?php
    class ERFIDAttendModel extends CI_Model{
        
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }

        public function attendance($rfid)
        {
            
            $message = "";
            $this->db->trans_start();
            $sql = "select employees.EmployeeId,employees.EmployeeNumber, 
            employees.FirstName,employees.LastName,departments.Department,positions.Position,
            TIME_FORMAT(schedules.TimeIn,'%r') as TimeIn,
             TIME_FORMAT(schedules.TimeOut, '%r') as TimeOut ,CURRENT_TIME as Timestamp, 
             employees.Image from employees 
             inner JOIN departments on departments.DepartmentId = employees.DepartmentId 
             inner JOIN positions on positions.PositionId = employees.PositionId
              inner join schedules on schedules.ScheduleId = employees.ScheduleId 
              where employees.RFID = ?;";
            $results = $this->db->query($sql,array($rfid));
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $message = false;
            } 
            else{
                $resultCount = count($results->result());
                if($resultCount <= 0){
                    $message = "none";
                }
                else{
                    $message = $results->result();
                }
            }
            return $message;
        }

        public function timeInOut($EmployeeId,$EmployeeNumber,$position,$timeIn,$timeOut)
        {
            date_default_timezone_set('Asia/Singapore');
            $this->db->trans_start();
            $sql = "SELECT * from attendance 
            WHERE `EmployeeId` = ?
            AND `EmployeeNumber` = ?
            AND `TimeOut` IS NULL";
            $results = $this->db->query($sql,array($EmployeeId,$EmployeeNumber));
            $rowCount = count($results->result());
            $message = "";
            if($rowCount <= 0){
                $this->recordTimeIn($EmployeeId,$EmployeeNumber,$timeIn,$timeOut);
            }
            else{
                $this->recordTimeOut($EmployeeId,$EmployeeNumber,$timeIn,$timeOut);
            
            }
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($affectedRows <= 0){
                return false;
            }
            else{
                if($this->db->trans_status() == false){
                    return false;
                }
                else{
                    return true;
                }
            }
        }
        
        public function recordTimeIn($EmployeeId,$EmployeeNumber,$timeIn,$timeOut)
        {
            if (time()<= strtotime($timeIn)+1860 ){ // 30 mins grace period
                $status = 1; // on time status
            }
            else{
                $status = 2; // Late time in status
            }
            $sql = "INSERT into `attendance`(`EmployeeId`,`EmployeeNumber`,`TimeInStatus`,`Date`,`TimeIn`) VALUES(?,?,?,CURDATE(),CURRENT_TIMESTAMP)";
            $this->db->query($sql,array($EmployeeId,$EmployeeNumber,$status));
        }

        public function recordTimeOut($EmployeeId,$EmployeeNumber,$timeIn,$timeOut)
        {
            $sql = "UPDATE attendance set TimeOut = CURRENT_TIMESTAMP,
            HoursWorked = TIMESTAMPDIFF(HOUR,TimeIn,TimeOut)
            WHERE EmployeeId = ?
            AND EmployeeNumber = ?
            AND TimeOut IS NULL";
            $this->db->query($sql,array($EmployeeId,$EmployeeNumber));
            $message = "Out";

        }

}