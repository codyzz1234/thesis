$(document).ready(function () {
    fetchAllData();
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