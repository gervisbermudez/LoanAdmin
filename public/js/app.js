(function($) {
	var defaults = {
		position: 'bottom',
		height: '5px',
		col_1: '#159756',
		col_2: '#da4733',
		col_3: '#3b78e7',
		col_4: '#fdba2c',
		fadeIn: 200,
		fadeOut: 200
	}

	$.materialPreloader = function(options) {
		var settings = $.extend({}, defaults, options);
		$template =
			"<div id='materialPreloader' class='load-bar' style='height:" +
			settings.height + ";display:none;" + settings.position +
			":0px'><div class='load-bar-container'><div class='load-bar-base base1' style='background:" +
			settings.col_1 +
			"'><div class='color red' style='background:" + settings.col_2 +
			"'></div><div class='color blue' style='background:" +
			settings.col_3 +
			"'></div><div class='color yellow' style='background:" +
			settings.col_4 +
			"'></div><div class='color green' style='background:" +
			settings.col_1 +
			"'></div></div></div> <div class='load-bar-container'><div class='load-bar-base base2' style='background:" +
			settings.col_1 +
			"'><div class='color red' style='background:" + settings.col_2 +
			"'></div><div class='color blue' style='background:" +
			settings.col_3 +
			"'></div><div class='color yellow' style='background:" +
			settings.col_4 +
			"'></div> <div class='color green' style='background:" +
			settings.col_1 + "'></div> </div> </div> </div>";
		$('body').prepend($template);
		this.on = function() {
			$('#materialPreloader').fadeIn(settings.fadeIn);
		}
		this.off = function() {
			$('#materialPreloader').fadeOut(settings.fadeOut);
		}
	}
}(jQuery));
preloader = new $.materialPreloader({
        position: 'top',
        height: '5px',
        col_1: '#159756',
        col_2: '#da4733',
        col_3: '#3b78e7',
        col_4: '#fdba2c',
        fadeIn: 200,
        fadeOut: 200
    });
preloader.on();

jQuery(document).ready(function($) {
	
	$('.sidebar-menu').tree();
	//$.widget.bridge('uibutton', $.ui.button);
	fnCheckValue();
    objDeleteData.fnIni();
    fnChangeUserStatus();
    if ($('[data-run-dashboard]').length) {
    	fn_dasboard_run();
	};

	$.each(arrCSSload, function(index, element) {
		loadCSS(element);
	});

	$.each(arrJavaScriptload, function(index, element) {
		loadScript(element);
	});

	setTimeout(function(){ preloader.off(); }, 2000);
});

var fn_dasboard_run = function() {
	$.ajax({
		url: '/admin/ajax_get_dashboard_data',
		type: 'POST',
		dataType: 'json',
	})
	.done(function(response) {
		console.log("success");
		$('#usercount').html(response['users_count']);
		$('#clientscount').html(response['clientes_count']);
		$('#loanscount').html(response['prestamos_count']);
		$('#duescount').html(response['cuotas_count']);
		$('#client_this_month b').html(response['clientes_count_this_month']);
		$('#prestamos_count_this_month b').html(response['prestamos_count_this_month']);
		$('#count_dues_down b').html(response['count_dues_down']);
		$('#user_count_month b').html(response['user_count_month']);
		if(response['prestamos_por_mes']){	
		meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
		response_meses = Object.keys(response['prestamos_por_mes']);
		meses_a_grafica = [];
		for (var i = 0; i < response_meses.length; i++) {
			meses_a_grafica.push(meses[(response_meses[i])-1]);
		};
		var arrayData = {
			'meses' : meses_a_grafica,
			'montos' : Object.values(response['prestamos_por_mes']),
			'ganancias' : Object.values(response['ganancias_por_mes'])
		};
		$(function () {
		  'use strict';
		  /* ChartJS
		   * -------
		   * Here we will create a few charts using ChartJS
		   */
		  // -----------------------
		  // - MONTHLY SALES CHART -
		  // -----------------------
		  // Get context with jQuery - using jQuery's .get() method.
		  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
		  // This will get the first returned node in the jQuery collection.
		  var salesChart       = new Chart(salesChartCanvas);
		  var salesChartData = {
		    labels  : arrayData.meses,
		    datasets: [
		      {
		        label               : 'Electronics',
		        fillColor           : 'rgb(210, 214, 222)',
		        strokeColor         : 'rgb(210, 214, 222)',
		        pointColor          : 'rgb(210, 214, 222)',
		        pointStrokeColor    : '#c1c7d1',
		        pointHighlightFill  : '#fff',
		        pointHighlightStroke: 'rgb(220,220,220)',
		        data                : arrayData.montos
		      },
		      {
		        label               : 'Digital Goods',
		        fillColor           : 'rgba(60,141,188,0.9)',
		        strokeColor         : 'rgba(60,141,188,0.8)',
		        pointColor          : '#3b8bba',
		        pointStrokeColor    : 'rgba(60,141,188,1)',
		        pointHighlightFill  : '#fff',
		        pointHighlightStroke: 'rgba(60,141,188,1)',
		        data                : arrayData.ganancias
		      }
		    ]
		  };

		  var salesChartOptions = {
		    // Boolean - If we should show the scale at all
		    showScale               : true,
		    // Boolean - Whether grid lines are shown across the chart
		    scaleShowGridLines      : false,
		    // String - Colour of the grid lines
		    scaleGridLineColor      : 'rgba(0,0,0,.05)',
		    // Number - Width of the grid lines
		    scaleGridLineWidth      : 1,
		    // Boolean - Whether to show horizontal lines (except X axis)
		    scaleShowHorizontalLines: true,
		    // Boolean - Whether to show vertical lines (except Y axis)
		    scaleShowVerticalLines  : true,
		    // Boolean - Whether the line is curved between points
		    bezierCurve             : true,
		    // Number - Tension of the bezier curve between points
		    bezierCurveTension      : 0.3,
		    // Boolean - Whether to show a dot for each point
		    pointDot                : false,
		    // Number - Radius of each point dot in pixels
		    pointDotRadius          : 4,
		    // Number - Pixel width of point dot stroke
		    pointDotStrokeWidth     : 1,
		    // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
		    pointHitDetectionRadius : 20,
		    // Boolean - Whether to show a stroke for datasets
		    datasetStroke           : true,
		    // Number - Pixel width of dataset stroke
		    datasetStrokeWidth      : 2,
		    // Boolean - Whether to fill the dataset with a color
		    datasetFill             : true,
		    // String - A legend template
		    legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
		    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		    maintainAspectRatio     : true,
		    // Boolean - whether to make the chart responsive to window resizing
		    responsive              : true
		  };
		  // Create the line chart
		  salesChart.Line(salesChartData, salesChartOptions);
		  // ---------------------------
		  // - END MONTHLY SALES CHART -
		  // ---------------------------
		});
		$('#loanrangegraph').html('Prestamos y Ganancias: '+meses_a_grafica[0]+' - '+meses_a_grafica[meses_a_grafica.length-1]);

	}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
}

var fnCheckValue = function () {
	$('.fn_checkvalue').on('change', (function(event) {
		var $objTargetElement = $(this);
		var $objFormGroup = $objTargetElement.parents('.form-group');
		if (($objTargetElement.val() != '')) {
		var obj_data = $.parseJSON($objTargetElement.attr('data-action-param'));
		obj_data['value'] = $($objTargetElement).val();
		if ($($objTargetElement).attr('data-value') !== obj_data['value']) {
            var str_segment_url = $($objTargetElement).attr('data-segment-url');
			jQuery.ajax({
			  url: str_segment_url,
			  type: 'POST',
			  dataType: 'json',
			  data: obj_data,
			  success: function(data, textStatus, xhr) {
				 if (data.result) {
				 	objValidateElements.intTipe = 0;
				 	objValidateElements.strMessage[0] = 'Dato registrado';
				 	objValidateElements.fnRun($objFormGroup);
				 }else{
				 	objValidateElements.intTipe = 1;
				 	objValidateElements.fnRun($objFormGroup);
				 }
			  },
			  error: function(xhr, textStatus, errorThrown) {
				 console.log(str_segment_url+': error');
			  }
			});
		}else{
			objValidateElements.fnRemoveElements($objFormGroup);
		}
		}else{
			objValidateElements.intTipe = 0;
			objValidateElements.strMessage[0] = 'Campo requerido';
			objValidateElements.fnRun($objFormGroup);
		}
	}));
	$('.validate-form form').submit(function(event) {
		if($(this).find('.has-error').length){
			return false;
		}
	});
}

var objValidateElements = {
	intTipe : 0, //0 = Error, 1 = Success , 3 = warning
	strErrorTipes : ['error', 'success', 'warning'], // Can be success, error and warning
	strClassTipe : ['has-error' , 'has-success', 'has-warning'], //Can be has-success, has-error and has-warning
	strMessage : ['This input has and Error', 'Success!', 'Warning'], // Can be set custom
	strClassIcon : ['fa-times-circle-o', 'fa-check' , 'fa-bell-o'],
	fnRun : function ($objFormGroup) {
		var $objMessageElement = $(document.createElement('span')).addClass('help-block').html(this.strMessage[this.intTipe]);
		var $objIconElement = $(document.createElement('i')).addClass('fa message '+this.strClassIcon[this.intTipe]).html('&nbsp;');
		this.fnRemoveElements($objFormGroup);
		if (!$objFormGroup.hasClass(this.strClassTipe[this.intTipe])) {
			$objFormGroup.addClass(this.strClassTipe[this.intTipe]);
			$objFormGroup.find('label').prepend($objIconElement);
			$objFormGroup.append($objMessageElement);
		}else{
			$objFormGroup.find('.help-block').html(this.strMessage[this.intTipe]);
		}
	},
	fnRemoveElements : function($objFormGroup){
		$objFormGroup.removeClass('has-error has-success has-warning');
		$objFormGroup.find('i.fa.message, span.help-block').remove();
	}
}

var objAlert = {
	strAlertTipe : 'alert-info', //alert-success, alert-warning, alert-danger
	strAlertTitle : 'Info',
	strAlertIcon : 'fa-info',
	fnGenerate : function(strMessage){
		var $objAlertContainer = $(document.createElement('div')).addClass('alert alert-dismissible '+ this.strAlertTipe);
		$objAlertContainer.append('<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>');
		var $objAlertIconElement = $(document.createElement('i')).addClass('icon fa '+this.strAlertIcon).html('&nbsp;');
		var $ObjAlertTitle = $(document.createElement('h4')).append($objAlertIconElement).append(this.strAlertTitle);
		$objAlertContainer.append($ObjAlertTitle);
		$objAlertContainer.append(strMessage);
		$('.alert-zone').append($objAlertContainer);
	}
}

var objDeleteData = {
	blnRedirect : false,
	strUrl : '/admin/fn_ajax_delete_data/',
	arrParamData : {'table': '', 'id' : [], 'redirect' : false, 'redirectto' : false},
	arrSelectorsTarget : [],
	strIniSelector : '.delete-data',
	strContentTarget : '.col-md-4',
	fnIni : function () {
		$(this.strIniSelector).click(function(event) {
			objDeleteData.fnReset();
			var strSelectorTarget = $(this).parents(objDeleteData.strContentTarget).attr('id');
			var strItemID = $(this).attr('data-value-id');
			var strTable = $(this).attr('data-table-reference');
			objDeleteData.arrSelectorsTarget.push(strSelectorTarget);
			objDeleteData.arrParamData['id'].push(strItemID);
			objDeleteData.arrParamData['table'] = strTable;
			objDeleteData.arrParamData['redirect'] = $(this).attr('data-delete-redirect') || false;
			objDeleteData.arrParamData['redirectto'] = $(this).attr('data-delete-redirectto') || false;

		});
		$('[data-delete-data="run"]').click(function(event) {
			objDeleteData.fnRun();
		});
	},
	fnRun : function () {
		$.ajax({
			url: objDeleteData.strUrl ,
			type: 'POST',
			dataType: 'json',
			data: objDeleteData.arrParamData,
		})
		.done(function(objResponseData) {
			if (objResponseData.result) {
				console.log("success");
				objAlert.strAlertTipe = 'alert-success';
				objAlert.fnGenerate(objResponseData.message);
				console.log(objDeleteData.arrSelectorsTarget);
				for (var i = 0; i < objDeleteData.arrSelectorsTarget.length; i++) {
					console.log('#'+objDeleteData.arrSelectorsTarget[i]);
					$('#'+objDeleteData.arrSelectorsTarget[i]).hide('400', $('#'+objDeleteData.arrSelectorsTarget[i]).remove());
				};
				if (objDeleteData.arrParamData['redirect']) {
					window.location = window.location.origin+'/'+objDeleteData.arrParamData['redirectto'];
				};
			}else{
				objAlert.strAlertTipe = 'alert-danger';
				objAlert.fnGenerate(objResponseData.message);
			}
		})
		.fail(function(objResponseData) {
			objAlert.strAlertTipe = 'alert-danger';
			objAlert.fnGenerate(objResponseData.message);
		})
		.always(function() {
			console.log("complete");
			objDeleteData.fnReset();
		});
	},
	fnReset : function () {
		objDeleteData.arrParamData = {'table': '', 'id' : []};
		objDeleteData.arrSelectorsTarget = [];
	}
}

var objChangeState = {
	strUrl : '/admin/fnChangeState/',
	objParams : {'status' : '1', 'id': '0', 'table' : 'tablename'},
	fnCallBack : false,
	strCurState : false,
	objChangeState : {},
	intFinalStatus : false,
	fnRun : function () {
		return $.ajax({
			url: objChangeState.strUrl,
			type: 'POST',
			dataType: 'json',
			data: objChangeState.objParams,
		})
		.done(function(objResponseData) {
			console.log("success");
			objAlert.strAlertTipe = 'alert-success';
			objAlert.fnGenerate(objResponseData.message);
			objChangeState.fnCallBack();
		})
		.fail(function(objResponseData) {
			console.log("error");
			objAlert.strAlertTipe = 'alert-danger';
			objAlert.fnGenerate("Ha ocurrido un error");
		})
		.always(function() {
			console.log("complete");
		});
	},
	fnReset : function () {
		this.strUrl = '/admin/fnChangeState/';
		this.objStatusParam = {'status' : '1'};
		this.intElementID = '0';
		this.strTableName = 'tablename';
		this.fnCallBack = false;
		this.strCurState = false;
		this.objChangeState = {};
	}
}

var fnChangeUserStatusIcon = function () {
	var $EventElementContentParent = objChangeState.EventElementContentParent;
	var strStatus = objChangeState.strCurState;
	var $icon = $($EventElementContentParent).find('.user-status-icon');
	if (strStatus === '1') {
		$icon.removeClass('fa-lock');
		$icon.addClass('fa-unlock-alt');
		$icon.attr('data-original-title', 'Acceso Permitido');
		$EventElementContentParent.find('.toggle-user-access-menu-item').html('Bloquear');
	}else{
		$icon.removeClass('fa-unlock-alt');
		$icon.addClass('fa-lock');
		$icon.attr('data-original-title', 'Acceso Bloqueado');
		$EventElementContentParent.find('.toggle-user-access-menu-item').html('Desbloquear');
	}
}

var fnChangeUserStatus = function () {
	$('.toggle-user-access').click(function(event) {
		var $EventElementContentParent = $(this).parents('.box.box-widget');
		var $EventElement = $(this);
		var strCurState = $EventElement.attr('data-access');
		var strTableName = $EventElement.attr('data-reference-table');
		var strReferenceID = $EventElement.attr('data-reference-id');
		if (strCurState === '1') {
			strCurState = '0';
		}else{
			strCurState = '1';
		};
		objChangeState.objParams.status = strCurState;
		objChangeState.objParams.table = strTableName;
		objChangeState.objParams.id = strReferenceID;
		objChangeState.EventElementContentParent = $EventElementContentParent;
		objChangeState.strCurState = strCurState;
		$EventElementContentParent.find('[data-access]').attr('data-access', strCurState);
		objChangeState.fnCallBack = fnChangeUserStatusIcon;
		objChangeState.fnRun();
		return false;
	});
};

var loadScript = function loadScript(url, callback){

    var script = document.createElement("script")
    script.type = "text/javascript";

    if (script.readyState){  //IE
        script.onreadystatechange = function(){
            if (script.readyState == "loaded" ||
                    script.readyState == "complete"){
                script.onreadystatechange = null;
               typeof callback === 'function' ? callback() : false ;
            }
        };
    } else {  //Others
        script.onload = function(){
			typeof callback === 'function' ? callback() : false ;
        };
    }

    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
}

var loadCSS = function loadCSS(href){
		var head  	= document.getElementsByTagName('head')[0];
		var link  	= document.createElement('link');
		link.id   	= strRandom();
		link.rel  	= 'stylesheet';
		link.type 	= 'text/css';
		link.href 	= href;
		link.media 	= 'all';
		head.appendChild(link);
}

var strRandom = function strRandom(length) {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  
	for (var i = 0; i < length; i++)
	  text += possible.charAt(Math.floor(Math.random() * possible.length));

	return text;
}

var arrCSSload = [
	BASEURL + FONTSPATH + 'font-awesome/css/font-awesome.min.css',
	BASEURL + FONTSPATH + 'Ionicons/css/ionicons.min.css'
];

var arrJavaScriptload = [
	BASEURL + JSPATH + 'jquery-ui/jquery-ui.min.js',
	BASEURL + JSPATH + 'jquery-slimscroll/jquery.slimscroll.min.js',
	BASEURL + JSPATH + 'fastclick/lib/fastclick.js'
];

var getQueryParams = function getQueryParams(qs) {
    qs = qs.split('+').join(' ');

    let params = [],
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
	}

	return params;
}