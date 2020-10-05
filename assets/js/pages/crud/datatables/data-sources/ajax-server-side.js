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
				url: 'ajax/history.php',
				type: 'POST',
			},
			columns: [
				{data: 'datetime'},
				{data: 'network_name'},
				{data: 'coins'},
				{data: 'email'},
				{data: 'gaid'},
				{data: 'app_name'},
				{data: 'Actions'},
			]
		});

		//delete history
		table.on('click','.deleteUser',function(){
			var id = $(this).data('id');

			var deleteConfirm = confirm("Are you sure?");
			if (deleteConfirm === true) {
				// AJAX request
				$.ajax({
					url: 'ajax/history.php',
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
