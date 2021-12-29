$(document).ready(function () {
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
        toasterOptions();
        $.ajax({
            type:"GET",
            url: baseurl+"EmployeeSalaryControl/fetch",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    var setters = data.posts;
                    console.log(setters);
                }
                else if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
                    console.log("no records");
                }
                else if (data.resposne == "failed"){
                    toastr["error"]("Alert",data.message);
                    console.log("Failed to retrieve");
                }
                
            }
        });
    }






    $('#editRecord').click(function (e) { 
        e.preventDefault();
    
        let formData = new FormData($('#editSalaryForm')[0]);
        for(var pair of formData.entries()){
            console.log("Key is: " +pair[0]+', Value is: '+pair[1]);
        }
       
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeSalaryControl/editSalary",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                
                if(data.response == "success"){
                    fetch();
                  
                }
                else{
                    toastr["error"]("Alert",data.message);
                }   
                
            }
        });
        
    });
});