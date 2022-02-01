<?php

    class ScheduleModel extends CI_Model{

        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetch()
        {
            $message = "";
            $this->db->trans_start();
            $sql = 'SELECT ScheduleId, time_format(TimeIn,"%r") as TimeIn, time_format(TimeOut,"%r") as TimeOut
            from schedules';
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

        public function addSchedule($ajax_data)
        {
            $this->db->trans_start();
            $this->db->set($ajax_data);

            $this->db->insert('schedules',$ajax_data);
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

        public function editSchedule($ajax_data,$schedId)
        {
            $message = "";
            $this->db->trans_start();
            $this->db->where('ScheduleId',$schedId);
            $this->db->update('schedules',$ajax_data);
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
        public function deleteSchedule($ajax_data)
        {
            $this->db->trans_start();
            $sql = "DELETE from schedules where ScheduleId = ?";
            $results = $this->db->query($sql,array(
                $ajax_data['ScheduleId'],
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
                $activity = "Added new schedule ";
                
            }
            else if ($type == 2){
                $activity = "Edited schedule ";
            }
            else if ($type == 3){
                $activity = "Deleted schedule";
            }
            $sql = "INSERT into activitylog(AdminId,Username,Activity,Date) VALUES(?,?,?,CURRENT_DATE)";
            $this->db->query($sql,array($adminId,$username,$activity));  
        }
}