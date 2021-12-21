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
    //fetch Records
    fetch();
    function fetch()
    {
        toasterOptions();
        $.ajax({
            type: "POST",
            url: baseurl+"LeaveControllers/LeaveAllocateControl/fetch",
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
                    if($.fn.dataTable.isDataTable('#leaveAllocateTable')) {
                        table = $('#leaveAllocateTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                        console.log("Drew it");
                    }
                    else{
                           console.log("Generate it");
                           table = $('#leaveAllocateTable').DataTable({
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
                                    {"data":"EmployeeNumber"},
                                    {"data":"FirstName"},
                                    {"data":"LastName"},
                                    {"data":"LeaveAllocated"},
                                    {"data":"LeaveUse"},
                                    {"data":"LeaveBalance"},
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
            }
        });
    }

    
    // Add Allocation
    $('#addAllocation').click(function (e){ 
        e.preventDefault();
        loadSearches();
        console.log(searching.result);
        $('#addAllocationModal').modal('show');

    });

    
    $("#addSearch").keyup(function (e) { 
        $('#addResult').html('');
        var searchField = $('#addSearch').val();
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
                Image = "."+Image; //add extra "." to go one more folder up
                console.log("image is " + Image);
                var a = '<li class="list-group-item addlistResults" data-employeenumber ="'+EmployeeNumber+
                '" data-employeeid = "'+EmployeeId+
                '" data-firstname = "'+FirstName+
                '"data-lastname = "'+LastName+'">'+
                '<img src="'+Image+'" alt="..." class="img-thumbnail leaveAllocateImage"> </img>'+
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
    });
    $('#addRecord').click(function (e) { 
        toasterOptions();
        var formData = new FormData();
        formData.append('Id',$('#addId').val());
        formData.append('Allocate',$('#addAllocate').val());
        $.ajax({
            type: "POST",
            url: baseurl+"LeaveControllers/LeaveAllocateControl/addAllocate",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
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
    //Edit Allocation
    $(document).on('click','.editButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#leaveAllocateTable').DataTable().row(currentRow).data();
        var dataJson = {
            'LeaveId':data['LeaveId'],
            'EmployeeNumber':data['EmployeeNumber'],
            'FirstName':data['FirstName'],
            'LastName':data['LastName'],
            'LeaveAllocated':data['LeaveAllocated'],
            'LeaveBalance':data['LeaveBalance'],
            'LeaveUse':data['LeaveUse'],
        }
        loadEditLeaveForm(dataJson)
    });

    function loadEditLeaveForm(dataJson)
    {
        $('#editId').val(dataJson['LeaveId'])
        $('#editFirst').val(dataJson['FirstName'])
        $('#editLast').val(dataJson['LastName'])
        $('#editNumber').val(dataJson['EmployeeNumber'])
        $('#editAllocate').val(dataJson['LeaveAllocated'])
        $('#editBalance').val(dataJson['LeaveBalance'])
        $('#editUse').val(dataJson['LeaveUse'])

        $('#editAllocationModal').modal('show');
    }
    $('#editRecord').click(function (e) { 
        e.preventDefault();
        alert("edited");
    });

    //for Searching
    window.searching = {};
    searching.result = 0;
    function loadSearches()
    {
        $.ajax({
            type: "POST",
            url: baseurl+"LeaveControllers/LeaveAllocateControl/loadSearches",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    for(var key in data){
                        if(data.hasOwnProperty(key)){
                            if(key == "posts"){
                                searching.result = data[key];
                            }
                        }
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


    //Make Results Interactive

    $(document).on('click','.addlistResults', function() 
    { 
        $this = $(this);
        var employeeId =  $this.attr('data-employeeid');
        var firstName = $this.attr('data-employeenumber');
        var lastName = $this.attr('data-firstname');
        var employeeNumber = $this.attr('data-lastname');
        $('#addId').val(employeeId);
        $('#addFirst').val(firstName)
        $('#addLast').val(lastName)
        $('#addNumber').val(employeeNumber)
        $("#addResult").empty()
    });

    // when mouse hovers over search result;
    $(document).on({
        mouseenter: function () {
            $this =$(this);
            $this.css('background-color','#F0F8FF');
        },
        mouseleave: function () {
            $this.css('background-color','white');
        }
    }, ".addlistResults"); //pass the element as an argument

    //When Modal is closed or hidden

    $("#addAllocationModal").on("hidden.bs.modal", function () {
        $("#addResult").empty()
        $('#addId').val("");
        $('#addFirst').val("")
        $('#addLast').val("")
        $('#addNumber').val("")
        $('#addAllocate').val("")
    });


});