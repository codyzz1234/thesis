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
    fetch();
    function fetch()
    {
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeAccountManageController/fetch",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                console.log("data.respons is " + data.response) 
                if(data.response == "success"){
                    var table;
                    setters = data.posts;
                    if($.fn.dataTable.isDataTable('#employeeAccountsTable')) {
                        table = $('#employeeAccountsTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        table = $('#employeeAccountsTable').DataTable({
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
                                              columns: [ 0,1,2,3,4]
                                         }
                               },
            
    
                            ],
                            "data":data.posts,
                            columns:[
                                {"data": "Image",
                                "render": function ( data, type, row, meta ) {
                                       return '<img src="'+data+"?time"+new Date().getTime()+'"alt="Error load" class="img-fluid"></img>'                     
                                    }
                                },
                                {"data":"EmployeeNumber"},
                                {"data":"FirstName"},
                                {"data": "LastName"},
                                {"data": "LastLogin"},
                                {"data": "DateCreated"},
                                {"data": "EmployeeId",
                                "render": function ( data, type, row, meta ) {
                                    var editButton = '<a href="#" value = "'+data+'" class = "btn btn-outline-info editButton"><i class="fas fa-pen-square"></i></a>'
                                    var deleteButton = '<a href="#" value = "'+data+'" class = "btn btn-outline-danger deleteButton"><i class="fas fa-trash-alt"></i></a>'
                                    return editButton+deleteButton
                                    }
                                 }
                            ],
                            columnDefs: [
                                {
                                    "targets":0,
                                    "width":"6%",
                                }
                            ]
                        })
                    }

                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            
            }
        });

    }
    // Add New Employee Account
    $('#addAccountButton').click(function (e) { 
        e.preventDefault();
        loadSearches();
        console.log(JSON.parse(JSON.stringify(searching.result)));
        $('#addAccountModal').modal('show'); 
    });

    $('#addRecord').click(function (e) { 
        e.preventDefault();
        var EmployeeId = $('#addEmployeeId').val();
        var EmployeeNumber  = $('#addEmployeeNumber').val();
        var Password = $('#addPassword').val();
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeAccountManageController/addAccount",
            data: {
                EmployeeId:EmployeeId,
                EmployeeNumber:EmployeeNumber,
                Password:Password,
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    $('#addAccountModal').modal('hide'); 
                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    });

    //searchEmployee
    window.searching = {};
    searching.result = 0;
    
    
    function loadSearches()
    {
       
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeAccountManageController/search",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                for(var key in data){
                    if(data.hasOwnProperty(key)){
                        searching.result = data[key];
                    }
                }
            }
        });
    }

    $("#searchEmployee").keyup(function (e) { 
        $('#result').html('');
        var searchField = $('#searchEmployee').val();
        searchField = searchField.replace(/\s+/g, '');
        console.log("You searched: " + searchField);
        if (!searchField.length){
            return;
        }
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
                var a = '<li class="list-group-item listResults" data-employeenumber ="'+EmployeeNumber+
                '" data-employeeid = "'+EmployeeId+
                '" data-firstname = "'+FirstName+
                '"data-lastname = "'+LastName+'">'+
                '<img src="'+Image+'" alt="..." class="img-thumbnail accountManageImageResult"> </img>'+
                '<span>'+EmployeeNumber+'</span>'+ " | " +
                '<span>'+FirstName +" "+LastName+'</span>'+" | " +
                '<span>'+Department+'</span>'+" | " +
                '<span>'+Position+'</span>'+" | " +
                '<span>'+Branch+'</span>'+"" +
                     '</li>'
                $('#result').append(a);
            }
            else{
                continue;
            }
        }
    });

    // when the search result is clicked
    $(document).on('click','.listResults', function() 
    { 
        $this = $(this);
        var lastName = $this.attr('data-lastname');
        var firstName =  $this.attr('data-firstname')
        var employeeNumber =  $this.attr('data-employeenumber')
        var employeeId =  $this.attr('data-employeeid')
        $('#addEmployeeId').val(employeeId);
        $('#addEmployeeNumber').val(employeeNumber);
        $('#addFirstName').val(firstName);
        $('#addLastName').val(lastName);
        $("#result").empty()
        $('#searchEmployee').val("");
    });

    // when mouse hovers over search result;
    $(document).on({
        mouseenter: function () {
            $this =$(this);
            $this.css('background-color','#F0F8FF');
            console.log("You in")
        },
        mouseleave: function () {
            $this.css('background-color','white');
            console.log("You out")
        }
    }, ".listResults"); //pass the element as an argument

    //Edit Functiosn
    $(document).on('click','.editButton', function() 
    { 
        $this = $(this);
        id = $this.attr('value');
        loadEditForm(id);
    });


    function loadEditForm(id)
    {
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeAccountManageController/loadEditForm",
            data:{
                EmployeeId:id
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    setters = data.posts;
                    console.log(setters);
                    $('#editEmployeeId').val(setters[0].EmployeeId);
                    $('#editEmployeeNumber').val(setters[0].EmployeeNumber);
                    $('#editFirstName').val(setters[0].FirstName);
                    $('#editLastName').val(setters[0].LastName);
                    $('#editEmployeeAccountModal').modal('show'); 
                }
                else{
                    toastr["error"]("Alert",data.message);
                }                
            }
        });
    }

    $('#editRecord').click(function (e) { 
        e.preventDefault();
        var EmployeeId = $('#editEmployeeId').val();
        var Password = $('#editPassword').val();
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeAccountManageController/updateAccount",
            data: {
                EmployeeId:EmployeeId,
                Password:Password,
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
           
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    });

    //Delete Functions

    $(document).on('click','.deleteButton', function() 
    { 
        $this = $(this);
        id = $this.attr('value');
        console.log(id);
        loadDeleteForm(id);
    });

    function loadDeleteForm(id)
    {
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeAccountManageController/loadDeleteForm",
            data:{
                EmployeeId:id
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    setters = data.posts;
                    console.log(setters);
                    $('#deleteEmployeeId').val(setters[0].EmployeeId);
                    $('#deleteEmployeeNumber').val(setters[0].EmployeeNumber);
                    $('#deleteFirstName').val(setters[0].FirstName);
                    $('#deleteLastName').val(setters[0].LastName);
                    $('#deleteEmployeeAccountModal').modal('show'); 
                }
                else{
                    toastr["error"]("Alert",data.message);
                }                
            }
        });
    }

    $("#deleteRecord").click(function (e) { 
        e.preventDefault();
        deleteRecord(id);
    });

    function deleteRecord(id)
    {
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeAccountManageController/deleteAccount",
            data: {
                EmployeeId:id
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    $('#deleteEmployeeAccountModal').modal('hide'); 
                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    }

    //When modal is hidden
    $("#addAccountModal").on("hidden.bs.modal", function () {
        $("#result").empty()
    });






});