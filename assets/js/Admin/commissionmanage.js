$(document).ready(function () {

    $('#addCommission').click(function (e) { 
        e.preventDefault();
        fetchResults();
        $('#addModal').modal('show');
    });

    $('#addRecord').click(function (e) { 
        e.preventDefault();
        let form = $('#addForm')[0];
        let formData = new FormData(form);
        for(var pair of formData.entries()){
            console.log("Key is: " +pair[0]+', Value is: '+pair[1]);
        }
    });

    function fetchResults()
    {

    }



    
});