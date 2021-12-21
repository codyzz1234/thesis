
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
    fetch();
    
    function fetch()
    {
        toasterOptions();
        $.ajax({
            type: "GET",
            url: baseurl+"ScheduleControl/fetch",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);
                }
                else if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
                }
                else{
                    var table;
                    setters = data.posts;
                    console.log(setters);
                    if($.fn.dataTable.isDataTable('#scheduleTable')) {
                        table = $('#scheduleTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        table = $('#scheduleTable').DataTable({
                            'destroy':true,
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
                                              columns: [ 0,1]
                                         }
                               },
    
                            ],
                            "data":data.posts,
                            columns:[
                                {"data":"TimeIn"},
                                {"data":"TimeOut"},
                                {"data":null,
                                 "render":function(data,type,row,meta){
                                    var editButton = '<a href="#" value = "'+'" class = "btn btn-outline-info editButton"><i class="fas fa-pen-square"></i></a>'
                                    var deleteButton = '<a href="#" value = "'+'" class = "btn btn-outline-danger deleteButton"><i class="fas fa-trash-alt"></i></a>'
                                    return editButton+deleteButton
                                   },
                                },
                            ],
                            columnDefs:[
                                {
    
                                },
                            ],
                        })

                    }
                }
            }
        });
    }

    function callMePlease()
    {
        alert("Hello ")
    }
    // Add Schedule
    $('#addSchedule').click(function (e) { 
        e.preventDefault();
        timepicker();
        $('#addScheduleModal').modal('show'); 
    });

  

    function timepicker()
    {
        $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 30,
            minTime: '12 AM',
            maxTime: '11 PM',
            defaultTime: '8 AM',
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    }

    
    //Change Time Add Modal
    $(".addChangeTime").click(function (e) { 
        e.preventDefault();
        $this = $(this);
        var value = $this.attr('value');
        console.log(value)
        if(value == "1"){
            // using the new format

            $('#addTimeIn').data('TimePicker').options.timeFormat = 'HH:mm';
            $('#addTimeOut').data('TimePicker').options.timeFormat = 'HH:mm';

            // reset data
            $('#addTimeIn').data('TimePicker').items = null;
            $('#addTimeOut').data('TimePicker').items = null;

            $('#addTimeIn').data('TimePicker').widget.instance = null;
            $('#addTimeOut').data('TimePicker').widget.instance = null;
            
            //change icon
            $(".addChangeTime").attr("value", "2");
            $('.addChangeIcon').attr("class","fas fa-stopwatch addChangeIcon")
         
            $('#addTimeIn').val('08:00');
            $('#addTimeOut').val('23:00');
        }
        else{
            // using the new format
            $('#addTimeIn').data('TimePicker').options.timeFormat = 'h:mm p';
            $('#addTimeOut').data('TimePicker').options.timeFormat = 'h:mm p';

            // reset data
            $('#addTimeIn').data('TimePicker').items = null;
            $('#addTimeOut').data('TimePicker').items = null;

            $('#addTimeIn').data('TimePicker').widget.instance = null;
            $('#addTimeOut').data('TimePicker').widget.instance = null;


            //change icon

            $(".addChangeTime").attr("value", "1");
            $('.addChangeIcon').attr("class","fas fa-clock addChangeIcon")

       
            $('#addTimeIn').val('8:00 AM');
            $('#addTimeOut').val('11:00 PM');


        }
        
    });

    

    $('#addRecord').click(function (e) { 
        e.preventDefault();
        toasterOptions();
        console.log($("#addTimeIn").val());
        console.log($("#addTimeOut").val());
        var formData = new FormData();
        formData.append('TimeIn',$('#addTimeIn').val())
        formData.append('TimeOut',$('#addTimeOut').val())
        $.ajax({
            type: "POST",
            url: baseurl+"ScheduleControl/addSchedule",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                if(data.response == "success"){
                    $('#addScheduleModal').modal('hide'); 
                    toastr["success"]("Alert","Record Added Successfully");
                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }   
            }
        });

        
    });

    // Edit Position
    $(document).on('click','.editButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#scheduleTable').DataTable().row(currentRow).data();
        var dataJson = {
            'ScheduleId':data['ScheduleId'],
            'TimeIn':data['TimeIn'],
            'TimeOut':data['TimeOut'],
        }
        loadEditForm(dataJson);
    });

    function loadEditForm(dataJson)
    {
        timepicker();
        $('#editSchedId').val(dataJson['ScheduleId']);
        $('#editTimeIn').val(dataJson['TimeIn']);
        $('#editTimeOut').val(dataJson['TimeOut']);
        $('#editScheduleModal').modal('show');
    }
    
    //changeTime Edit Modal
    $(".editChangeTime").click(function (e) { 
        e.preventDefault();
        $this = $(this);
        var value = $this.attr('value');
        console.log(value)
        if(value == "1"){
            // using the new format
            $('#editTimeIn').data('TimePicker').options.timeFormat = 'HH:mm';
            $('#editTimeOut').data('TimePicker').options.timeFormat = 'HH:mm';

            // reset data
            $('#editTimeIn').data('TimePicker').items = null;
            $('#editTimeOut').data('TimePicker').items = null;

            $('#editTimeIn').data('TimePicker').widget.instance = null;
            $('#editTimeOut').data('TimePicker').widget.instance = null;
            
            //change icon
            $(".editChangeTime").attr("value", "2");
            $('.editChangeIcon').attr("class","fas fa-stopwatch editChangeIcon")
         
            $('#editTimeIn').val('08:00');
            $('#editTimeOut').val('23:00');
        }
        else{
            // using the new format
            $('#editTimeIn').data('TimePicker').options.timeFormat = 'h:mm p';
            $('#editTimeOut').data('TimePicker').options.timeFormat = 'h:mm p';

            // reset data
            $('#editTimeIn').data('TimePicker').items = null;
            $('#editTimeOut').data('TimePicker').items = null;

            $('#editTimeIn').data('TimePicker').widget.instance = null;
            $('#editTimeOut').data('TimePicker').widget.instance = null;


            //change icon
            $(".editChangeTime").attr("value", "1");
            $('.editChangeIcon').attr("class","fas fa-clock editChangeIcon")

       
            $('#editTimeIn').val('8:00 AM');
            $('#editTimeOut').val('11:00 PM');

        }
        
    });

    // Edit Schedule Record 
    $('#editRecord').click(function (e) { 
        e.preventDefault();
        var formData = new FormData();
        formData.append('TimeIn',$('#editTimeIn').val());
        formData.append('TimeOut',$('#editTimeOut').val());

        formData.append('ScheduleId',$('#editSchedId').val());

        $.ajax({
            type: "POST",
            url: baseurl+"ScheduleControl/editSchedule",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);

                    fetch();
                }
                else if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
                
            }
        });

        
        
    });

    //Delete Schedule
    $(document).on('click','.deleteButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#scheduleTable').DataTable().row(currentRow).data();
        var dataJson = {
            'ScheduleId':data['ScheduleId'],
            'TimeIn':data['TimeIn'],
            'TimeOut':data['TimeOut'],
            }
        deleteModal(dataJson)
        console.log("Schedule id is "+dataJson['ScheduleId'])
    });

    function deleteModal(dataJson)
    {
        $('#delSchedId').val(dataJson['ScheduleId'])

        $('#delTimeIn').val(dataJson['TimeIn'])

        $('#delTimeOut').val(dataJson['TimeOut'])

        $('#deleteScheduleModal').modal('show'); 
    }


    $("#deleteRecord").click(function (e) { 
        e.preventDefault();
        var formData = new FormData();
        formData.append('ScheduleId',$('#delSchedId').val());
        $.ajax({
            type: "POST",
            url: baseurl+"ScheduleControl/deleteRecord",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    $('#deleteScheduleModal').modal('hide'); 
                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
        
    });



});