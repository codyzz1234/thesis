

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
            dataType: "JSON",
            success: function (data) {   
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