


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
    $('#loginForm').submit(function (e) { 
        e.preventDefault();
        toasterOptions();
        var username =  $('#UsernameField').val();
        var password =  $('#PasswordField').val();
        $.ajax({
            type: "POST",
            url: baseurl +"LoginController/login",
            data: {
                username:username,
                password:password,
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);
                }

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
                                window.location.href= baseurl + "DashBoard";
                            }
                        }
                      );
                }
            }
        });
    });

    $(document).on('click','#showPass', function () {
        if($("#PasswordField").attr('type') == "password"){
            $("#PasswordField").attr('type','text')
            $("#showPassIcon").attr('class','fas fa-eye-slash');
        }
        else{
            $("#PasswordField").attr('type','password')
            $("#showPassIcon").attr('class','fas fa-eye');
    
        }
        
    });
});
