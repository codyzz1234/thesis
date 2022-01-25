$(document).ready(function () {
    toasterOptions();
    fetch();
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
    function fetch()
    {
        $.ajax({
            type: "GET",
            url: baseurl+"BranchControl/fetch",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
                }
                else if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);

                }
                else{
                    toastr["success"]("Alert",data.message);
                    setters = data.posts;
                    console.log(setters);
                }
            }
        });

    }

});