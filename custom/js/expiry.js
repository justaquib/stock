$(document).ready(function() {
	// order date picker
	$("#startDate1").datepicker();
	// order date picker
	$("#endDate1").datepicker();

	$("#getExpiryReportForm").unbind('submit').bind('submit', function() {
		
		var startDate = $("#startDate1").val();
		var endDate = $("#endDate1").val();

		if(startDate == "" || endDate == "") {
			if(startDate == "") {
				$("#startDate1").closest('.form-group').addClass('has-error');
				$("#startDate1").after('<p class="text-danger">The Start Date is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}

			if(endDate == "") {
				$("#endDate1").closest('.form-group').addClass('has-error');
				$("#endDate1").after('<p class="text-danger">The End Date is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}
		} else {
			$(".form-group").removeClass('has-error');
			$(".text-danger").remove();

			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'text',
				success:function(response) {
					var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
	        mywindow.document.write('<html><head><title>Expiry Report Slip</title>');        
	        mywindow.document.write('</head><body>');
	        mywindow.document.write(response);
	        mywindow.document.write('</body></html>');

	        mywindow.document.close(); // necessary for IE >= 10
	        mywindow.focus(); // necessary for IE >= 10

	        mywindow.print();
	        mywindow.close();
				} // /success
			});	// /ajax

		} // /else

		return false;
	});

});