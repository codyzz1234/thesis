<?php
    class LogModel extends CI_Model{

        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }

        public function fetch($startDate,$endDate)
        {
            $this->db->trans_start();
            $sql = "SELECT id, AdminId,Username, Activity, Date, TIME_FORMAT(Time,'%H:%i') as Time
            from activitylog
            WHERE Date between ? AND ?
            ORDER BY id DESC";

            $results = $this->db->query($sql,array(
                $startDate,
                $endDate
            ));
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

        public function purgeActivity($startDate,$endDate)
        {
            $this->db->trans_start();
            $sql = "DELETE from activitylog
                    WHERE Date BETWEEN ? AND ?";
                    
            $this->db->query($sql,array($startDate,$endDate));

            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();

            if($this->db->trans_status() === false){
                return false;
            }
            else{
                if($affectedRows < 0){
                    return false;
                }
                else{
                    return true;
                }
            }
            
        }
}?>