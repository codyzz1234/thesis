<?php

    class PositionModel extends CI_Model{

        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetch()
        {
            $message ="";
            $this->db->trans_start();
            
            $sql = "SELECT positions.PositionId,positions.Position,positions.Description,(SELECT COUNT(employees.PositionId) from employees where employees.PositionId = positions.PositionId) as NumberOfEmployees
            from positions";

            $results = $this->db->query($sql);
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
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

        
        public function addPosition($ajax_data)
        {
            $this->db->trans_start();
            $this->db->set($ajax_data);

            $this->db->insert('positions',$ajax_data);
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            
            if($this->db->trans_status() === false){
                return false;
            }
            else{
                if($affectedRows > 0){
                    $type = 1;
                    $this->activity($ajax_data,$type);
                    return true;
                }
                else{
                    return false;        
                }
            }
        }

        public function editPosition($ajax_data,$PositionId)
        {
            $message = "";
            $this->db->trans_start();
            $this->db->where('PositionId',$PositionId);
            $this->db->update('positions',$ajax_data);
            
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

        public function deletePosition($ajax_data)
        {
            $this->db->trans_start();
            $sql = "DELETE from positions where PositionId = ? ";
            $results = $this->db->query($sql,array(
                $ajax_data['PositionId'],
            ));
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                return false;
            }
            else{
                $type = 3;
                $this->activity($ajax_data,$type);
                return true;
            }
        }
        private function activity($ajax_data,$type)
        {
            $activity = "";
            $username = $this->session->userdata('username');
			$adminId = $this->session->userdata('adminId');
            if($type == 1){
                $activity = "Added new position ".$ajax_data['Position'];
            }
            else if ($type == 2){
                $activity = "Edited position ".$ajax_data['Position']." Information";
            }
            else if ($type == 3){
                $activity = "Deleted position ".$ajax_data['Position'];
            }
            $sql = "INSERT into activitylog(AdminId,Username,Activity,Date) VALUES(?,?,?,CURRENT_DATE)";
            $this->db->query($sql,array($adminId,$username,$activity));   

        }
    }