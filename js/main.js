/* Auto Run */
	$(function() {
		Run();
		Update();
	});
	function Run()
	{
		GetStatsTicketOffice();
		GetStatsTicketProduction();
		GetStatsTicketAccounting();
		GetLogOffice();
		GetLogProduction();
		GetLogAccounting();
		GetStatTicket();
		GetStatDouble();
		NotifyNewTicket();
	}
	function Update()
	{
		setInterval(GetStatsTicketOffice, 3000);
		setInterval(GetStatsTicketProduction, 3000);
		setInterval(GetStatsTicketAccounting, 3000);
		setInterval(GetLogOffice, 3000);
		setInterval(GetLogProduction, 3000);
		setInterval(GetLogAccounting, 3000);
		setInterval(GetStatTicket, 3000);
		setInterval(GetStatDouble, 3000);
		setInterval(NotifyNewTicket, 5000);
	}
/* /Auto Run */
/* Stations */
	/* Office */
		function GetStatsTicketOffice()
		{
			$.ajax({
				url: "../ajax/stations/office/stats.php",
				dataType: "json",
				success: function(data){
					$("#ticket_office_day").html(data.day);
					$("#ticket_office_month").html(data.month);
					$("#ticket_office_total").html(data.total);
				}
			});
		}
		function GetLogOffice()
		{
			$.ajax({
				url: "../ajax/stations/office/log.php",
				dataType: "json",
				success: function(data){
					$("#log_office_connection").html(data.connection);
					$("#log_office_empty").html(data.empty);
					$("#log_office_key").html(data.key);
				}
			});
		}
	/* /Office */
	/* Production */
		function GetStatsTicketProduction()
		{
			$.ajax({
				url: "../ajax/stations/production/stats.php",
				dataType: "json",
				success: function(data){
					$("#ticket_production_day").html(data.day);
					$("#ticket_production_month").html(data.month);
					$("#ticket_production_total").html(data.total);
				}
			});
		}
		function GetLogProduction()
		{
			$.ajax({
				url: "../ajax/stations/production/log.php",
				dataType: "json",
				success: function(data){
					$("#log_production_connection").html(data.connection);
					$("#log_production_empty").html(data.empty);
					$("#log_production_key").html(data.key);
				}
			});
		}
	/* /Production */
	/* Accounting */
		function GetStatsTicketAccounting()
		{
			$.ajax({
				url: "../ajax/stations/accounting/stats.php",
				dataType: "json",
				success: function(data){
					$("#ticket_accounting_day").html(data.day);
					$("#ticket_accounting_month").html(data.month);
					$("#ticket_accounting_total").html(data.total);
				}
			});
		}
		function GetLogAccounting()
		{
			$.ajax({
				url: "../ajax/stations/accounting/log.php",
				dataType: "json",
				success: function(data){
					$("#log_accounting_connection").html(data.connection);
					$("#log_accounting_empty").html(data.empty);
					$("#log_accounting_key").html(data.key);
				}
			});
		}
	/* /Accounting */
/* /Stations */
/* Statistics */
	function GetStatTicket()
	{
		$.ajax({
			url: "../ajax/other/stat.php",
			dataType: "json",
			success: function(data){
				$("#ticket_system_day").html(data.day);
				$("#ticket_system_month").html(data.month);
				$("#ticket_system_total").html(data.total);
			}
		});
	}
/* /Statistics */
/* Find */
	$("#form_find").on("submit", function()
	{
		var id_form = $("#id_form_find");
		var date_form = $("#date_form_find");
		
		if(id_form.val() == "")
		{
			id_form.focus();
		} else if(date_form.val() == "")
		{
			date_form.focus();
		} else
		{
			$.ajax({
				type: "POST",
				url: "../ajax/other/find.php",
				data: {"id": id_form.val(), "date": date_form.val()},
				dataType: "json",
				success: function(data){
					$("#id_result_find").html(data.id);
					$("#idusr_result_find").html(data.idUsr);
					$("#name_result_find").html(data.name);
					$("#time_result_find").html(data.time);
					$("#device_result_find").html(data.device);
					$("#hash_result_find").html(data.hash);
				}
			});
		}
	});
/* /Find */
/* Delete */
	$("#form_delete").on("submit", function()
	{
		var id_form = $("#id_form_delete");
		var date_form = $("#date_form_delete");
		var pass_form = $("#pass_form_delete");
		
		if(id_form.val() == "")
		{
			id_form.focus();
		} else if(date_form.val() == "")
		{
			date_form.focus();
		} else if(pass_form.val() == "")
		{
			pass_form.focus();
		} else
		{
			$.ajax({
				type: "POST",
				url: "../ajax/other/delete.php",
				data: {"id": id_form.val(), "date": date_form.val(), "pass": pass_form.val()},
				dataType: "json",
				success: function(data){
					$.notify(data.status, "info");
				}
			});
		}
	});
/* /Delete */
/* Double */
	function GetStatDouble()
	{
		$.ajax({
			url: "../ajax/other/double.php",
			dataType: "json",
			success: function(data){
				$("#ticket_double_count").html(data.count);
				$("#ticket_double_id").html(data.id);
				$("#ticket_double_idusr").html(data.idUsr);
				$("#ticket_double_name").html(data.name);
				$("#ticket_double_time").html(data.time);
				$("#ticket_double_device").html(data.device);
			}
		});
	}
/* /Double */
/* Notify */
	function NotifyNewTicket()
	{
		$.ajax({
			url: "../ajax/other/notify.php",
			dataType: "json",
			success: function(data){
				$.each(data, function(i, item) {
					$.notify("Выдан " + item.name + " в " + item.time + " на " + item.device, "success");
				});
			}
		});
	}
/* /Notify */