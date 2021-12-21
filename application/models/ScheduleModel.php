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
                return true;
            }
        }
}