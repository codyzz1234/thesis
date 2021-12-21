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
                $ajax_data['positionId'],
            ));
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                return false;
            }
            else{
                return true;
            }
        }
    }