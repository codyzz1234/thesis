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
            url: baseurl+"CommissionControl/fetch",
            data:{
                StartDate:start,
                EndDate:end,
            },
            cache:false,
            dataType: "JSON",
            success: function (data) {
                console.log(data.posts);
               
            }
        });
    }

    

   
    //add records
    window.searching = {};
    searching.result = 0;

    $('#addCommission').click(function (e) { 
        e.preventDefault();
        fetchSearches();
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



});