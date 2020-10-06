"use strict";
var KTDatatablesDataSourceAjaxServer = function() {

    var initTable1 = function() {
        var table = $('#kt_datatable');

        // begin first table
        table.DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                url: 'ajax/network.php',
                type: 'POST',
            },
            columns: [
                {data: 'network_name'},
                {data: 'Actions'},
            ]
        });

        //delete network
        table.on('click','.deleteNetwork',function(){
            var id = $(this).data('id');

            var deleteConfirm = confirm("Are you sure?");
            if (deleteConfirm === true) {
                // AJAX request
                $.ajax({
                    url: 'ajax/network.php',
                    type: 'post',
                    data: {request: 2, id: id},
                    success: function (response) {
                        if (response == 1) {
                            alert("Record deleted.");

                            // Reload DataTable
                            table.DataTable().ajax.reload();
                        } else {
                            alert("Invalid ID.");
                        }
                    }
                });
            }
        });

        //show data modal
        table.on('click','.editNetwork',function(){
            var id = $(this).data('id');

            $('#network_id').val(id);

            // AJAX request
            $.ajax({
                url: 'ajax/network.php',
                type: 'post',
                data: {request: 3, id: id},
                dataType: 'json',
                success: function(response){
                    if(response.status == 1){

                        $('#network').val(response.data.network_name);

                        table.DataTable().ajax.reload();
                    }else{
                        alert("Invalid ID.");
                    }
                }
            });
        });

        //edit network
        $('#btn_save').click(function(){
            var id = $('#network_id').val();

            var name = $('#network').val().trim();

            if(name !=''){

                // AJAX request
                $.ajax({
                    url: 'ajax/network.php',
                    type: 'post',
                    data: {request: 4, id: id, network_name: name},
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 1){
                            alert(response.message);

                            // Empty and reset the values
                            $('#network').val('');
                            $('#network_id').val(0);

                            // Reload DataTable
                            table.DataTable().ajax.reload();

                            // Close modal
                            $('#updateModal').modal('toggle');
                        }else{
                            alert(response.message);
                        }
                    }
                });

            }else{
                alert('Please fill all fields.');
            }
        });
    };

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    KTDatatablesDataSourceAjaxServer.init();
});


$("#btn_add").click(function () {
    var name = document.getElementById("network_name").value;
    $.ajax({
        type: "post",
        url: "add/addnetwork.php",
        data: {
            'network_name' : name
        },
        success: function (data) {
            location.reload();
            alert(data)
        }
    })
});

