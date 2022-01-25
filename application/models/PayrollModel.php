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
            SUM(attendance.MinutesWorked) as TotalMinutes,
            SUM(attendance.OverTimeMinutes) as OverTime,
            DaysWorked.DaysWorked,
            DentalCommissions.TotalCommissions

            from employees

            LEFT JOIN 
            (
                SELECT COUNT(DISTINCT attendance.Date) as DaysWorked,attendance.EmployeeId from attendance 
                        WHERE attendance.Date between ? AND ?
                        GROUP BY attendance.EmployeeId
            )as DaysWorked on DaysWorked.EmployeeId = employees.EmployeeId

            LEFT JOIN
            (
                SELECT commissions.EmployeeId,SUM(commissions.Amount) as TotalCommissions
                   from commissions
                   where commissions.Date BETWEEN ? AND ?
                   GROUP BY commissions.EmployeeId
            ) as DentalCommissions on DentalCommissions.EmployeeId = employees.EmployeeId
            
       

            left JOIN employeecalculation
            On employees.EmployeeId = employeecalculation.EmployeeId

            left join departments
            On employees.DepartmentId = departments.DepartmentId

            left join positions
            On employees.PositionId = positions.PositionId

            left join attendance
            On attendance.EmployeeId = employees.EmployeeId
            
            left join commissions 
            On commissions.EmployeeId = employees.EmployeeId

            where attendance.Date BETWEEN ? AND ?
            GROUP by employees.EmployeeId;";



            $results = $this->db->query($sql, 
            array(
                   $startDate,
                   $endDate,

                   $startDate,
                   $endDate,

                  

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
    }
?>