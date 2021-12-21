<?php
    class DeductionModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetch()
        {
            $message = "";
            $this->db->trans_start();
            $sql = "select * from deductions";
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
        public function addRecord($ajax_data)
        {
            $this->db->trans_start();
            $this->db->insert('deductions',$ajax_data);
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE || $affectedRows < 0) {
                return false;
            } 
            else {
                return true; 
            }
        }

        public function editRecord($ajax_data,$deductionId)
        {
            $message = "";
            $this->db->trans_start();
            $this->db->where('DeductionId',$deductionId);
            $this->db->update('deductions', $ajax_data);
            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $message = "failed";
                return false;
            } 
            else {
                if($affectedRows <= 0){
                    $message = "none";
                }
                else{
                    $message = "success";
                }
            }
            return $message;

        }
    }
