

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
    toasterOptions();

    // Fetch the records
    function fetch()
    {
        $.ajax({
            type: "POST",
            url: baseurl+"DepartmentControl/fetch",
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
                    if($.fn.dataTable.isDataTable('#departmentTable')) {
                        table = $('#departmentTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        table = $('#departmentTable').DataTable({
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
                                {"data": "Department",
                                    "render":function(data,type,row,met){
                                        var a = '<div class = "text-center"><h6>'+data+'</h6> </div>'
                                        return a;
                                    },    
                                },
                                {"data": "Description",
                                 "render":function(data,type,row,met){
                                    var a = '<div class = "text-center"><h6>'+data+'</h6> </div>'
                                    return a;
                                },    
                              },
                            ],
                            columnDefs: [
                                { 
                                   "targets": 2,
                                  "data":null,
                                  "render": function ( data, type, row, meta ) {
                                      var a;
                     
                                      if(data.Head == null){
                                        a = '<div class = "text-center"><h6> This Department Has No Manager</h6> </div>'
                                      }
                                      else{
                                        a = '<div class = "text-center">'+
                                        '<h6>'+data.Head+'</h6>'+
                                        '<h6>'+data.EmployeeNumber+'</h6>'+
                                        '</div>'
                                      }
                                      return a;
                                  },
                                },
                                { 
                                   "targets": 3,
                                   "data": null,
                                   "render":function(data,type,row,met){
                                    var a = '<div class = "text-center"><h6>'+data.NumberOfEmployees+'</h6> </div>'
                                    return a;
                                  },    
                                },
                                {
                                    "targets":4,
                                    "data":"DepartmentId",
                                    "render":function(data,type,row,meta){
                                        var editButton = '<a href="#" value = "'+data+'" class = "btn btn-outline-info editButton"><i class="fas fa-pen-square"></i></a>'
                                        var deleteButton = '<a href="#" value = "'+data+'" class = "btn btn-outline-danger deleteButton"><i class="fas fa-trash-alt"></i></a>'
                                        return editButton+deleteButton
                                    },
                                }
                            ],
                        })
                    }
                }
            }
        });
    }

    // Edit records

    $(document).on('click','tbody .editButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var id = $this.attr("value");
        loadSearches();
        loadEditForm(id);
        $('#editDepartmentModal').modal('show');
    });

    function loadEditForm(id)
    {
        var formData = new FormData();
        formData.append('Id',id);
        $.ajax({
            type: "POST",
            url: baseurl+"DepartmentControl/loadEditForm",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                if(data.response == "success"){
                    var setters = data.posts;
                    $('#editDepartmentId').val(setters[0].DepartmentId)
                    $('#editDepartmentHeadId').val(setters[0].EmployeeId)
                    $('#editDepartmentName').val(setters[0].Department)
                    $('#editDepartmentDescription').val(setters[0].Description)
                    $('#editDepartmentHead').val(setters[0].EmployeeNumber)               
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    }

    $('#editDepartmentHead').keyup(function (e) {
        $('#editResult').html('');
        var searchField = $('#editDepartmentHead').val();
        searchField = searchField.replace(/\s+/g, '');
        if (!searchField.length){
            return;
        }
        else{
            var find = searching.result;
            var expression = new RegExp(searchField,"i");
            for(var key in find){
                var Image = find[key].Image;
                var EmployeeId = find[key].EmployeeId;
                var EmployeeNumber = find[key].EmployeeNumber;
                var FirstName = find[key].FirstName;
                var LastName = find[key].LastName;
                var Department = find[key].Department;
                var Position = find[key].Position;
                var Branch = find[key].Branch;
                var complete = EmployeeNumber + FirstName + LastName + Department + Position + Branch;
                complete = complete.replace(/\s+/g, '');
                if(complete.match(expression)){
                    var a = '<li class="list-group-item editListResults" data-employeenumber ="'+EmployeeNumber+
                    '" data-employeeid = "'+EmployeeId+
                    '" data-firstname = "'+FirstName+
                    '"data-lastname = "'+LastName+'">'+
                    '<img src="'+Image+'" alt="..." class="img-thumbnail DepartmentHeadImage"> </img>'+
                    '<span>'+EmployeeNumber+'</span>'+ " | " +
                    '<span>'+FirstName +" "+LastName+'</span>'+" | " +
                    '<span>'+Department+'</span>'+" | " +
                    '<span>'+Position+'</span>'+" | " +
                    '<span>'+Branch+'</span>'+"" +
                         '</li>'
                    $('#editResult').append(a);
                }
                else{
                    continue;
                }
            }
        }
    });

    //Update the Record
    $('#updateRecords').click(function (e) { 
        e.preventDefault();
        toasterOptions();
        var formData = new FormData();
        formData.append('DepartmentId',$('#editDepartmentId').val());
        formData.append('Head',$('#editDepartmentHeadId').val());
        formData.append('DepartmentName',$('#editDepartmentName').val());
        formData.append('Description',$('#editDepartmentDescription').val());
        $.ajax({
            type: "POST",
            url: baseurl+"DepartmentControl/updateRecord",
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
                else{
                    toastr["success"]("Alert",data.message);
                    fetch();
                }

            }
        });

    });




    // Delete Records
    $(document).on('click','tbody .deleteButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var id = $this.attr("value");
        loadDeleteForm(id)
    });

    function loadDeleteForm(id)
    {
        var currentRow = $this.closest('tr');
        var data = $('#departmentTable').DataTable().row(currentRow).data();
        $('#deleteDepartmentId').val(id);
        $('#deleteDepartmentName').val(data['Department']);
        $('#deleteDepartmentHead').val(data['EmployeeNumber']);
        $('#deleteDepartmentDescription').val(data['Description']);
        $('#deleteDepartmentModal').modal('show');
        
    }

    $('#deleteRecords').click(function (e) { 
        e.preventDefault();
        var formData = new FormData();
        formData.append('DepartmentId',$('#deleteDepartmentId').val() );
        $.ajax({
            type: "POST",
            url: baseurl+"DepartmentControl/deleteRecord",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    $('#deleteDepartmentModal').modal('hide');
                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    });

    //Add Departments

    $('#addDepartment').click(function (e) { 
        e.preventDefault();
        $('#addDepartmentName').val("") 
        $('#addDepartmentDescription').val("")
        $('#departmentHeadId').val("") 
        $('#addDepartmentHead').val("")
        toasterOptions();
        loadSearches();
        $('#addDepartmentModal').modal('show');
    });


    $('#addDepartmentRecord').click(function (e) { 
        e.preventDefault();
        var formData = new FormData();
        formData.append('DepartmentName',$('#addDepartmentName').val());
        formData.append('Description',$('#addDepartmentDescription').val());
        formData.append('Head',$('#departmentHeadId').val());

        $.ajax({
            type: "POST",
            url: baseurl+"DepartmentControl/addDepartment",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    $('#addDepartmentModal').modal('hide');
                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    });
    // Add Department Head keyup

    $('#addDepartmentHead').keyup(function (e) { 
        $('#addResult').html('');
        var searchField = $('#addDepartmentHead').val();
        searchField = searchField.replace(/\s+/g, '');
        if (!searchField.length){
            return;
        }
        else{
            var find = searching.result;
            var expression = new RegExp(searchField,"i");
            for(var key in find){
                var Image = find[key].Image;
                var EmployeeId = find[key].EmployeeId;
                var EmployeeNumber = find[key].EmployeeNumber;
                var FirstName = find[key].FirstName;
                var LastName = find[key].LastName;
                var Department = find[key].Department;
                var Position = find[key].Position;
                var Branch = find[key].Branch;
                var complete = EmployeeNumber + FirstName + LastName + Department + Position + Branch;
                complete = complete.replace(/\s+/g, '');
                if(complete.match(expression)){
                    var a = '<li class="list-group-item addListResults" data-employeenumber ="'+EmployeeNumber+
                    '" data-employeeid = "'+EmployeeId+
                    '" data-firstname = "'+FirstName+
                    '"data-lastname = "'+LastName+'">'+
                    '<img src="'+baseurl+Image+'" alt="..." class="img-thumbnail DepartmentHeadImage"> </img>'+
                    '<span>'+EmployeeNumber+'</span>'+ " | " +
                    '<span>'+FirstName +" "+LastName+'</span>'+" | " +
                    '<span>'+Department+'</span>'+" | " +
                    '<span>'+Position+'</span>'+" | " +
                    '<span>'+Branch+'</span>'+"" +
                         '</li>'
                    $('#addResult').append(a);
                }
                else{
                    continue;
                }
            }
        }

    });

    

    
    // load possible searches

    window.searching = {};
    searching.result = 0;

    function loadSearches()
    {
        $.ajax({
            type: "POST",
            url: baseurl+"DepartmentControl/loadSearches",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    for(var key in data){
                        if(data.hasOwnProperty(key)){
                            if(key == "posts"){
                                searching.result = data[key];
                            }
                            searching.result = data[key];
                        }
                    }
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });

    }



    //add interaction to those searches

    $(document).on('click','.addListResults', function() 
    { 
        $this = $(this);
        var employeeId =  $this.attr('data-employeeid');
        var EmployeeNumber = $this.attr('data-employeenumber');
        let name = $this.attr('data-firstname') + " " + $this.attr('data-lastname')
        $('#departmentHeadId').val(employeeId);
        $("#addResult").empty()
        $('#addDepartmentHead').val(EmployeeNumber + " | " + name );
    });


    $(document).on('click','.editListResults', function() 
    { 
        $this = $(this);
        var employeeId =  $this.attr('data-employeeid');
        var EmployeeNumber = $this.attr('data-employeenumber');
        let name = $this.attr('data-firstname') + " " + $this.attr('data-lastname')
        $('#editDepartmentHeadId').val(employeeId);
        $("#editResult").empty()
        $('#editDepartmentHead').val(EmployeeNumber + " | " + name );
    });




    // when mouse hovers over search result;
    $(document).on({
        mouseenter: function () {
            $this =$(this);
            $this.css('background-color','#5F9EA0');
        },
        mouseleave: function () {
            $this.css('background-color','white');
        }
    }, ".addListResults,.editListResults"); //pass the element as an argument

    //When Modal is closed or hidden

    $("#editDepartmentModal,#addDepartmentModal").on("hidden.bs.modal", function () {
        $("#addResult").empty()
        $("#editResult").empty()
    });

    //clear department head

    $('#addClear').click(function (e) { 
        e.preventDefault();
        $('#departmentHeadId').val("");
        $('#addDepartmentHead').val("");
        $("#addResult").empty();

    });

    $("#editClear").click(function (e) { 
        e.preventDefault();
        $('#editDepartmentHeadId').val("");
        $('#editDepartmentHead').val("");
        $("#editResult").empty();
    });
    





});