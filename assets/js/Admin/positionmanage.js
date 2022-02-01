




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
            type: "POST",
            url: baseurl+"PositionControl/fetch",
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
                    if($.fn.dataTable.isDataTable('#positionTable')) {
                        table = $('#positionTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                          table = $('#positionTable').DataTable({
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
                                className: "btn btn-secondary spaceButtons",
                                extend:'copy',
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                          columns: [0,1,2]
                                     }
                            },

                            {
                                text:'Export Table To Excel',
                                extend:'excel',
                                className:"btn btn-success spaceButtons",
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                          columns: [0,1,2]
                                     }
 
                            },
                            {
                                text:'Export Table To CSV',
                                extend:'csv',
                                className:"btn btn-info spaceButtons",
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                          columns: [0,1,2]
                                     }
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
                                    title:"Position",         
                                    data:"Position"
                                },

                                {data:"Description"},
                              
                                {
                                    data:"NumberOfEmployees",
                                    render:function(data,type,row,meta){
                                        var a = '<div class = "text-center"><h6>'+data+'</h6> </div>'
                                        return a;
                                    }
                                },

                                {data:null,
                                 render:function(data,type,row,meta){
                              
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


    $('#addPosition').click(function (e) { 
        e.preventDefault();
        $('#addPositionModal').modal('show'); 
    });

    $("#addRecord").click(function (e) { 
        e.preventDefault();
        toasterOptions();
        var formData = new FormData();
        formData.append('PositionName',$('#addPositionName').val())
        formData.append('Description',$('#addPositionDescription').val())

        $.ajax({
            type: "POST",
            url: baseurl+"PositionControl/addPosition",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                if(data.response == "success"){
                    $('#addForm')[0].reset();
                    $('#addPositionModal').modal('hide'); 
                    toastr["success"]("Alert",data.message);
                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }   
                
            }
        });
    });

    //Edit Position
    $(document).on('click','tbody .editButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#positionTable').DataTable().row(currentRow).data();

        var dataJson = {
            'PositionId':data['PositionId'],
            'Description':data['Description'],
            'Position':data['Position'],
            'Rate':data['Rate'],
            }


        loadEditForm(dataJson);
    });


    function loadEditForm(dataJson)
    {
        $('#editPositionId').val(dataJson['PositionId']);
        $('#editPositionName').val(dataJson['Position']);
        $('#editPositionDescription').val(dataJson['Description']);
        $('#editPosRate').val(dataJson['Rate']);


        $('#editPositionModal').modal('show');
    }


    $('#editRecord').click(function (e) { 
        e.preventDefault();

        toasterOptions();
        var formData = new FormData();
        formData.append('PositionId',$('#editPositionId').val());
        formData.append('PositionName',$('#editPositionName').val());
        formData.append('Description',$('#editPositionDescription').val());
        formData.append('Rate',$('#editPosRate').val());
        
        $.ajax({
            type: "POST",
            url: baseurl+"PositionControl/editPosition",
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

    //Delete Position
    $(document).on('click','tbody .deleteButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#positionTable').DataTable().row(currentRow).data();
        var dataJson = {
            'PositionId':data['PositionId'],
            'Position':data['Position'],
            'Description':data['Description'],
            'NumEmployee':data['NumberOfEmployees'],
            }
        deleteModal(dataJson)
    });

    function deleteModal(dataJson)
    {
        
        $('#delId').val(dataJson['PositionId'])

        $('#delName').val(dataJson['Position'])

        $('#delDesc').val(dataJson['Description'])

        $('#delNum').val(dataJson['NumEmployee'])

        $('#delPosModal').modal('show'); 
    }


    $("#deleteRecord").click(function (e) { 
        e.preventDefault();
        var formData = new FormData();
        formData.append('PositionId',$('#delId').val());
        formData.append('Position',$('#delName').val());

        

        $.ajax({
            type: "POST",
            url: baseurl+"PositionControl/deleteRecord",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                if(data.response == "success"){
                    toastr["success"]("Alert",data.message);
                    $('#delPosModal').modal('hide'); 

                    fetch();
                }
                else{
                    toastr["error"]("Alert",data.message);
                }
                
            }
        });
        
    });

});