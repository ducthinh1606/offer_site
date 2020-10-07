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
                url: 'ajax/application.php',
                type: 'POST',
            },
            columns: [
                {data: 'app_name'},
                {data: 'net_work'},
                {data: 'url'},
                {data: 'Actions'},
            ]
        });

        //delete App
        table.on('click','.deleteApplication',function(){
            var id = $(this).data('id');

            var deleteConfirm = confirm("Are you sure?");
            if (deleteConfirm === true) {
                // AJAX request
                $.ajax({
                    url: 'ajax/application.php',
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
        table.on('click','.editApplication',function(){
            var id = $(this).data('id');

            $('#app_id').val(id);

            // AJAX request
            $.ajax({
                url: 'ajax/application.php',
                type: 'post',
                data: {request: 3, id: id},
                dataType: 'json',
                success: function(response){
                    if(response.status == 1){

                        $('#name').val(response.data.app_name);
                        $('#network').val(response.data.net_work);
                        $('#url').val(response.data.url);

                        table.DataTable().ajax.reload();
                    }else{
                        alert("Invalid ID.");
                    }
                }
            });
        });

        //edit network
        $('#btn_save').click(function(){
            var id = $('#app_id').val();

            var name = document.getElementById("name").value;
            var network = $('#network option:selected').val();
            var url = document.getElementById("url").value;

            if(name !='' && network !='' && url !=''){

                // AJAX request
                $.ajax({
                    url: 'ajax/application.php',
                    type: 'post',
                    data: {
                        request: 4,
                        id: id,
                        app_name: name,
                        net_work : network,
                        url : url
                    },
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 1){
                            alert(response.message);

                            // Empty and reset the values
                            $('#name').val('');
                            $('#url').val('');
                            $('#network_id').val(0);

                            // Reload DataTable
                            table.DataTable().ajax.reload();

                            // Close modal
                            $('#editApplication').modal('toggle');
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
    var name = document.getElementById("app_name").value;
    var url = document.getElementById("app_url").value;
    var network = $('#app_network option:selected').val();
    $.ajax({
        type: "post",
        url: "add/addapplication.php",
        data: {
            'app_name' : name,
            'url' : url,
            'net_work' : network
        },
        success: function (data) {
            location.reload();
            alert(data)
        }
    })
});

