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
                url: 'ajax/member.php',
                type: 'POST',
            },
            columns: [
                {data: 'username'},
                {data: 'e_name'},
                {data: 'phone'},
                {data: 'e_role'},
                {data: 'Actions'},
            ]
        });

        //delete network
        table.on('click','.deleteMember',function(){
            var id = $(this).data('id');

            var deleteConfirm = confirm("Are you sure?");
            if (deleteConfirm === true) {
                // AJAX request
                $.ajax({
                    url: 'ajax/member.php',
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
        table.on('click','.editMember',function(){
            var id = $(this).data('id');

            $('#member_id').val(id);

            // AJAX request
            $.ajax({
                url: 'ajax/member.php',
                type: 'post',
                data: {request: 3, id: id},
                dataType: 'json',
                success: function(response){
                    if(response.status == 1){

                        $('#name').val(response.data.e_name);
                        $('#username').val(response.data.username);
                        $('#phone').val(response.data.phone);
                        $('#role').val(response.data.e_role);

                        table.DataTable().ajax.reload();
                    }else{
                        alert("Invalid ID.");
                    }
                }
            });
        });

        //edit network
        $('#btn_save').click(function(){
            var id = $('#member_id').val();

            var name = document.getElementById("name").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("pass").value;
            var phone = document.getElementById("phone").value;
            var role = $('#role option:selected').val();

            if(username !='' && password !='' && role !=''){

                // AJAX request
                $.ajax({
                    url: 'ajax/member.php',
                    type: 'post',
                    data: {
                        request: 4,
                        id: id,
                        e_name: name,
                        username : username,
                        password : password,
                        phone : phone,
                        e_role : role
                    },
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 1){
                            alert(response.message);

                            // Empty and reset the values
                            $('#name').val('');
                            $('#username').val('');
                            $('#pass').val('');
                            $('#phone').val('');
                            $('#network_id').val(0);

                            // Reload DataTable
                            table.DataTable().ajax.reload();

                            // Close modal
                            $('#editMember').modal('toggle');
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
    var name = document.getElementById("mem_name").value;
    var username = document.getElementById("mem_username").value;
    var password = document.getElementById("mem_pass").value;
    var phone = document.getElementById("mem_phone").value;
    var role = $('#mem_role option:selected').val();
    $.ajax({
        type: "post",
        url: "add/addmember.php",
        data: {
            'e_name' : name,
            'username' : username,
            'password' : password,
            'phone' : phone,
            'e_role' : role
        },
        success: function (data) {
            location.reload();
            alert(data)
        }
    })
});

