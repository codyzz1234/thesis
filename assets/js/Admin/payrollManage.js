$(document).ready(function (){
    toasterOptions();
    initialLoad();
    setDateRangePicker();

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
        console.log("Start date is: " + start);
        console.log("End Date is: " + end);
        $.ajax({
            type: "POST",
            url: baseurl + "PayrollControl/fetch" ,
            cache:false,
            data:{
                StartDate:start,
                EndDate:end,
            },
            dataType: "JSON",
            success: function (data) {
                if(data.response == "success"){
                    var table;
                    setters = data.posts;
                    console.log(setters)
                    if($.fn.dataTable.isDataTable('#payrollRecords')) {
                        console.log("drew it!");
                        table = $('#payrollRecords').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        console.log("generate it!");

                        table = $('#payrollRecords').DataTable({
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
                               },
    
                            ],
    
                            data:data.posts,
                            columns:[
                        
                                {
                                    title:"Image",
                                    "data": "Image",
                                    "render": function ( data, type, row, meta ) {
                                       return '<img src="'+baseurl+data+"?time"+new Date().getTime()+'"alt="Error load" class="img-fluid"></img>'                     
                                    }
                                },

                                {
                                    title:"Employee Name",
                                    data:null,
                                    render:function(row,type,data,meta){
                                        return row.FirstName + " " + row.LastName;
                                    }

                                },

                                {
                                    title:"Employee Number",
                                    data:"EmployeeNumber"
                                },

                                {
                                    title:"Position",
                                    data:"Position"
                                },

                                {
                                    title:"Total Hours Worked",
                                    data: "TotalHours",
                                    
                                },

                                {
                                    title:"Total Days Worked",
                                    data:"DaysWorked"
                                },


                                {
                                    title:"Base Salary",
                                    data:"BaseSalary",
                                },

                                {
                                    title:"Gross pay",
                                    data:null,
                                    render: function(row,type,data,meta){
                                        return "Java";
                                    },
                                },

                                {
                                    title:"Net Pay",
                                    data:null,
                                    render: function(row,type,data,meta){
                                        return " ";
                                    },
                                },




                                {
                                    title:"Hourly Rate",
                                    data:"BaseSalary",
                                    render:function(data,type,row,meta){
                                        var hourlyRate = parseFloat(data);
                                        hourlyRate = ((hourlyRate * 12)/313) /8;
                                        return hourlyRate;
                                    
                                    },
                                },

                             
                 
    
                            ],
                            columnDefs: [
                                { "targets": 0,
                                  "width":"6%",
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



    $(document).on('click','.editButton', function(e) 
    { 

        e.preventDefault();
        $this = $(this);
        var currentRow = $this.closest('tr');
        var data = $('#payrollRecords').DataTable().row(currentRow).data();
        var dataJson = {
            'EmployeeId':data['AttendanceId'],
            }
        console.log(data['EmployeeId']);
    });

    
    //Initialize Date Range Picker
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



});

