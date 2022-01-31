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
            $sql = "SELECT `Username`,`Password`, Id from `adminlogin`
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
        function loginUpdate($username,$adminId)
        {
            $this->db->trans_start();
            $sql = "UPDATE `adminlogin` SET `LastLogin`= CURRENT_TIMESTAMP WHERE `Username` = ?";
            $this->db->query($sql,array($username));
            $this->activityLog($username,$adminId);

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
        private function activityLog($username,$adminId)
        {
            $activity = "Logged In";
            $sql = "INSERT into activitylog(AdminId,Username,Activity,Date) VALUES(?,?,?,CURRENT_DATE)";
            $this->db->query($sql,array($adminId,$username,$activity));

        }
    }
?>