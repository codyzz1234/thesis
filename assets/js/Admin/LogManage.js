

$(document).ready(function () {
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
        $.ajax({
            type: "POST",
            url: baseurl+"LogController/fetch",
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
                    if($.fn.dataTable.isDataTable('#logTable')) {
                        table = $('#logTable').DataTable();
                        table.clear().draw();
                        table.rows.add(setters); // Add new data
                        table.columns.adjust().draw();
                    }
                    else{
                        table = $('#logTable').DataTable({
                            order:[[0,"desc"]],
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
                                //For Sorting
                                {
                                    data:"id",
                                    visible:false,
                                },
                                //Display rest of data.
                                {
                                    title:"Admin Id",
                                    data:"AdminId",
                                    width:"3%",
                                },
                                {
                                    title:"Admin Username",
                                    data:"Username",
                                },
                                {
                                    title:"Actions",
                                    data:"Activity",
                                },
                                {
                                    title:"Date",
                                    data:"Date"
                                },
                                {
                                    title:"Time",
                                    data:"Time"
                                }

                            ],

                        });
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
 
    

});