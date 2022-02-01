$(document).ready(function () {
    toasterOptions();
    initialLoad();
    setDateRangePicker();
    fetchSearches();

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
        start = moment(start).format('YYYY-MM-DD');
        end = moment(end).format('YYYY-MM-DD');
        $.ajax({
            type: "POST",
            url: baseurl+"CommissionControl/fetch",
            data:{
                StartDate:start,
                EndDate:end,
            },
            cache:false,
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    var table;
                    setters = data.posts;
                    console.log(setters)
                    if($.fn.dataTable.isDataTable('#commissionsTable')) {
                        table = $('#commissionsTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        table = $('#commissionsTable').DataTable({
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
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                          columns: [0,1,2,3,4]
                                     }
                            },

                            {
                                text:'Export Table To Excel',
                                extend:'excel',
                                className:"btn btn-success spaceButtons",
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                     columns: [0,1,2,3,4]
                                }
 
                            },
                            {
                                text:'Export Table To CSV',
                                extend:'csv',
                                className:"btn btn-info spaceButtons",
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                    columns: [0,1,2,3,4]
                                }
                            },
                            
                            {
                                 text:'Export Table To PDF',
                                 extend:'pdf',
                                 className:"btn btn-warning spaceButtons",
                                 orientation : 'landscape',
                                 pageSize : 'LEGAL',
                                 exportOptions: {
                                    columns: [0,1,2,3,4]
                                }
                            },
    
                            ],
                            data:data.posts,
                            columns:[
                                {
                                    title:"Image",
                                    data: "Image",
                                    width: "5%",
                                    render: function ( data, type, row, meta ) {
                                       return '<img src="'+baseurl+data+"?time"+new Date().getTime()+'"alt="Error load" class="img-fluid"></img>'                     
                                    }
                                },
                                
                                {
                                    title:"First Name",
                                    data:"FirstName",
                                  
                                },

                                {
                                    title:"Last Name",
                                    data:"LastName",

                                },

                                {
                                    title:"Date",
                                    data:"Date",
                                },
                                {
                                    title:"Description",
                                    data:"Description"
                                },
                                {
                                    title:"Amount",
                                    data:"Amount",
                                },
                                {
                                    title:"Actions",
                                    data:null,
                                    render:function(data,type,row,meta){
                                        var editButton = '<a href="#" value = "'+'" class = "btn btn-outline-info editButton"><i class="fas fa-pen-square"></i></a>'
                                        var deleteButton = '<a href="#" value = "'+'" class = "btn btn-outline-danger deleteButton"><i class="fas fa-trash-alt"></i></a>'
                                        return editButton+deleteButton
                                    }
                                }

                            ],

                        });
                    }
                }   
                else if (data.response == "none"){
                    toastr["info"]("Alert",data.message);

                }
                else{
                    toastr["error"]("Alert",data.message);

                }            
            }
        });
    }

    

   
    //add records
    window.searching = {};
    searching.result = 0;

    $('#addCommission').click(function (e) { 
        e.preventDefault();
        console.log(searching.result);
        $('#addForm input[name=DatePicker]').datepicker();
        $('#addModal').modal('show');
    });
    //fetch Searches for results
    function fetchSearches()
    {
        $.ajax({
            type: "GET",
            url: baseurl+"CommissionControl/fetchSearches",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                searching.result = data;
            }
        });

    }

    $('#addRecord').click(function (e) { 
        e.preventDefault();
        let form = $('#addForm')[0];
        let formData = new FormData(form);

        formData.append('LabelNumber',$('#addForm label[for=LabelNumber]').text())
        for(var pair of formData.entries()){
            console.log("Key is: " +pair[0]+', Value is: '+pair[1]);
        }

        $.ajax({
            type: "POST",
            url: baseurl+"CommissionControl/addRecord",
            data: formData,
            dataType: "JSON",
            contentType:false,
            processData:false,
            success: function (data) {
                if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);
                }
                else{
                    toastr["success"]("Alert",data.message);
                    $('#addForm')[0].reset();
                    $('#addModal').modal('hide');
        
                    let date = $("#dateRangePicker").val();
                    date= date.split('-');
                    startDate = date[0];
                    endDate = date[1];
                    fetch(startDate,endDate);
                }
            }
        });
    });

    $('#addForm input[name=EmployeeNumber]').keyup(function (e) { 
        
        $('#addResult').html('');
        let searchField = $('#addForm input[name=EmployeeNumber]').val();
        console.log("Search Field is" + searchField);
        searchField = searchField.replace(/\s+/g, '');
        if (!searchField.length){
            return;
        }
        else{
            let find = searching.result;
            console.log(find);
            let expression = new RegExp(searchField,"i");
            for(let key in find){
                let Image = find[key].Image;
                let EmployeeNumber = find[key].EmployeeNumber;
                let EmployeeId = find[key].EmployeeId;
                let Name = find[key].Name;
                let complete = EmployeeNumber+Name+EmployeeId;
                complete = complete.replace(/\s+/g, '');
                if(complete.match(expression)){
                    var a = '<li class  = "list-group-item addListResults" '+
                            'data-employeeid = "'+EmployeeId+'" '+
                            'data-employeenumber = "'+EmployeeNumber+'" '+
                            'data-name = "'+Name+'" '+
                            'data-image = "'+baseurl+Image+'"'+
                            '>'+
                            '<img src = "'+baseurl+Image+'" alt = "..." class = "img-thumbnail CommissionImage"></img>'+
                            '<span>'+ EmployeeNumber + '</span>'+ " | "+
                            '<span>' + Name + '</span>'+         
                            '</li>'
                                                       
                    $('#addResult').append(a);
                }
                else{
                    continue;
                }
            }
        }
    });

    //Add Interactivity for list results
    
    $(document).on('click','.addListResults' ,function () {
        $this = $(this);
        console.log("Listing");
        let EmployeeId = $this.attr('data-employeeid');
        let EmployeeNumber = $this.attr('data-employeenumber')
        let Name = $this.attr('data-name');
        let Image = $this.attr('data-image')
        
        $('#addForm input[name=EmployeeId]').val(EmployeeId);
        $('#addForm input[name=EmployeeNumber]').val(EmployeeNumber);
        $('#addForm label[for=LabelNumber]').text(EmployeeNumber);
        $('#addForm label[for=LabelName]').text(Name);
        $('#addForm img[name=ImagePreview]').attr('src',Image);
        $('#addResult').empty();
    });


    $(document).on({
        mouseenter: function () {
            $this =$(this);
            $this.css('background-color','#5F9EA0');
        },
        mouseleave: function () {
            $this.css('background-color','white');
        }
    }, ".addListResults,.editListResults"); //pass the element as an argument



    //Date Range Picker
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
     // When apply button is hit
     $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
        var startDate = picker.startDate.format('YYYY-MM-DD');
        var endDate =  picker.endDate.format('YYYY-MM-DD');
        console.log("start Date is : " + startDate);
        console.log("end Date is : " + endDate );
        fetch(startDate,endDate)
    });
    // when Clear/Cancel button is hit
    $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#applyDate').on('click', function (e,picker) {
        e.preventDefault();
        var start = $('#dateRangePicker').data('daterangepicker').startDate;
        var end =  $('#dateRangePicker').data('daterangepicker').endDate;
        start = moment(start).format('YYYY-MM-DD');
        end = moment(end).format('YYYY-MM-DD');
        fetch(start,end);
        
    });

    //Edit Records

    $(document).on('click','tbody .editButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#commissionsTable').DataTable().row(currentRow).data();

        var dataJson = {
                'Name': data['FirstName'] +  " " + data['LastName'],
                'CommissionId':data['CommissionId'],
                'EmployeeId':data['EmployeeId'],
                'Amount':data['Amount'],
                'Date':data['Date'],
                'Description':data['Description'],
                'EmployeeNumber':data['EmployeeNumber'],
                'Image':data['Image'],
            }
        loadEditForm(dataJson)
        $('#editModal').modal('show');
        
    });
    function loadEditForm(dataJson)
    {

        $('#editForm input[name=DatePicker]').datepicker();
        $('#editForm img[name=ImagePreview]').attr('src',baseurl+dataJson['Image']);
        $('#editForm label[for=LabelNumber]').text(dataJson['EmployeeNumber']);
        $('#editForm label[for=LabelName]').text(dataJson['Name']);
        $('#editForm input[name=EmployeeNumber]').val(dataJson['EmployeeNumber']);
        $('#editForm input[name=DatePicker]').val(dataJson['Date']);
        $('#editForm input[name=Description]').val(dataJson['Description']);
        $('#editForm input[name=Amount]').val(dataJson['Amount']);
        $('#editForm input[name=EmployeeId]').val(dataJson['EmployeeId']);
        $('#editForm input[name=CommissionId]').val(dataJson['CommissionId']);
    }

    $('#editForm input[name=EmployeeNumber]').keyup(function (e) { 
        $('#editResult').html('');
        let searchField = $('#editForm input[name=EmployeeNumber]').val();
        console.log("Search Field is" + searchField);
        searchField = searchField.replace(/\s+/g, '');
        if (!searchField.length){
            return;
        }
        else{
            let find = searching.result;
            console.log(find);
            let expression = new RegExp(searchField,"i");
            for(let key in find){
                let Image = find[key].Image;
                let EmployeeNumber = find[key].EmployeeNumber;
                let EmployeeId = find[key].EmployeeId;
                let Name = find[key].Name;
                let complete = EmployeeNumber+Name+EmployeeId;
                complete = complete.replace(/\s+/g, '');
                if(complete.match(expression)){
                    var a = '<li class  = "list-group-item editListResults" '+
                            'data-employeeid = "'+EmployeeId+'" '+
                            'data-employeenumber = "'+EmployeeNumber+'" '+
                            'data-name = "'+Name+'" '+
                            'data-image = "'+baseurl+Image+'"'+
                            '>'+
                            '<img src = "'+baseurl+Image+'" alt = "..." class = "img-thumbnail CommissionImage"></img>'+
                            '<span>'+ EmployeeNumber + '</span>'+ " | "+
                            '<span>' + Name + '</span>'+         
                            '</li>'
                                                       
                    $('#editResult').append(a);
                }
                else{
                    continue;
                }
            }
        }
    });

    $(document).on('click','.editListResults' ,function () {
        $this = $(this);
        console.log("Listing");
        let EmployeeId = $this.attr('data-employeeid');
        let EmployeeNumber = $this.attr('data-employeenumber')
        let Name = $this.attr('data-name');
        let Image = $this.attr('data-image')
        
        $('#editForm input[name=EmployeeId]').val(EmployeeId);
        $('#editForm input[name=EmployeeNumber]').val(EmployeeNumber);
        $('#editForm label[for=LabelNumber]').text(EmployeeNumber);
        $('#editForm label[for=LabelName]').text(Name);
        $('#editForm img[name=ImagePreview]').attr('src',Image);
        $('#editResult').empty();
    });

    $('#editRecord').click(function (e) { 
        e.preventDefault();
        let form = $('#editForm')[0];
        let formData = new FormData(form);
        formData.append('LabelNumber',$('#editForm label[for=LabelNumber]').text())

        for(var pair of formData.entries()){
            console.log("Key is: " +pair[0]+', Value is: '+pair[1]);
        }
        $.ajax({
            type: "POST",
            url: baseurl+"CommissionControl/editRecord",
            data: formData,
            dataType: "JSON",
            contentType:false,
            processData:false,
            success: function (data) {
                if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);

                }
                else if(data.response == "none"){
                    toastr["info"]("Alert",data.message);

                }
                else{
                    toastr["success"]("Alert",data.message);
                    let date = $("#dateRangePicker").val();
                    date= date.split('-');
                    startDate = date[0];
                    endDate = date[1];
                    fetch(startDate,endDate);
                }
            }
        });
        
    });

    //Delete Records
    $(document).on('click','tbody .deleteButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#commissionsTable').DataTable().row(currentRow).data();

        var dataJson = {
                'Name': data['FirstName'] +  " " + data['LastName'],
                'CommissionId':data['CommissionId'],
                'EmployeeId':data['EmployeeId'],
                'Amount':data['Amount'],
                'Date':data['Date'],
                'Description':data['Description'],
                'EmployeeNumber':data['EmployeeNumber'],
                'Image':data['Image'],
            }
        loadDeleteForm(dataJson)
        $('#deleteModal').modal('show');
    });

    function loadDeleteForm(dataJson)
    {
        $('#deleteForm input[name=DatePicker]').val(dataJson['Date']);
        $('#deleteForm img[name=ImagePreview]').attr('src',baseurl+dataJson['Image']);
        $('#deleteForm label[name=LabelName]').val(dataJson['Name']);
        $('#deleteForm label[name=LabelNumber]').val(dataJson['EmployeeNumber']);
        $('#deleteForm input[name=CommissionId]').val(dataJson['CommissionId']);
        $('#deleteForm input[name=EmployeeNumber]').val(dataJson['EmployeeNumber']);
        $('#deleteForm input[name=DatePicker]').val(dataJson['Date']);
        $('#deleteForm input[name=Description]').val(dataJson['Description']);
        $('#deleteForm input[name=Amount]').val(dataJson['Amount']);

    }

    $('#deleteRecord').click(function (e) { 
        e.preventDefault();
        var commissionId = $('#deleteForm input[name=CommissionId]').val();
        let EmployeeNumber = $('#deleteForm input[name=EmployeeNumber]').val();
        $.ajax({
            type: "POST",
            url: baseurl+"CommissionControl/deleteRecord",
            data:{
                CommissionId:commissionId,
                EmployeeNumber:EmployeeNumber
                
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    $('#deleteModal').modal('hide')
                    let date = $("#dateRangePicker").val();
                    date= date.split('-');
                    startDate = date[0];
                    endDate = date[1];
                    fetch(startDate,endDate);
                    
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
                
            }
        });
    });

    



    




});