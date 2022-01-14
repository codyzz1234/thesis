<?php
    class CommissionModel extends CI_Model{

        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function loadSearches()
        {
            $this->db->trans_start();
            $message = "";
            $sql = "SELECT employees.EmployeeId, employees.EmployeeNumber,employees.Image, CONCAT(employees.FirstName,' ',employees.LastName) as Name
            from employees";
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
            if($ajax_data['Description'] == ""){
                $ajax_data['Description'] = null;
            }
            $this->db->insert('commissions',$ajax_data);
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

    }

?>  