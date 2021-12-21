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
        type: "POST",
        url: baseurl+"EmployeeSide/EsideAttendControl/fetch",
        data:{
            EmployeeId:EmployeeId,
            EmployeeNumber:EmployeeNumber,
        },
        dataType: "JSON",
        success: function (data) {
            if(data.response == "failed"){
                toastr["error"]("Alert",data.message);
            }
            else if(data.response == "none"){
                toastr["info"]("Alert",data.message);
            }

            else{
                setters = data.posts;
                console.log(setters);
                $('#attendanceHistory').DataTable({
                    "destroy":true,
                     responsive:true,
                     dom: //'Blfrtip', // if you remove this line you will see the show entries dropdown
                     'B'+
                     "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>"+
                      "rtip",
                      buttons:[
                        {
                            text:'Copy Table to Clipboard',
                            className: "copy spaceButtons",
                            extend:'copy',
                        },
                        {
                            text:'Export Table To Excel',
                            extend:'excel',
                            className:"excel spaceButtons"
                        },
                        {
                            text:'Export Table To CSV',
                            extend:'csv',
                            className:"csv spaceButtons"
                        },
                    
                        {
                             text:'Export Table To PDF',
                             extend:'pdf',
                             className:"pdf spaceButtons",
                             orientation : 'landscape',
                             pageSize : 'LEGAL',
                             exportOptions: {
                                       columns: [ 0,1,2,3,4,5,6,7]
                                  }
                        },

                      ],
                      "data":data.posts,
                      columns:[
                          {"data":"EmployeeNumber"},
                          {"data":"FirstName"},
                          {"data":"LastName"},
                          {"data":"Department"},
                          {"data":"Branch"},
                          {"data":"Date"},
                          {"data":"TimeIn"},
                          {"data":"TimeOut"},
                          {"data":"HoursWorked"},

                      ]
                })
            }
        }
    });
}

$(document).ready(function () {
    fetch();

});