
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
    "timeOut": "1000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
    "preventDuplicates":true,
    }
}

//$("#rfidScanField").css("opacity", 0);

$(document).ready(function () {
    //starting functions
    focus();
    $("#rfidScanField").focus();

    // Focuser On Click
    function focus()
    {
        $(document).click(function() 
        { 
            $("#rfidScanField").focus();
            console.log("focused on RFID Field");  
        });
       

    }

    //Initial Page Scanned
    var timer;
    $('#rfidScanField').keypress(function (e) { 
        if (e.keyCode == 13) {
            clearTimeout(timer);
            e.preventDefault();
            loadFields();
            $("#rfidScanField").css("opacity", 0);
            $('#rfidScanField').val("");

            timer = setTimeout(function()
            { 
            $("#rfidScanField").css("opacity", 1);
            $('#rfidScanField').val("");
            $("#splashForm").fadeOut(250);
            }, 3000);
        }
    });

    //Timer
    function ValueCount()
    {
        count++;
    }


    //splashForm

    function loadFields()
    {
        toasterOptions();
        var RFID;
        if($('#rfidScanField').val() ==""){
            RFID = $('#splashRfidField').val()
        }
        else{
            RFID = $('#rfidScanField').val()
        }
        console.log("RFID is: "+RFID);
        $.ajax({
            type: "POST",
            url: baseurl+"EmployeeSide/RFIDAttendControl/attendance",
            data:{
                RFID:RFID,
            } ,
            dataType: "JSON",
            success: function (data) {
                console.log(data.response);
                if(data.response == "success"){
                    setters = data.posts;
                    console.log(data.posts);
                    $('#splashAvatar').attr("src",setters[0].Image);
                    $('#nameField').val(setters[0].FirstName + " " + setters[0].LastName);
                    $('#departmentField').val(setters[0].Department);
                    $('#positionField').val(setters[0].Position);
                    $('#scheduleField').val(setters[0].TimeIn + "-"+setters[0].TimeOut);
                    $('#timeStampField').val(setters[0].Timestamp);
                    $("#splashForm").fadeIn(250);
                }
                else if(data.response == "none"){
                    toastr["info"]("Alert",data.message);
                }

                else if(data.response == "out"){
                    toastr["warning"]("Alert",data.message);
                }
                
                else{
                    toastr["error"]("Alert",data.message);
                }
            }
        });
    }

});