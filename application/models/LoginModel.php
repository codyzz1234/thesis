<?php
    class LoginModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        function loginVerify($username)
        {
            $this->db->trans_start();
            $sql = "SELECT `Username`,`Password` from `adminlogin`
            where `Username` = ?";
            $results =  $this->db->query($sql,array($username));
            $this->db->trans_complete();
            /*
            foreach ($results->result_array() as $row)
            {
                    echo $row['employeeNumber'];
                    echo $row['password'];
            }
            */
            return $results;
        }
        function loginUpdate($username)
        {
            $this->db->trans_start();
            $sql = "UPDATE `adminlogin` SET `LastLogin`= CURRENT_TIMESTAMP WHERE `Username` = ?";
            $results = $this->db->query($sql,array($username));
            $this->db->trans_complete();
            return $results;

        }
    }
?>