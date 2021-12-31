



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
    initialLoad();
    function initialLoad()
    {
        var date = new Date();
        var start = new Date(date.getFullYear(), date.getMonth(), 1);
        var end = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        start = moment(start).format('YYYY-MM-DD');
        end = moment(end).format('YYYY-MM-DD');
        console.log("Start is " + start);
        console.log("ENd is : " + end);
        fetch(start,end)
        
    }



    function fetch(start,end)
    {
        toasterOptions();
        $.ajax({
            type: "POST",
            url: baseurl+"AttendanceControl/fetch",
            data:{
                StartDate:start,
                EndDate:end,
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    var table;
                    setters = data.posts;
                    console.log(setters)
                    if($.fn.dataTable.isDataTable('#attendanceTable')) {
                        table = $('#attendanceTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                        console.log("Drew it");
                    }
                    else{
                        console.log("Generate It");
                        table = $('#attendanceTable').DataTable({
                            "destroy": true,
                            responsive:true,
                            dom: //'Blfrtip', // if you remove this line you will see the show entries dropdown
                            'B'+
                            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>"+
                             "rtip",
                            buttons: [
                               // 'copy', 'csv', 'excel', 'pdf', 'print',
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
                                              columns: [ 0,1,2,3,4,5,6,7,8,9]
                                         }
                               },
    
                            ],
                            "data":data.posts,
                            columns:[
                                {"data":"Image",
                                 "render":function(data,type,row,meta){ 
                                    return '<img src="'+data+'"alt="Error load" class="img-fluid"></img>'         
                                  },
                                },
                                {"data":"EmployeeNumber"},
                                {"data":"FirstName"},
                                {"data":"LastName"},
                                {"data":"Date"},
                                {"data":null,
                                    "render":function(data,type,row,meta){
                                        render = data.TimeIn+ " ";
                                        if(data.TimeInStatus == "1"){
                                            render = render + '<span class="badge badge-success pull-right">  On Time</span>'
                                        }
                                        else if (data.TimeInStatus == "2"){
                                            render = render + '<span class="badge badge-warning pull-right">  Late</span>';
                                        }
                                        return render;
                                    },
                                },
                                
                                {"data":"TimeOut"},
                                {"data":null,
                                  "render":function(data,type,row,meta){
                                        var hoursWorked = data.HoursWorked;
                                        var timeOut = data.TimeOut;
                                        console.log("Hours Worked is: ")
                                        if(hoursWorked == 0 && timeOut == null){ 
                                            return " "
                                        }
                                        else{
                                            return hoursWorked
                                        }
                                  },
                                },
                                {"data":null,
                                    "render":function(data,type,row,meta){
                                        var editButton = '<a href="#" value = "'+'" class = "btn btn-outline-info editButton"><i class="fas fa-pen-square"></i></a>'
                                        var deleteButton = '<a href="#" value = "'+'" class = "btn btn-outline-danger deleteButton"><i class="fas fa-trash-alt"></i></a>'
                                        return editButton+deleteButton
                                    },
                                },
                            ],
    
                            columnDefs: [
                                { 
                                  "targets": 0,
                                  "width":"3%",
                                },
                            ],
                        })
                    }
                }
                else if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    }

    //Edit Attendance
    $(document).on('click','.editButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#attendanceTable').DataTable().row(currentRow).data();
        var dataJson = {
            'AttendanceId':data['AttendanceId'],
            }
        console.log(data['AttendanceId']);
    });

    //delete Attendance

    $(document).on('click','.deleteButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#attendanceTable').DataTable().row(currentRow).data();
        var dataJson = {
            'AttendanceId':data['AttendanceId'],
        }
        deleteAttendance(dataJason);

    });
    function deleteAttendance(dataJason)
    {
        
    }
});