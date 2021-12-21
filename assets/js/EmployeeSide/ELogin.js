
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

    $('#loginButton').click(function (e) { 
        toasterOptions();
        var EmployeeNumber = $('#EmployeeNumber').val();
        var Password = $('#PasswordField').val();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeSide/EsideLoginControl/login",
            data: {
                EmployeeNumber:EmployeeNumber,
                Password:Password,
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    toastr.success(
                        'Alert!',
                         data.message,
                        {
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
                          onHidden: function () {
                                window.location.href= baseurl + "EmployeeSide/EsideDashControl";
                            }
                        }
                      );
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
        
    });
});