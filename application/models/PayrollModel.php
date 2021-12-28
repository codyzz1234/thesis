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
            $sql = "SELECT employees.Image,employees.EmployeeId,employees.EmployeeNumber,employees.FirstName,employees.LastName,
            employeecalculation.BaseSalary,employeecalculation.SSS,employeecalculation.PagIbig,employeecalculation.PhilHealth,
            departments.Department,
            positions.Position,
            SUM(attendance.HoursWorked) as TotalHours
            from employees
            left JOIN employeecalculation
            On employees.EmployeeId = employeecalculation.EmployeeId
            left join departments
            on employees.DepartmentId = departments.DepartmentId
            left join positions
            on employees.PositionId = positions.PositionId
            left join attendance
            on attendance.EmployeeId = employees.EmployeeId
            where attendance.Date BETWEEN ? AND ? 
            GROUP by employees.EmployeeId";



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