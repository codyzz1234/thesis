$(document).ready(function () {

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
    fetchAllData();
    function fetchAllData()
    {
      toasterOptions();
      $.ajax({
          type: "GET",
          url: baseurl + "DashBoardController/fetch",
          data: "data",
          dataType: "JSON",
          success: function (data) {
              if(data.response == "failed"){
                toastr["error"]("Alert",data.message);
              }
              else{
                    setters = data.posts;
                    console.log(setters);
                    let TotalEmployees = setters.TotalEmployees
                    console.log(TotalEmployees)
              }
          }
      });  
    }

    function valueToCards(TotalEmployees,PresentEmployees)
    {
      console.log("Total Employees is " + TotalEmployees);
      console.log("Present Employees is: " + PresentEmployees)
    }


});