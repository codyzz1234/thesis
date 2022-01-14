$(document).ready(function () {

   
    //add records
    window.searching = {};
    searching.result = 0;

    $('#addCommission').click(function (e) { 
        e.preventDefault();
        fetchSearches();
        console.log(searching.result);
        $('#addModal').modal('show');
    });

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
    });




    
});