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

        public function addRecord($ajax_data,$empNumber)
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
                    $type = 1;
                    $this->activity($empNumber,$type);
                    return true;
                }
                else{
                    return false;
                }
            }

        }

        public function fetch($startDate,$endDate)
        {
            $this->db->trans_start();
            $sql = "SELECT commissions.CommissionId,commissions.EmployeeId,DATE_FORMAT(commissions.Date,'%m/%d/%Y') as Date,commissions.Description,commissions.Amount,employees.FirstName,employees.LastName,employees.Image,employees.EmployeeNumber
            from commissions
            inner join employees
            on commissions.EmployeeId = employees.EmployeeId
            WHERE commissions.Date between ? AND ?";
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

        public function editRecord($ajax_data,$empNumber)
        {
            $message = "";
            $this->db->trans_start();
            if($ajax_data['Description'] == ""){
                $ajax_data['Description'] = null;
            }
            $this->db->where('CommissionId',$ajax_data['CommissionId']);
            $this->db->update('commissions',$ajax_data);
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
                    $this->activity($empNumber,$type);
                    $message = "success";
                }
            }
            return $message;
        }

        public function deleteRecord($commissionId,$empNumber)
        {
            $this->db->trans_start();
            $sql = "DELETE from commissions
                    WHERE CommissionId = ?";
            $this->db->query($sql,array($commissionId));
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
                    $type = 3;
                    $this->activity($empNumber,$type);
                    return true;
                }
            }
        }
        private function activity($empNumber,$type)
        {
            $activity = "";
            $username = $this->session->userdata('username');
			$adminId = $this->session->userdata('adminId');
            if($type == 1){
                $activity = "Added new Commission for employee ".$empNumber;
            }
            else if($type == 2){
                $activity = "Edited commission of employee ".$empNumber;
            }
            else if ($type == 3){
                $activity = "Deleted commission of employee ".$empNumber;

            }
            $sql = "INSERT into activitylog(AdminId,Username,Activity,Date) VALUES(?,?,?,CURRENT_DATE)";
            $this->db->query($sql,array($adminId,$username,$activity));
    
        }


    }
   
?>  