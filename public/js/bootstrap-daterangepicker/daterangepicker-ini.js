$('#date_range').daterangepicker();
$('#daterange-btn').daterangepicker({
		ranges: {
			'Hoy': [moment(), moment()],
			'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Ultimos 7 días': [moment().subtract(6, 'days'), moment()],
			'Ultimos 30 días': [moment().subtract(29, 'days'), moment()],
			'Este mes': [moment().startOf('month'), moment().endOf('month')],
			'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		}
	},
	function (start, end) {
		$('#date').val('range');
		$('#daterange-btn span').html(start.format('Y-M-D') + ' - ' + end.format('Y-M-D'));
		if (start.format('Y-M-D') === moment().format('Y-M-D') && end.format('Y-M-D') === moment().format('Y-M-D')) {
            $('#date').val('today');
		}
		if (start.format('Y-M-D') === moment().subtract(1, 'days').format('Y-M-D') && end.format('Y-M-D') === moment().subtract(1, 'days').format('Y-M-D')) {
            $('#date').val('yesterday');
		}
		$('#date_end').val(end.format('Y-M-D'));
		  $('#date_start').val(start.format('Y-M-D'));
		  $('.dateranger').submit();
	}
);
