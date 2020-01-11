var line = new Morris.Line({
	element          : 'line-chart',
	resize           : true,
	data             : [
		{ y: '2016 Q1', item1: 2666 },
		{ y: '2016 Q2', item1: 2778 },
		{ y: '2016 Q3', item1: 4912 },
		{ y: '2016 Q4', item1: 3767 },
		{ y: '2017 Q1', item1: 6810 },
		{ y: '2017 Q2', item1: 5670 },
		{ y: '2017 Q3', item1: 4820 },
		{ y: '2017 Q4', item1: 15073 },
		{ y: '2018 Q1', item1: 10687 },
		{ y: '2018 Q2', item1: 8432 }
	],
	xkey             : 'y',
	ykeys            : ['item1'],
	labels           : ['Item 1'],
	lineColors       : ['#efefef'],
	lineWidth        : 2,
	hideHover        : 'auto',
	gridTextColor    : '#fff',
	gridStrokeWidth  : 0.4,
	pointSize        : 4,
	pointStrokeColors: ['#efefef'],
	gridLineColor    : '#efefef',
	gridTextFamily   : 'Open Sans',
	gridTextSize     : 10
});