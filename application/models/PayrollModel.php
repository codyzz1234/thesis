<?php
    class PayrollModel extends CI_Model{
        public function __construct()
        {
            parent:: __construct();
            $this->load->database();
        }
        public function fetch($startDate,$endDate)
        {
            $message = "";
            $this->db->trans_start();
            $sql = "
            select employees.EmployeeId,employees.EmployeeNumber,employees.FirstName,employees.LastName, employees.Address,employees.ContactNumber,employees.BirthDate, employees.Image,
            
            SUM(attendance.HoursWorked) as TotalHours,
            positions.Position,positions.Rate,
            
            departments.Department
            
            from employees
            left join attendance
            on employees.EmployeeId = attendance.EmployeeId
            
            left join positions
            on employees.PositionId = employees.PositionId
            
            left join departments
            on departments.DepartmentId = employees.DepartmentId
            where attendance.Date BETWEEN ? AND ?
            
            group by employees.EmployeeId";



            $results = $this->db->query($sql, 
            array($startDate,$endDate));

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
    }
?>