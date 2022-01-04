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
    fetch()
   
    function fetch()
    {
        $.ajax({
            type: "GET",
            url: baseurl+"DeductionControl/fetch",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                toasterOptions();
                if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);

                }
                else if (data.response == "none"){
                    toastr["info"]("Alert",data.message);

                }
                else{
                    var table;
                    setters = data.posts;
                    if($.fn.dataTable.isDataTable('#deductionTable')) {
                        table = $('#deductionTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        table = $('#deductionTable').DataTable({
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
                                              columns: [ 0,1,2]
                                         }
                               },
    
                            ],
                            "data":data.posts,
                            columns:[
                                {"data":"Deduction"},
                                {"data":"Description"},
                                {"data":"Amount"},
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

    // add deduction modal
    $('#addDeduction').click(function (e) { 
        e.preventDefault();
        $('#addDeductionModal').modal('show'); 

    });
    // add record
    $('#addRecord').click(function (e) { 
        e.preventDefault();
        toasterOptions();
        var formData = new FormData();
        formData.append('Deduction',$('#addDeductName').val());
        formData.append('Description',$('#addDeductDesc').val());
        formData.append('Amount',$('#addDeductAmount').val());
        $.ajax({
            type: "POST",
            url: baseurl+"DeductionControl/addRecord",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                toasterOptions();
                if(data.response == "failed"){
                    toastr["error"]("Alert",data.message);
                }
                else{
                    toastr["success"]("Alert",data.message);
                    $('#addDeductionModal').modal('hide'); 
                    fetch();
                }
                
            }
        });

    });

    //Edit records 

    $(document).on('click','tbody .editButton', function(e) 
    { 
        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#deductionTable').DataTable().row(currentRow).data();

        var dataJson = {
            'DeductionId':data['DeductionId'],
            'Deduction':data['Deduction'],
            'Description':data['Description'],
            'Amount':data['Amount'],
            }
   
        loadEditForm(dataJson);
    });

    function loadEditForm(dataJson)
    {
        
        $('#editId').val(dataJson['DeductionId']);
        $('#editName').val(dataJson['Deduction']);
        $('#editDesc').val(dataJson['Description']);
        $('#editAmount').val(dataJson['Amount']);
        
        $('#editDeductionModal').modal('show');

    }

    $('#editRecord').click(function (e) { 
        e.preventDefault();

        toasterOptions();
        var formData = new FormData();
        formData.append('DeductionId',$('#editId').val());
        formData.append('Deduction',$('#editName').val());
        formData.append('Description',$('#editDesc').val());
        formData.append('Amount',$('#editAmount').val());

         
        $.ajax({
            type: "POST",
            url: baseurl+"DeductionControl/editRecord",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                toasterOptions();
                if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
                }
                else if(data.response == "failed"){
                    toastr["info"]("Alert",data.message);

                }
                else{
                    toastr["success"]("Alert",data.message);
                    fetch();
                }
                
            }
        });
        
    });


});