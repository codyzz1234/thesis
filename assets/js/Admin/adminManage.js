

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
 
    $.ajax({
        type: "POST",
        url: baseurl + "AdminManageController/loadAdmins",
        data: "data",
        dataType: "JSON",
        success: function (data) {
            if(data.response == "success"){
                var table;
                setters = data.posts;
                if($.fn.dataTable.isDataTable('#adminManageTable')) {
                    table = $('#adminManageTable').DataTable();
                    table.clear().draw();
                    table.rows.add(setters); // Add new data
                    table.columns.adjust().draw();
                }
                else{
                    table = $('#adminManageTable').DataTable({
                        "destroy": true,
                        responsive:true,
                        dom: //'Blfrtip', // if you remove this line you will see the show entries dropdown
                        'B'+
                        "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>"+
                         "rtip",
    
                        buttons:[
                            {
                                text:'Copy Table to Clipboard',
                                className: "btn btn-secondary spaceButtons",
                                extend:'copy',
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                          columns: [ 0,1,2,3,4]
                                     }
                            },
                            {
                                text:'Export Table To Excel',
                                extend:'excel',
                                className:"btn btn-success spaceButtons",
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                          columns: [ 0,1,2,3,4]
                                     }
                            },
                            {
                                text:'Export Table To CSV',
                                extend:'csv',
                                className:"btn btn-info spaceButtons",
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                          columns: [ 0,1,2,3,4]
                                     }
                            },
                            
                            {
                                 text:'Export Table To PDF',
                                 extend:'pdf',
                                 className:"btn btn-warning spaceButtons",
                                 orientation : 'landscape',
                                 pageSize : 'LEGAL',
                                 exportOptions: {
                                           columns: [ 0,1,2,3,4]
                                      }
                            },
                        ],
                        "data":data.posts,
                        columns:[
                            {"data":"Id"},
                            {"data":"Username"},
                            {"data":"FirstName"},
                            {"data":"LastName"},
                            {"data":"CreatedOn"},
                            {"data":"LastLogin"},
                            {"data":"Id",
                            "render": function ( data, type, row, meta ) {
                                var editButton = '<a href="#" value = "'+data+'" class = "btn btn-outline-info editButton"><i class="fas fa-pen-square"></i></a>'
                                var deleteButton = '<a href="#" value = "'+data+'" class = "btn btn-outline-danger deleteButton"><i class="fas fa-trash-alt"></i></a>'
                                return editButton+deleteButton
                              }
                        },
                        ]
                    } );
                }
            }
            
            else{
            }
            
        }
    });
    
}
//Edit Admin
$(document).on('click','tbody .editButton', function(e) 
{ 
    e.preventDefault();
    $this = $(this);
    var id = $this.attr('value');
    loadEditForm(id);
    
});

function loadEditForm(id)
{
    $.ajax({
        type: "POST",
        url: "AdminManageController/loadEditForm",
        data: {
            id:id
        },
        dataType: "JSON",
        success: function (data) {
            if(data.response == "failed"){

            }
            else if(data.response == "success"){
                setters = data.posts;
                $('#editId').val(id);
                $('#editUserName').val(setters[0].Username);
                $('#editFirstName').val(setters[0].FirstName);
                $('#editLastName').val(setters[0].LastName);
            }
        }
    });
    $('#editAdminModal').modal('show'); 
}

$('#updateRecords').click(function (e) { 
    toasterOptions();
    e.preventDefault();
    var Id =  $('#editId').val();
    var UserName = $('#editUserName').val();
    var Password = $('#editPassword').val();
    var FirstName= $('#editFirstName').val();
    var LastName = $('#editLastName').val();

    $.ajax({
        type: "POST",
        url: baseurl + "AdminManageController/updateAdmin",
        data: {
            Id:Id,
            FirstName:FirstName,
            LastName:LastName,
            UserName:UserName,
            Password:Password
        },
        dataType: "JSON",
        success: function (data) {
            if(data.response == "failed"){
                toastr["error"]("Alert",data.message);
            }
          else if(data.response == "none"){
                toastr["info"]("Alert",data.message);
            }
          else {
            toastr["success"]("Alert",data.message);
            $('#editAdminModal').modal('hide'); 
            fetch();
          }
        }
    });

});


$('#editAdminModal').on('hidden.bs.modal', function () {
    $('#editPassword').val("");
});

//Delete Admin
$(document).on('click','tbody .deleteButton', function(e) 
{ 

    e.preventDefault();
    $this = $(this);
    var id = $this.attr('value');
    loadDeleteForm(id);
});


function loadDeleteForm(id)
{ 
    $.ajax({
        type: "POST",
        url: "AdminManageController/loadDeleteForm",
        data: {
            id:id,
        },
        dataType: "JSON",
        success: function (data) {
            if(data.response == "failed"){
                alert("Failed");
            }
            else{
                setters = data.posts;
                $('#deleteId').val(id);
                $('#deleteUserName').val(setters[0].Username);
                $('#deleteFirstName').val(setters[0].FirstName);
                $('#deleteLastName').val(setters[0].LastName); 
            }
        }
    });
    console.log("here")
    $('#deleteAdminModal').modal('show'); 
}

$(document).on('click','#launchConfModal', function () {
    $('#confirmModal').modal('show');
});


$('#deleteRecord').click(function (e) { 
    toasterOptions();
    e.preventDefault();
    var id =  $('#deleteId').val();
    let username = $('#deleteUserName').val();
    $.ajax({
        type: "POST",
        url: "AdminManageController/deleteAdmin",
        data: {
            id:id,
            username:username,
        },
        dataType: "JSON",
        success: function (data) {
            if(data.response == "success"){
                toastr["success"]("Alert",data.message);
                $('#deleteAdminModal').modal('hide');
                $('#confirmModal').modal('hide');
                fetch();
            }
            else{
                toastr["error"]("Alert",data.message);
            }
        }
    });
    
});



//Add Admin
$('#addAdmin').click(function (e) { 
    e.preventDefault();
    $('#addAdminModal').modal('show'); 
    
});

$('#addRecord').click(function (e) { 
    toasterOptions();
    e.preventDefault();
    var UserName = $('#addUserName').val();
    var Password = $('#addPassword').val();
    var FirstName= $('#addFirstName').val();
    var LastName = $('#addLastName').val();
    $.ajax({
        type: "POST",
        url: baseurl+"AdminManageController/addAdmin",
        data: {
            UserName:UserName,
            Password:Password,
            FirstName:FirstName,
            LastName:LastName
        },
        dataType: "JSON",
        success: function (data) {
            if(data.response == "failed"){
                toastr["error"]("Alert",data.message);
            }
            else{
                toastr["success"]("Alert",data.message);
                $('#addAdminModal').modal('hide'); 
                fetch();
            }
            
        }
    });

});



$(document).on('click','#addShowPass' ,function () {
    if($("#addPassword").attr('type') == "password"){
        $("#addPassword").attr('type','text')
        $("#addShowIcon").attr('class','fas fa-eye-slash');
    }
    else{
        $("#addPassword").attr('type','password')
        $("#addShowIcon").attr('class','fas fa-eye');
        

    }

});

$(document).on('click','#editShowPass',function () {
    if($("#editPassword").attr('type') == "password"){
        $("#editPassword").attr('type','text')
        $("#editShowIcon").attr('class','fas fa-eye-slash');
    }
    else{
        $("#editPassword").attr('type','password')
        $("#editShowIcon").attr('class','fas fa-eye');

    }
    
});





    
});