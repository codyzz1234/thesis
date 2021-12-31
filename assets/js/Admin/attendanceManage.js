



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
    toasterOptions();
    initialLoad();
    setDateRangePicker();


    function initialLoad()
    {
        var date = new Date();
        var start = new Date(date.getFullYear(), date.getMonth(), 1);
        var end = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        start = moment(start).format('YYYY-MM-DD');
        end = moment(end).format('YYYY-MM-DD');
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
                    if($.fn.dataTable.isDataTable('#attendanceTable')) {
                        table = $('#attendanceTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
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
                                   extend:'copy',
                                   className: "btn btn-secondary spaceButtons",
                                   orientation : 'landscape',
                                   pageSize : 'LEGAL',
                                   exportOptions: {
                                             columns: [1,2,3,4,5,6,7]
                                        }
                               },
                               {
                                   text:'Export Table To Excel',
                                   extend:'excel',
                                   className:"btn btn-success spaceButtons",
                                   orientation : 'landscape',
                                   pageSize : 'LEGAL',
                                   exportOptions: {
                                             columns: [1,2,3,4,5,6,7]
                                        }
                               },
                               {
                                   text:'Export Table To CSV',
                                   extend:'csv',
                                   className:"btn btn-info spaceButtons",
                                   orientation : 'landscape',
                                   pageSize : 'LEGAL',
                                   exportOptions: {
                                             columns: [1,2,3,4,5,6,7]
                                        }
                                   
                               },
                               {
                                    text:'Export Table To PDF',
                                    extend:'pdf',
                                    className:"btn btn-warning spaceButtons",
                                    orientation : 'landscape',
                                    pageSize : 'LEGAL',
                                    exportOptions: {
                                              columns: [1,2,3,4,5,6,7]
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
  
    //Initialize Date Range Picker
    function setDateRangePicker()
    {
        var date = new Date();
        var start = new Date(date.getFullYear(), date.getMonth(), 1);
        var end = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        $('#dateRangePicker').val(date);
        $('#dateRangePicker').daterangepicker({
            startDate:start,
            endDate:end,
            "applyButtonClasses": "btn-success",
            "cancelClass": "btn-danger",
            locale: {
                cancelLabel: 'Clear'
            }
        });
    }

    $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
        var startDate = picker.startDate.format('YYYY-MM-DD');
        var endDate =  picker.endDate.format('YYYY-MM-DD');
 
        fetch(startDate,endDate)
    });
    // when Clear/Cancel button is hit
    $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    //Same as apply.
    $('#applyDate').on('click', function (e,picker) {
        e.preventDefault();
        alert("Hello world");
        var start = $('#dateRangePicker').data('daterangepicker').startDate;
        var end =  $('#dateRangePicker').data('daterangepicker').endDate;
        start = moment(start).format('YYYY-MM-DD');
        end = moment(end).format('YYYY-MM-DD');
        fetch(start,end);
        
    });




});