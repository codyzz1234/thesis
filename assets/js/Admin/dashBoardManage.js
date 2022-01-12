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
                    let totalEmployees = setters.TotalEmployees;
                    let presentEmployees = setters.PresentEmployees;
                    let lateEmployees = setters.LateEmployees; 
                    let absentEmployees = setters.AbsentEmployees;
                    valueToCards(totalEmployees,presentEmployees,lateEmployees,absentEmployees)
              }
          }
      });  
    }

    function valueToCards(totalEmployees,presentEmployees,lateEmployees,absentEmployees)
    {
      $("#totalEmployees").html(totalEmployees);
      $("#presentEmployees").html(presentEmployees);
      $("#lateEmployees").html(lateEmployees);
      $('#absentEmployees').html(absentEmployees);



    }


});