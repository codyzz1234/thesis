



$(document).ready(function () {

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
        "timeOut": "1000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "preventDuplicates":true,
        }
    }
    
    fetch();
    function fetch()
    {
        toasterOptions();
        $.ajax({
            type: "POST",
            url: baseurl+"LeaveControllers/TypeLeaveControl/fetch",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    var table;
                    setters = data.posts;
                    console.log(setters);
                    if($.fn.dataTable.isDataTable('#typeLeaveTable')) {
                        table = $('#typeLeaveTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                        console.log("Drew it");
                    }
                    else{
                           console.log("Generate it");
                           table = $('#typeLeaveTable').DataTable({
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
                                                columns: [ 0,1,2,3,4,5,6,7,8,9]
                                            }
                                },
        
                                ],
                                "data":data.posts,
                                columns:[
                                    {"data":"Type"},
                                    {"data":"Description"},
                                    {"data":"DaysAllocated"},
        
                                    {"data":null,
                                    "render":function(data,type,row,meta){
                                        var editButton = '<a href="#" value = "'+'" class = "btn btn-outline-info editButton"><i class="fas fa-pen-square"></i></a>'
                                        var deleteButton = '<a href="#" value = "'+'" class = "btn btn-outline-danger deleteButton"><i class="fas fa-trash-alt"></i></a>'
                                        return editButton+deleteButton
                                    },
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



    // Add Type Of Leave
    $('#addLeaveType').click(function (e) { 
            e.preventDefault();
            $('#addLeaveModal').modal('show');
            
        });

    $('#addRecord').click(function (e) { 
        e.preventDefault();
        toasterOptions();
        var formData = new FormData();
        formData.append('LeaveType',$('#addType').val())
        formData.append('Description',$('#addDesc').val())
        formData.append('Days',$('#addDays').val())

        $.ajax({
            type: "POST",
            url: baseurl+"LeaveControllers/TypeLeaveControl/addLeaveType",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
              }
            });
        });

    //Edit Leave
    $(document).on('click','.editButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#typeLeaveTable').DataTable().row(currentRow).data();
        var dataJson = {
            'LeaveId':data['LeaveId'],
            'Type':data['Type'],
            'Description':data['Description'],
            'Days':data['DaysAllocated'],
        }
        loadEditForm(dataJson)
    });

    function loadEditForm(dataJson)
    {
        $('#editId').val(dataJson['LeaveId'])
        $('#editType').val(dataJson['Type'])
        $('#editDesc').val(dataJson['Description'])
        $('#editDays').val(dataJson['Days'])
        $('#editLeaveModal').modal('show')
    }

    $('#editRecord').click(function (e) { 
        var formData = new FormData();
        formData.append('LeaveId', $('#editId').val())
        formData.append('Type', $('#editType').val())
        formData.append('Description', $('#editDesc').val())
        formData.append('Days', $('#editDays').val())

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: baseurl + "LeaveControllers/TypeLeaveControl/editLeaveType",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
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

    //Delete Leave
    $(document).on('click','.deleteButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#typeLeaveTable').DataTable().row(currentRow).data();
        var dataJson = {
            'LeaveId':data['LeaveId'],
            'Type':data['Type'],
            'Description':data['Description'],
            'Days':data['DaysAllocated'],
        }
        loadDeleteForm(dataJson)
    });
    function loadDeleteForm(dataJson)
    {
        $('#deleteId').val(dataJson['LeaveId'])
        $('#deleteType').val(dataJson['Type'])
        $('#deleteDescription').val(dataJson['Description'])
        $('#deleteDays').val(dataJson['Days'])
        $('#deleteLeaveModal').modal('show')

    }
    $('#deleteRecord').click(function (e) { 
        e.preventDefault();
        var LeaveId =  $('#deleteId').val();
        
        $.ajax({
            type: "POST",
            url: baseurl + "LeaveControllers/TypeLeaveControl/deleteLeaveType",
            data:{
                LeaveId:LeaveId
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    $('#deleteLeaveModal').modal('hide')
                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
        
    });
    

});