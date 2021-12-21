$(document).ready(function () {
    function fetchAllData()
    {
      $.ajax({
          type: "GET",
          url: baseurl + "DashBoardController/fetch",
          data: "data",
          dataType: "JSON",
          success: function (data) {
              
          }
      });  
    }


});