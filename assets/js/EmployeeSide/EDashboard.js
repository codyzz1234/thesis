function toasterOptions()
{
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-center-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
    "preventDuplicates":true,
    }
}




$(document).ready(function () {
    $('#clockIn').click(function (e) { 
        toasterOptions();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeSide/EsideDashControl/timeInOut",
            data: {
                EmployeeId:EmployeeId,
                EmployeeNumber:EmployeeNumber,
                ScheduleId:ScheduleId // this is from view, same as baseurl
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);

                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    
    });
});