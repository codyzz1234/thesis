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
                            '>'+
                            '<img src = "'+baseurl+Image+'" alt = "..." class = "img-thumbnail CommissionImage"></img>'+
                            '<span>'+ EmployeeNumber + '</span>'+ "|"+
                            '<span>' + Name + '</span>'+
                            '</li>'
                            
                    console.log(a)
                            
                    $('#addResult').append(a);
                }
                else{
                    continue;
                }
            }
        }
    });




    
});