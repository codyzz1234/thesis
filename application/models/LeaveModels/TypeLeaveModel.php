<?php
    class TypeleaveModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        // Load Table

        public function fetch()
        {
            $message = "";
            $this->db->trans_start();
            $results = $this->db->get('leavetype');
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
        public function add($ajax_data)
        {
            $this->db->trans_start();
            $this->db->set($ajax_data);
            $this->db->insert('leavetype',$ajax_data);
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

        public function edit($ajax_data)
        {
            $message = "";
            $this->db->trans_start();
            $sql = "UPDATE `leavetype` SET `Type`= ?,
            `Description`= ?,
            `DaysAllocated`= ?
             WHERE LeaveId = ?";
            $results = $this->db->query($sql,array(
                $ajax_data['Type'],
                $ajax_data['Description'],
                $ajax_data['DaysAllocated'],
                $ajax_data['Id'],
            ));
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $message = "failed";
            }
            else{
                if($affectedRows > 0){
                    $message = "success";
                }
                else{
                    $message = "none";
                }
            }
            return $message;
        }

        public function delete($id)
        {
            $this->db->trans_start();  
            $sql = "DELETE from leavetype where LeaveId = ?";
            $this->db->query($sql,array($id));
            $this->db->trans_complete();  
            if($this->db->trans_status() === false){
                return false;
            }
            else{
                return true;
            }
        }

}