$(document).ready(function () {
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
        toasterOptions();
        $.ajax({
            type:"GET",
            url: baseurl+"EmployeeSalaryControl/fetch",
            data: "data",
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    var setters = data.posts;
                    console.log(setters);

                    var table;
                    setters = data.posts;
                
                    if($.fn.dataTable.isDataTable('#employeeSalTable')) {
                        table = $('#employeeSalTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        table = $('#employeeSalTable').DataTable({
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
                             data:data.posts,
                             columns:[
                                 {
                                    width:"6%",
                                    title:"Image",
                                    data:"Image",
                                    "render": function ( data, type, row, meta ) {
                                        return '<img src="'+data+"?time"+new Date().getTime()+'"alt="Error load" class="img-fluid"></img>'                     
                                    }
                                 },
                                {
                                    title:"Employee Number",
                                    data:"EmployeeNumber",
                                },
                                {
                                    title: "First Name",
                                    data:"FirstName",
                                },
                                {
                                    title:"Base Salary",
                                    data:"BaseSalary",
                                },


                                {
                                    title:"Pag Ibig",
                                    data:"PagIbig",
                                },


                                {
                                    title:"Phil Health",
                                    data:"PhilHealth",
                                },
                                {
                                    title:"SSS Contribution",
                                    data:"SSS",
                                },
                                {
                                    title:"Actions",
                                    data:null,
                                    render:function(data,type,row,meta){
                                        var editButton = '<a href = "#" value = "" class = "btn btn-outline-info editButton"> <i class="fas fa-pen-square"></i></a>'
                                        return editButton;
                                    }
                                },

                             
                            

                             ],
                         


                        })


                    }


                }
                else if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
                    console.log("no records");
                }
                else if (data.resposne == "failed"){
                    toastr["error"]("Alert",data.message);
                    console.log("Failed to retrieve");
                }
                
            }
        });
    }

    // load edit 
    $(document).on('click','tbody .editButton', function(e) 
    { 
        e.preventDefault();

        $this=  $(this);
        var currentRow = $this.closest('tr');
        var data = $('#employeeSalTable').DataTable().row(currentRow).data();

        var dataJson = {
            'EmployeeNumber':data['EmployeeNumber'],
            'EmployeeId':data['EmployeeId'],
            'PhilHealth':data['PhilHealth'],
            'PagIbig':data['PagIbig'],
            'SSS':data['SSS'],
            'Image':data['Image'],
            'BaseSalary':data['BaseSalary'],
            'FirstName':data['FirstName'],
            'LastName':data['LastName'],
        };
      
        loadEditForm(dataJson)
        
    });
    function loadEditForm(dataJson)
    {  
        $("#editSalaryForm").find('input[name=EmployeeId]').val(dataJson['EmployeeId']);

        $("#editSalaryForm").find('input[name=EmployeeNumber]').val(dataJson['EmployeeNumber']);


        $("#editSalaryForm").find('input[name=PhilHealth]').val(dataJson['PhilHealth']);


        $("#editSalaryForm").find('input[name=PagIbig]').val(dataJson['PagIbig']);


        $("#editSalaryForm").find('input[name=BaseSalary]').val(dataJson['BaseSalary']);


        $("#editSalaryForm").find('input[name=FirstName').val(dataJson['FirstName']);

        $("#editSalaryForm").find('input[name=LastName]').val(dataJson['LastName']);

        $("#editSalaryForm").find('input[name=SSS]').val(dataJson['SSS']);



        $("#editSalaryForm").find('img[name=ImagePreview]').attr('src',dataJson['Image']+"?time"+new Date().getTime());

        $('#editSalaryModal').modal('show'); 


    }


    $('#editRecord').click(function (e) { 
        e.preventDefault();
        let formData = new FormData($('#editSalaryForm')[0]);
        for(var pair of formData.entries()){
            console.log("Key is: " +pair[0]+', Value is: '+pair[1]);
        }
       
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeSalaryControl/editSalary",
            data: formData,
            dataType: "JSON",
            contentType: false, 
            processData: false,
            success: function (data) {
                
                if(data.response == "success"){
                    fetch();
                  
                }
                else{
                    toastr["error"]("Alert",data.message);
                }   
                
            }
        });
        
    });

  
});