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
                $message = "out";
            }
            else{
                if($this->db->trans_status() == false){
                    $message = false;
                }
                else{
                    $message = true;
               }
            }
            return $message;
        }
        
        public function recordTimeIn($EmployeeId,$EmployeeNumber,$timeIn,$timeOut)
        {
            
            $sql = "SELECT TimeInStatus,Date from attendance
                    WHERE DATE = CURRENT_DATE
                    AND EmployeeId = ?
                    AND EmployeeNumber = ?";

            $results = $this->db->query($sql,array($EmployeeId,$EmployeeNumber));
            $rowCount = count($results->result());
            if($rowCount > 0){

            }
            else{
                
            }
                    
            if ( (time()< strtotime($timeIn)+1860 && time() >= strtotime($timeIn)) && (time() < strtotime($timeOut)) ){ // 30 mins grace period
                $status = 1; // on time status
            }
            else if( (time()<= strtotime($timeIn)) && (time() < strtotime($timeOut)) ){
                $status = 2; // Early Status
            }
            else if( (time() > strtotime($timeIn)+1860) && (time() < strtotime($timeOut)) ){
                $status = 3; //Late Status;
            }
            else{
                return;
            }
            $sql = "INSERT into `attendance`(`EmployeeId`,`EmployeeNumber`,`TimeInStatus`,`Date`,`TimeIn`) VALUES(?,?,?,CURDATE(),CURRENT_TIMESTAMP)";
            $this->db->query($sql,array($EmployeeId,$EmployeeNumber,$status));
        }

        public function recordTimeOut($EmployeeId,$EmployeeNumber,$timeIn,$timeOut)
        {
            $timeIn = strtotime($timeIn);
           
            
            $sql = "UPDATE attendance 
            SET TimeOut = CURRENT_TIMESTAMP,
                HoursWorked = CASE
                                WHEN (TIMESTAMPDIFF(HOUR,FROM_UNIXTIME(?),CURRENT_TIMESTAMP) - 1)  < 0
                                    THEN 0
                                
                                WHEN (TIMESTAMPDIFF(HOUR,TimeIn,CURRENT_TIMESTAMP) - 1)  < 0
                                    THEN 0

                                WHEN (TimeInStatus = 1 OR TimeInStatus = 2) 
                                     THEN TIMESTAMPDIFF(HOUR,FROM_UNIXTIME(?),CURRENT_TIMESTAMP) - 1

                                ELSE
                                     TIMESTAMPDIFF(HOUR,TimeIn,CURRENT_TIMESTAMP) - 1
                              END
                ,OverTimeHours  = CASE
                                    WHEN (TimeInStatus = 1 OR TimeInStatus = 2) AND ((TIMESTAMPDIFF (HOUR,FROM_UNIXTIME(?),CURRENT_TIMESTAMP) - 1) > 8)
                                        THEN (TIMESTAMPDIFF(HOUR,FROM_UNIXTIME(?),CURRENT_TIMESTAMP) - 1) - 8

                                    WHEN (TimeInStatus = 3)  AND ((TIMESTAMPDIFF (HOUR,TimeIn,CURRENT_TIMESTAMP) - 1) > 8)
                                        THEN (TIMESTAMPDIFF(HOUR,TimeIn,CURRENT_TIMESTAMP) - 1) - 8

                                    ELSE
                                       0
                                 END
            Where EmployeeId = ?
            AND EmployeeNumber = ?
            AND TimeOut IS NULL";
     


            $this->db->query($sql,array(
                $timeIn,
                $timeIn,
                $timeIn,
                $timeIn,
                $EmployeeId,
                $EmployeeNumber,
            ));
            $message = "Out";

        }

}