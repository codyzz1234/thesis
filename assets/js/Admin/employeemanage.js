
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


$(document).ready(function() {
    // Fetch Records
    loadSelectors();
    fetch();
    function fetch()
    {
        toasterOptions();

        $.ajax({
            type: "POST",
            url: baseurl + "EmployeeManageController/loadRecords",
            cache: false,
            data: "data",
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    var table;
                    setters = data.posts;
                    console.log(setters)
                    if($.fn.dataTable.isDataTable('#employeeRecords')) {
                        table = $('#employeeRecords').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        table = $('#employeeRecords').DataTable({
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
                                   className: "btn btn-secondary spaceButtons",
                                   extend:'copy',
                               },
                               {
                                   text:'Export Table To Excel',
                                   extend:'excel',
                                   className:"btn btn-success spaceButtons"
                               },
                               {
                                   text:'Export Table To CSV',
                                   extend:'csv',
                                   className:"btn btn-info spaceButtons"
                               },
                               
                               {
                                    text:'Export Table To PDF',
                                    extend:'pdf',
                                    className:"btn btn-warning spaceButtons",
                                    orientation : 'landscape',
                                    pageSize : 'LEGAL',
                                    exportOptions: {
                                              columns: [ 0,1,2,3,4,5,6,7,8,9]
                                         }
                               },
    
                            ],
    
                            "data":data.posts,
                            columns:[
                                {
                                    "data": "Image",
                                    "render": function ( data, type, row, meta ) {
                                        return '<img src="'+baseurl+data+"?time"+new Date().getTime()+'"alt="Error load" class="img-fluid"></img>'                     
                                        }
                                },
                                {"data":"EmployeeNumber"},
                                {"data":"FirstName"},
                                {"data": "LastName"},
                                {
                                    "data": "ContactNumber",
                                     width: "5%"
                                },
                                {"data": "Department",
                                 "render":function(data,type,row,meta){
                                     var a;
                                     if(data == null){
                                        a = "Employee Has No Department";
                                     }
                                     else{
                                        a = data;
                                    }
                                    return a;
                                 },
                                },
                                {"data": "Branch"},
                                {"data": "Position"},

                                {
                                    "data": "TimeIn",
                                     width:"8%"
                                },

                                {
                                    "data": "TimeOut",
                                     width:"8%"

                                },

                                {
                                    "data": "StatusId",
                                    render: function (data,type,row,meta){
                                     let render = "";
                                     console.log(row.Status + " Is");
                                     if(data == 1){
                                        render = render + '<span class="badge badge-success pull-right">'+ row.Status+ '</span>'
                                     }
                                     else if(data == 2){
                                        render = render + '<span class="badge badge-warning pull-right">'+ row.Status+'</span>';
                                     }
                                     else if(data == 5){
                                        render = render + '<span class="badge badge-info pull-right">'+ row.Status+'</span>';

                                     }
                                     return render;
                                
                                    }

                                },
                               
                                {"data":"EmployeeId",
                                "render": function ( data, type, row, meta ) {
                                    var editButton = '<a href="#" value = "'+data+'" class = "btn btn-outline-info editButton"><i class="fas fa-pen-square"></i></a>'
                                    var deleteButton = '<a href="#" value = "'+data+'" class = "btn btn-outline-danger deleteButton"><i class="fas fa-trash-alt"></i></a>'
                                    return editButton+deleteButton
                                    }
                                 },
                                
                            ],
                            columnDefs: [
                                { "targets": 0,
                                  "width":"6%",
                                },
                                {
                                  "targets":10,
                                  "width":"8%",
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


    // Edit Employee
    $(document).on('click','tbody .editButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var employeeId = $this.attr('value');
        editEmployee(employeeId);
        
    });


    function editEmployee(employeeId)
    {
        $("#editBirthDate").datepicker();
        toasterOptions();
        $.ajax({
            type: "POST",
            url: baseurl + "EmployeeManageController/loadEditForm",
            data:{
                employeeId:employeeId
            },
            dataType:"JSON",
            success: function (data) {
                if(data.response == "success"){
                        setters = data.posts;
                        $('#editEmployeeId').val(setters[0].EmployeeId);

                        $('#editEmployeeNumber').val(setters[0].EmployeeNumber);

                        $('#editFirstName').val(setters[0].FirstName);

                        $('#editLastName').val(setters[0].LastName);



                        $('#editAddress').val(setters[0].Address);

                        $('#editContactNumber').val(setters[0].ContactNumber);

                        $('#editRFID').val(setters[0].RFID);

                        $('#editBirthDate').val(setters[0].BirthDate);


                        $('#editDepartmentSelector').val(setters[0].DepartmentId);

                        $('#editPositionSelector').val(setters[0].PositionId);

                        $('#editScheduleSelector').val(setters[0].ScheduleId);

                        $('#editBranchSelector').val(setters[0].BranchId);

                        $("#editPreview").attr("src",baseurl+setters[0].Image+"?time"+new Date().getTime());


        
                        $("#editImage").val("");


    

                     }        
            }
        });
        $('#editEmployeeModal').modal('show'); 
    }

  $('#updateRecords').click(function (e) { 
    e.preventDefault();
    
    var BranchId = $('#editBranchSelector').val();
    var DepartmentId = $('#editDepartmentSelector').val();
    var PositionId =$('#editPositionSelector').val();
    var ScheduleId = $('#editScheduleSelector').val();
    var FirstName = $('#editFirstName').val();
    var LastName = $('#editLastName').val();
    var BirthDate = $('#editBirthDate').val();
    var Address = $('#editAddress').val();
    var ContactNumber = $('#editContactNumber').val();
    var RFID = $('#editRFID').val();
    var EmployeeId = $('#editEmployeeId').val();
    var Image = $('#editImage')[0].files[0];
    var EmployeeNumber = $('#editEmployeeNumber').val();



    var formData = new FormData();
    formData.append('EmployeeId',EmployeeId);
    formData.append('FirstName',FirstName);
    formData.append('LastName',LastName);
    formData.append('BirthDate',BirthDate);
    formData.append('Address',Address);
    formData.append('ContactNumber',ContactNumber);
    formData.append('DepartmentId',DepartmentId);
    formData.append('PositionId',PositionId);
    formData.append('BranchId',BranchId);
    formData.append('ScheduleId',ScheduleId);
    formData.append('RFID',RFID);
    formData.append('Image',Image);
    formData.append('EmployeeNumber',EmployeeNumber);

      $.ajax({
          type: "POST",
          url: baseurl+"EmployeeManageController/updateRecords",
          data: formData,
          dataType: "JSON",
          contentType: false, 
          processData: false,
          success: function (data) {
              if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);
              }
              else if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
              }
              else {
                toastr["success"]("Alert",data.message);
                fetch();
              }
          }
      });
      
  });
  
$('#editImage').change(function (e) { 
    e.preventDefault();
    var output = document.getElementById('editPreview');
    output.src = URL.createObjectURL(e.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }

});


    //Delete Record

    $(document).on('click','tbody .deleteButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var id = $this.attr("value");
        loadDeleteForm(id);
    });

    function loadDeleteForm(id)
    {
        toasterOptions();
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeManageController/loadDeleteForm",
            data:{
                id:id
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                        setters = data.posts;
                        $('#deleteEmployeeId').val(setters[0].EmployeeId);
                        $('#deleteEmployeeNumber').val(setters[0].EmployeeNumber);
                        $('#deleteFirstName').val(setters[0].FirstName);
                        $('#deleteLastName').val(setters[0].LastName);
                        $('#deleteAddress').val(setters[0].Address);
                        $('#deleteContactNumber').val(setters[0].ContactNumber);

                        $('#deleteRFID').val(setters[0].RFID);

                        $('#deleteBirthDate').val(setters[0].BirthDate);

                        $("#deletePreview").attr("src",baseurl+setters[0].Image);

            


                        $('#deleteEmployeeModal').modal('show'); 

                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    }


    $('#deleteRecords').click(function (e) { 
        var id = $('#deleteEmployeeId').val();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeManageController/deleteRecord",
            data: {
                id:id,
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    $('#deleteEmployeeModal').modal('hide'); 
                    fetch();
                    
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    });
    

    

    //add records
    $("#addRecords").click(function (e) { 
     
        e.preventDefault();
        toasterOptions();
        
        var BranchId = $('#BranchSelector').val();
        var DepartmentId = $('#DepartmentSelector').val();
        var PositionId =$('#PositionSelector').val();
        var ScheduleId = $('#ScheduleSelector').val();
        var FirstName = $('#FirstName').val();
        var LastName = $('#LastName').val();
        var BirthDate = $('#BirthDate').val();
        var baseSalary = $('#baseSalary').val();
     
        var Address = $('#Address').val();
        var ContactNumber = $('#ContactNumber').val();
        var RFID = $('#RFID').val();
        var Image = $('#addImage')[0].files[0];


        var formData = new FormData();
        formData.append('FirstName',FirstName);
        formData.append('LastName',LastName);
        formData.append('BirthDate',BirthDate);
        formData.append('Address',Address);
        formData.append('ContactNumber',ContactNumber);
        formData.append('DepartmentId',DepartmentId);
        formData.append('PositionId',PositionId);
        formData.append('BranchId',BranchId);
        formData.append('ScheduleId',ScheduleId);
        formData.append('BaseSalary',baseSalary);

        formData.append('RFID',RFID);
        formData.append('Image',Image);

        $.ajax({
            type: "POST",
            url: baseurl + "EmployeeManageController/addEmployee",
            data:formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);
                }
                else{
                    toastr["success"]("Alert",data.message);
                    $('#addEmployeeModal').modal('hide'); 
                    fetch();
                }
            }
        });
});
// add image preview
$('#addImage').change(function (e) { 
    e.preventDefault();
    var output = document.getElementById('addPreview');
    output.src = URL.createObjectURL(e.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }

});






    

    //

    //Load add employee form
   
   
    $("#addEmployeeButton").click(function (e) { 
        e.preventDefault();
        $("#BirthDate").datepicker();
        $('#addEmployeeModal').modal('show'); 
    });

    function loadSelectors()
    {
        
        $("#BirthDate").datepicker();
            $.ajax({
                type: "POST",
                url: baseurl + "EmployeeManageController/loadAddRecordModal",
                data: "data",
                dataType: "JSON",
                success: function (response) {
                    var branches;
                    var departments;
                    var positions;
                    var schedules;
                    for (var key in response) {
                        if (response.hasOwnProperty(key)) {
                            if(key == "branches"){
                                branches = response[key];
                                for(var key in branches){
                                    $('#BranchSelector').append('<option value="'+branches[key].BranchId+'">'+branches[key].Branch+'</option>');
                                    $('#editBranchSelector').append('<option value="'+branches[key].BranchId+'">'+branches[key].Branch+'</option>');
                                    $('#deleteBranchSelector').append('<option value="'+branches[key].BranchId+'">'+branches[key].Branch+'</option>');
                                }
                            }
                            else if(key == "departments"){
                                departments = response[key];
                                for(var key in departments){
                                    $('#DepartmentSelector').append('<option value="'+departments[key].DepartmentId+'">'+departments[key].Department+'</option>');
                                    $('#editDepartmentSelector').append('<option value="'+departments[key].DepartmentId+'">'+departments[key].Department+'</option>');
                                    $('#deleteDepartmentSelector').append('<option value="'+departments[key].DepartmentId+'">'+departments[key].Department+'</option>');
                                }
                            }
                            else if(key == "positions"){
                                positions = response[key];
                                for(var key in positions){
                                    $('#PositionSelector').append('<option value="'+positions[key].PositionId+'">'+positions[key].Position+'</option>');
                                    $('#editPositionSelector').append('<option value="'+positions[key].PositionId+'">'+positions[key].Position+'</option>');
                                    $('#deletePositionSelector').append('<option value="'+positions[key].PositionId+'">'+positions[key].Position+'</option>');
                                }
                            }
                            else if(key == "schedules"){
                                schedules = response[key];  
                                for(var key in schedules){
                                    $('#ScheduleSelector').append('<option value="'+schedules[key].ScheduleId+'">'+schedules[key].TimeIn  + '-' + schedules[key].TimeOut+'</option>');
                                    $('#editScheduleSelector').append('<option value="'+schedules[key].ScheduleId+'">'+schedules[key].TimeIn  + '-' + schedules[key].TimeOut+'</option>');
                                    $('#deleteScheduleSelector').append('<option value="'+schedules[key].ScheduleId+'">'+schedules[key].TimeIn  + '-' + schedules[key].TimeOut+'</option>');
                                }
                            }
                        
                        }
                    }
                }
            });
    }
    // 
});
