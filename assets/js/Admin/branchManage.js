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
                    console.log(setters);
                    if($.fn.dataTable.isDataTable('#branchTable')) {
                        console.log("drew it!");
                        table = $('#branchTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        console.log("generate it");
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
                                           columns: [0,1,2]
                                      }
                            },

                            ],
                            data:data.posts,
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
                                    width:"10%"
                                },
                                {
                                    title:"Actions",
                                    data:null,
                                    width:"5%",
                                    render:function(type,data,meta,row){
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
        for(var pair of formData.entries()){
            console.log("Key is: " +pair[0]+', Value is: '+pair[1]);
        }
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



});