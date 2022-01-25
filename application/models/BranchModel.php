<?php
    class BranchModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetch()
        {
            $this->db->trans_start();
            $message = "";
            $sql = "SELECT branches.BranchId,branches.Branch,
            (SELECT COUNT(employees.BranchId) from employees where employees.BranchId = branches.BranchId) as NumEmp,branches.Address
            from branches
            ORDER BY branches.BranchId";
            
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
            $this->db->set($ajax_data);
            $this->db->insert('branches',$ajax_data);

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

        public function editRecord($ajax_data)
        {
            $message = "";
            $this->db->trans_start();
            $this->db->where('BranchId',$ajax_data['BranchId']);
            $this->db->update('branches',$ajax_data);
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

        public function deleteRecord($ajax_data)
        {
            $this->db->trans_start();
            $sql = "DELETE from branches
                    WHERE BranchId = ?";

            $results = $this->db->query($sql,array(
                $ajax_data['BranchId']
            ));

            $affectedRows = $this->db->affected_rows();
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                return false;
            }
            else{
                if($affectedRows <= 0){
                    return false;
                }
                else{
                    return true;
                }
            }
        }

    }
?>