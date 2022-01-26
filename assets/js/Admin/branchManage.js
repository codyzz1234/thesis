$(document).ready(function () {
    toasterOptions();
    fetch();
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
        $.ajax({
            type: "GET",
            url: baseurl+"BranchControl/fetch",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
                }
                else if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);

                }
                else{
                    var table;
                    setters = data.posts;
                    if($.fn.dataTable.isDataTable('#branchTable')) {
                        table = $('#branchTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        table = $('#branchTable').DataTable({
                            destroy:true,
                            response:true,
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
                                          columns: [0,1,2,3]
                                     }
                            },

                            {
                                text:'Export Table To Excel',
                                extend:'excel',
                                className:"btn btn-success spaceButtons",
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                          columns: [0,1,2,3]
                                     }
 
                            },
                            {
                                text:'Export Table To CSV',
                                extend:'csv',
                                className:"btn btn-info spaceButtons",
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                          columns: [0,1,2,3]
                                     }
                            },
                            
                            {
                                 text:'Export Table To PDF',
                                 extend:'pdf',
                                 className:"btn btn-warning spaceButtons",
                                 orientation : 'landscape',
                                 pageSize : 'LEGAL',
                                 exportOptions: {
                                           columns: [0,1,2,3]
                                      }
                            },

                            ],
                            data:data.posts,
                            order:[[0,"asc"]],
                            columns:[
                                {
                                    title:"Branch",
                                    data:"Branch",
                                    width:"5%"
                                },
                                {
                                    title:"Address",
                                    width:"10%",
                                    data:"Address"
                                    
                                },

                                {
                                    title:"Number Of Employees",
                                    data:"NumEmp",
                                    render:function(data,type,row,meta){
                                        var a = '<div class = "text-center"><h6>'+data+'</h6> </div>'
                                        return a;
                                    },
                                    width:"10%"
                                },

                                {
                                    title:"Actions",
                                    data:null,
                                    width:"5%",
                                    render:function(data,type,row,meta){
                                        var editButton = '<a href="#" value = "'+'" class = "btn btn-outline-info editButton"><i class="fas fa-pen-square"></i></a>'
                                        var deleteButton = '<a href="#" value = "'+'" class = "btn btn-outline-danger deleteButton"><i class="fas fa-trash-alt"></i></a>'
                                        return editButton+deleteButton
                                    }
                                }
                            ],
    

                        })

                    }
                }
            }
        });
    }

    //Add Branch
    $(document).on('click','#addBranch' ,function () {
        $('#addBranchModal').modal('show');
    });

    $(document).on('click','#addRecord', function () {
        let form = $('#addForm')[0];
        let formData = new FormData(form);
 
        $.ajax({
            type: "POST",
            url: baseurl+"BranchControl/addRecord",
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
                    $('#addBranchModal').modal('hide');
                    fetch();
                }
                
            }
        });
    });
    
    //edit branch
    $(document).on('click','tbody .editButton',function (e) {
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#branchTable').DataTable().row(currentRow).data();
        
        var dataJson = {
            'BranchId':data['BranchId'],
            'BranchName':data['Branch'],
            'Address':data['Address'],
            }
        loadEditForm(dataJson);
        
    });

    function loadEditForm(dataJson)
    {
        $('#editForm input[name=BranchId]').data('branchid',dataJson['BranchId']);
        $("#editForm input[name=Address]").val(dataJson['Address']);
        $("#editForm input[name=BranchName]").val(dataJson['BranchName']);

        $('#editBranchModal').modal('show');

    }

    $(document).on('click','#editRecord', function (e) {
        let form = $('#editForm')[0];2
        let formData = new FormData(form);
        let branchId = $('#editForm input[name=BranchId]').data('branchid');
        formData.append('BranchId',branchId)

    
  
        $.ajax({
            type: "POST",
            url: baseurl+"BranchControl/editRecord",
            data: formData,
            dataType: "JSON",
            contentType:false,
            processData:false,
            success: function (data) {
                if(data.response == "none"){
                    toastr["info"]("Alert",data.message);

                }
                else if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);

                }
                else{
                    toastr["success"]("Alert",data.message);
                    fetch();
                }
            }
        });

    });

    //delete branch

    $(document).on('click','tbody .deleteButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#branchTable').DataTable().row(currentRow).data();

        var dataJson = {
                'BranchId':data['BranchId'],
                'BranchName':data['Branch'],
                'Address':data['Address'],
            }
        loadDeleteForm(dataJson);
    });

    function loadDeleteForm(dataJson)
    {
        $('#deleteForm input[name=BranchId]').data('branchid',dataJson['BranchId']);
        $('#deleteForm input[name=BranchName]').val(dataJson['BranchName']);
        $('#deleteForm input[name=Address]').val(dataJson['Address']);
        $('#delBranchModal').modal('show');
    }

    $(document).on('click','#deleteRecord'  ,function () {

        let branchID =  $('#deleteForm input[name=BranchId]').data('branchid');
        let form = $('#deleteForm')[0];
        let formData = new FormData(form);
        formData.append('BranchId',branchID);
    
        
        $.ajax({
            type: "POST",
            url: baseurl+"BranchControl/deleteRecord",
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
                    $('#delBranchModal').modal('hide');
                    fetch();
                }
            }
        });
    });





});