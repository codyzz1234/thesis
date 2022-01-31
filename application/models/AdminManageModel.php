<?php
    class AdminManageModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        // Load Table
        public function loadTable()
        {
            $this->db->trans_start();
            $sql = "SELECT * from `adminlogin`";
            $results = $this->db->query($sql);
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
                return false;
            }
            else{
                if(count ($results->result()) > 0){
                    return $results->result();
                }
                else{
                    return false;
                }
            }
        }
        // Load Edit Form
        public function loadEditForm($id)
        {
            $this->db->trans_start();
            $sql = "SELECT `Username`, `Password`, `FirstName`, `LastName` from `adminlogin` where `Id` = ?";
            $results = $this->db->query($sql,array($id));
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
                return false;
            }
            else{
                if(count ($results->result()) > 0){
                    return $results->result();
                }
                else{
                    return false;
                }
            }
        }

        public function loadDeleteForm($id)
        {
            $this->db->trans_start();
            $sql = "SELECT `Username`, `Password`, `FirstName`, `LastName` from `adminlogin` where `Id` = ?";
            $results = $this->db->query($sql,array($id));
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
                return false;
            }
            else{
                if(count ($results->result()) < 0){
                    return false;
                }
                else{
                    return $results->result();
                }
            }
        }

        //CheckUserName
        public function checkUserName($id,$username)
        {
            $this->db->trans_start();
            $sql = "SELECT * from `adminlogin` where `Username` = ? and `Id` != ?";
            $results = $this->db->query($sql,array($username,$id));
            $this->db->trans_complete();
            if($this->db->trans_status() == false){
                return false;
            }
            else{
                if(count ($results->result()) > 0){
                    return false;
                }
                else{
                    return true;
                }
            }
        }
        // UPDATE ADMIN
        public function updateAdmin($ajax_data)
        {
            $this->db->trans_start();
            $sql = 	"UPDATE `adminlogin` SET 
            `UserName`= ?,`Password`= ?,
            `FirstName`= ?,`LastName`= ?
              WHERE `Id` = ?";

                $this->db->query($sql,
                array(   
                    $ajax_data['UserName'],
                    $ajax_data['Password'],
                    $ajax_data['FirstName'],
                    $ajax_data['LastName'],
                    $ajax_data['Id'],         
                ));
            if ($this->db->affected_rows() > 0) {
                $data = array('response'=>"success",'message'=>'Data Updated');
                $type = 2;
                $this->activity($ajax_data,$type);
            } 
            else {
                if ($this->db->trans_status() == FALSE) {
                    $data = array('response'=>"failed",'message'=>'Failed to update data');
                }
                else{
            
                    $data = array('response'=>"none",'message'=>'No data was changed');
                }
            }
            $this->db->trans_complete();
            return $data;
        }
        // ADD ADMIN
        public function addAdmin($ajax_data)
        {
            $this->db->trans_start();
            $sql = "INSERT INTO `adminlogin`(`Username`, `Password`, `FirstName`, `LastName`) 
            VALUES (?,?,?,?);";
            $this->db->query($sql,array(
                $ajax_data['UserName'],
                $ajax_data['Password'],
                $ajax_data['FirstName'],
                $ajax_data['LastName']
            ));
            $this->db->trans_complete();
            if ($this->db->trans_status() == FALSE) {
                return false;
            }
            else{
                $type = 1;
                $this->activity($ajax_data,$type);
                return true;
            }
    
        }
        
        public function deleteAdmin($id)
        {
            $this->db->trans_start();
            $sql = "DELETE from `adminlogin` where `Id` = ?";
            $this->db->query($sql,array($id));
            $this->db->trans_complete();
                if ($this->db->trans_status() == FALSE) {
                    return false;
                }
                else{
                    return true;
                }
        }

        private function activity($ajax_data,$type)
        {
            $username = $this->session->userdata('username');
			$adminId = $this->session->userdata('adminId');
            if($type == 1){
                $activity = "Inserted New Administrator ". '"'.$ajax_data['UserName'].'"';
            }
            if($type == 2){
                $activity = "Updated Administrator ".'"'.$ajax_data['UserName'].'"'. " Credentials";
            }

            $sql = "INSERT into activitylog(AdminId,Username,Activity,Date) VALUES(?,?,?,CURRENT_DATE)";
            $this->db->query($sql,array($adminId,$username,$activity));
        }
}

?>