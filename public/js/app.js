/*! AdminLTE app.js
* ================
* Main JS application file for AdminLTE v2. This file
* should be included in all pages. It controls some layout
* options and implements exclusive AdminLTE plugins.
*
* @Author  Almsaeed Studio
* @Support <https://www.almsaeedstudio.com>
* @Email   <abdullah@almsaeedstudio.com>
* @version 2.4.0
* @repository git://github.com/almasaeed2010/AdminLTE.git
* @license MIT <http://opensource.org/licenses/MIT>
*/
if("undefined"==typeof jQuery)throw new Error("AdminLTE requires jQuery");+function(a){"use strict";function b(b){return this.each(function(){var e=a(this),g=e.data(c);if(!g){var h=a.extend({},d,e.data(),"object"==typeof b&&b);e.data(c,g=new f(e,h))}if("string"==typeof g){if(void 0===g[b])throw new Error("No method named "+b);g[b]()}})}var c="lte.boxrefresh",d={source:"",params:{},trigger:".refresh-btn",content:".box-body",loadInContent:!0,responseType:"",overlayTemplate:'<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>',onLoadStart:function(){},onLoadDone:function(a){return a}},e={data:'[data-widget="box-refresh"]'},f=function(b,c){if(this.element=b,this.options=c,this.$overlay=a(c.overlay),""===c.source)throw new Error("Source url was not defined. Please specify a url in your BoxRefresh source option.");this._setUpListeners(),this.load()};f.prototype.load=function(){this._addOverlay(),this.options.onLoadStart.call(a(this)),a.get(this.options.source,this.options.params,function(b){this.options.loadInContent&&a(this.options.content).html(b),this.options.onLoadDone.call(a(this),b),this._removeOverlay()}.bind(this),""!==this.options.responseType&&this.options.responseType)},f.prototype._setUpListeners=function(){a(this.element).on("click",e.trigger,function(a){a&&a.preventDefault(),this.load()}.bind(this))},f.prototype._addOverlay=function(){a(this.element).append(this.$overlay)},f.prototype._removeOverlay=function(){a(this.element).remove(this.$overlay)};var g=a.fn.boxRefresh;a.fn.boxRefresh=b,a.fn.boxRefresh.Constructor=f,a.fn.boxRefresh.noConflict=function(){return a.fn.boxRefresh=g,this},a(window).on("load",function(){a(e.data).each(function(){b.call(a(this))})})}(jQuery),function(a){"use strict";function b(b){return this.each(function(){var e=a(this),f=e.data(c);if(!f){var g=a.extend({},d,e.data(),"object"==typeof b&&b);e.data(c,f=new h(e,g))}if("string"==typeof b){if(void 0===f[b])throw new Error("No method named "+b);f[b]()}})}var c="lte.boxwidget",d={animationSpeed:500,collapseTrigger:'[data-widget="collapse"]',removeTrigger:'[data-widget="remove"]',collapseIcon:"fa-minus",expandIcon:"fa-plus",removeIcon:"fa-times"},e={data:".box",collapsed:".collapsed-box",body:".box-body",footer:".box-footer",tools:".box-tools"},f={collapsed:"collapsed-box"},g={collapsed:"collapsed.boxwidget",expanded:"expanded.boxwidget",removed:"removed.boxwidget"},h=function(a,b){this.element=a,this.options=b,this._setUpListeners()};h.prototype.toggle=function(){a(this.element).is(e.collapsed)?this.expand():this.collapse()},h.prototype.expand=function(){var b=a.Event(g.expanded),c=this.options.collapseIcon,d=this.options.expandIcon;a(this.element).removeClass(f.collapsed),a(this.element).find(e.tools).find("."+d).removeClass(d).addClass(c),a(this.element).find(e.body+", "+e.footer).slideDown(this.options.animationSpeed,function(){a(this.element).trigger(b)}.bind(this))},h.prototype.collapse=function(){var b=a.Event(g.collapsed),c=this.options.collapseIcon,d=this.options.expandIcon;a(this.element).find(e.tools).find("."+c).removeClass(c).addClass(d),a(this.element).find(e.body+", "+e.footer).slideUp(this.options.animationSpeed,function(){a(this.element).addClass(f.collapsed),a(this.element).trigger(b)}.bind(this))},h.prototype.remove=function(){var b=a.Event(g.removed);a(this.element).slideUp(this.options.animationSpeed,function(){a(this.element).trigger(b),a(this.element).remove()}.bind(this))},h.prototype._setUpListeners=function(){var b=this;a(this.element).on("click",this.options.collapseTrigger,function(a){a&&a.preventDefault(),b.toggle()}),a(this.element).on("click",this.options.removeTrigger,function(a){a&&a.preventDefault(),b.remove()})};var i=a.fn.boxWidget;a.fn.boxWidget=b,a.fn.boxWidget.Constructor=h,a.fn.boxWidget.noConflict=function(){return a.fn.boxWidget=i,this},a(window).on("load",function(){a(e.data).each(function(){b.call(a(this))})})}(jQuery),function(a){"use strict";function b(b){return this.each(function(){var e=a(this),f=e.data(c);if(!f){var g=a.extend({},d,e.data(),"object"==typeof b&&b);e.data(c,f=new h(e,g))}"string"==typeof b&&f.toggle()})}var c="lte.controlsidebar",d={slide:!0},e={sidebar:".control-sidebar",data:'[data-toggle="control-sidebar"]',open:".control-sidebar-open",bg:".control-sidebar-bg",wrapper:".wrapper",content:".content-wrapper",boxed:".layout-boxed"},f={open:"control-sidebar-open",fixed:"fixed"},g={collapsed:"collapsed.controlsidebar",expanded:"expanded.controlsidebar"},h=function(a,b){this.element=a,this.options=b,this.hasBindedResize=!1,this.init()};h.prototype.init=function(){a(this.element).is(e.data)||a(this).on("click",this.toggle),this.fix(),a(window).resize(function(){this.fix()}.bind(this))},h.prototype.toggle=function(b){b&&b.preventDefault(),this.fix(),a(e.sidebar).is(e.open)||a("body").is(e.open)?this.collapse():this.expand()},h.prototype.expand=function(){this.options.slide?a(e.sidebar).addClass(f.open):a("body").addClass(f.open),a(this.element).trigger(a.Event(g.expanded))},h.prototype.collapse=function(){a("body, "+e.sidebar).removeClass(f.open),a(this.element).trigger(a.Event(g.collapsed))},h.prototype.fix=function(){a("body").is(e.boxed)&&this._fixForBoxed(a(e.bg))},h.prototype._fixForBoxed=function(b){b.css({position:"absolute",height:a(e.wrapper).height()})};var i=a.fn.controlSidebar;a.fn.controlSidebar=b,a.fn.controlSidebar.Constructor=h,a.fn.controlSidebar.noConflict=function(){return a.fn.controlSidebar=i,this},a(document).on("click",e.data,function(c){c&&c.preventDefault(),b.call(a(this),"toggle")})}(jQuery),function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data(c);e||d.data(c,e=new f(d)),"string"==typeof b&&e.toggle(d)})}var c="lte.directchat",d={data:'[data-widget="chat-pane-toggle"]',box:".direct-chat"},e={open:"direct-chat-contacts-open"},f=function(a){this.element=a};f.prototype.toggle=function(a){a.parents(d.box).first().toggleClass(e.open)};var g=a.fn.directChat;a.fn.directChat=b,a.fn.directChat.Constructor=f,a.fn.directChat.noConflict=function(){return a.fn.directChat=g,this},a(document).on("click",d.data,function(c){c&&c.preventDefault(),b.call(a(this),"toggle")})}(jQuery),function(a){"use strict";function b(b){return this.each(function(){var e=a(this),f=e.data(c);if(!f){var h=a.extend({},d,e.data(),"object"==typeof b&&b);e.data(c,f=new g(h))}if("string"==typeof b){if(void 0===f[b])throw new Error("No method named "+b);f[b]()}})}var c="lte.layout",d={slimscroll:!0,resetHeight:!0},e={wrapper:".wrapper",contentWrapper:".content-wrapper",layoutBoxed:".layout-boxed",mainFooter:".main-footer",mainHeader:".main-header",sidebar:".sidebar",controlSidebar:".control-sidebar",fixed:".fixed",sidebarMenu:".sidebar-menu",logo:".main-header .logo"},f={fixed:"fixed",holdTransition:"hold-transition"},g=function(a){this.options=a,this.bindedResize=!1,this.activate()};g.prototype.activate=function(){this.fix(),this.fixSidebar(),a("body").removeClass(f.holdTransition),this.options.resetHeight&&a("body, html, "+e.wrapper).css({height:"auto","min-height":"100%"}),this.bindedResize||(a(window).resize(function(){this.fix(),this.fixSidebar(),a(e.logo+", "+e.sidebar).one("webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",function(){this.fix(),this.fixSidebar()}.bind(this))}.bind(this)),this.bindedResize=!0),a(e.sidebarMenu).on("expanded.tree",function(){this.fix(),this.fixSidebar()}.bind(this)),a(e.sidebarMenu).on("collapsed.tree",function(){this.fix(),this.fixSidebar()}.bind(this))},g.prototype.fix=function(){a(e.layoutBoxed+" > "+e.wrapper).css("overflow","hidden");var b=a(e.mainFooter).outerHeight()||0,c=a(e.mainHeader).outerHeight()+b,d=a(window).height(),g=a(e.sidebar).height()||0;if(a("body").hasClass(f.fixed))a(e.contentWrapper).css("min-height",d-b);else{var h;d>=g?(a(e.contentWrapper).css("min-height",d-c),h=d-c):(a(e.contentWrapper).css("min-height",g),h=g);var i=a(e.controlSidebar);void 0!==i&&i.height()>h&&a(e.contentWrapper).css("min-height",i.height())}},g.prototype.fixSidebar=function(){if(!a("body").hasClass(f.fixed))return void(void 0!==a.fn.slimScroll&&a(e.sidebar).slimScroll({destroy:!0}).height("auto"));this.options.slimscroll&&void 0!==a.fn.slimScroll&&(a(e.sidebar).slimScroll({destroy:!0}).height("auto"),a(e.sidebar).slimScroll({height:a(window).height()-a(e.mainHeader).height()+"px",color:"rgba(0,0,0,0.2)",size:"3px"}))};var h=a.fn.layout;a.fn.layout=b,a.fn.layout.Constuctor=g,a.fn.layout.noConflict=function(){return a.fn.layout=h,this},a(window).on("load",function(){b.call(a("body"))})}(jQuery),function(a){"use strict";function b(b){return this.each(function(){var e=a(this),f=e.data(c);if(!f){var g=a.extend({},d,e.data(),"object"==typeof b&&b);e.data(c,f=new h(g))}"toggle"==b&&f.toggle()})}var c="lte.pushmenu",d={collapseScreenSize:767,expandOnHover:!1,expandTransitionDelay:200},e={collapsed:".sidebar-collapse",open:".sidebar-open",mainSidebar:".main-sidebar",contentWrapper:".content-wrapper",searchInput:".sidebar-form .form-control",button:'[data-toggle="push-menu"]',mini:".sidebar-mini",expanded:".sidebar-expanded-on-hover",layoutFixed:".fixed"},f={collapsed:"sidebar-collapse",open:"sidebar-open",mini:"sidebar-mini",expanded:"sidebar-expanded-on-hover",expandFeature:"sidebar-mini-expand-feature",layoutFixed:"fixed"},g={expanded:"expanded.pushMenu",collapsed:"collapsed.pushMenu"},h=function(a){this.options=a,this.init()};h.prototype.init=function(){(this.options.expandOnHover||a("body").is(e.mini+e.layoutFixed))&&(this.expandOnHover(),a("body").addClass(f.expandFeature)),a(e.contentWrapper).click(function(){a(window).width()<=this.options.collapseScreenSize&&a("body").hasClass(f.open)&&this.close()}.bind(this)),a(e.searchInput).click(function(a){a.stopPropagation()})},h.prototype.toggle=function(){var b=a(window).width(),c=!a("body").hasClass(f.collapsed);b<=this.options.collapseScreenSize&&(c=a("body").hasClass(f.open)),c?this.close():this.open()},h.prototype.open=function(){a(window).width()>this.options.collapseScreenSize?a("body").removeClass(f.collapsed).trigger(a.Event(g.expanded)):a("body").addClass(f.open).trigger(a.Event(g.expanded))},h.prototype.close=function(){a(window).width()>this.options.collapseScreenSize?a("body").addClass(f.collapsed).trigger(a.Event(g.collapsed)):a("body").removeClass(f.open+" "+f.collapsed).trigger(a.Event(g.collapsed))},h.prototype.expandOnHover=function(){a(e.mainSidebar).hover(function(){a("body").is(e.mini+e.collapsed)&&a(window).width()>this.options.collapseScreenSize&&this.expand()}.bind(this),function(){a("body").is(e.expanded)&&this.collapse()}.bind(this))},h.prototype.expand=function(){setTimeout(function(){a("body").removeClass(f.collapsed).addClass(f.expanded)},this.options.expandTransitionDelay)},h.prototype.collapse=function(){setTimeout(function(){a("body").removeClass(f.expanded).addClass(f.collapsed)},this.options.expandTransitionDelay)};var i=a.fn.pushMenu;a.fn.pushMenu=b,a.fn.pushMenu.Constructor=h,a.fn.pushMenu.noConflict=function(){return a.fn.pushMenu=i,this},a(document).on("click",e.button,function(c){c.preventDefault(),b.call(a(this),"toggle")}),a(window).on("load",function(){b.call(a(e.button))})}(jQuery),function(a){"use strict";function b(b){return this.each(function(){var e=a(this),f=e.data(c);if(!f){var h=a.extend({},d,e.data(),"object"==typeof b&&b);e.data(c,f=new g(e,h))}if("string"==typeof f){if(void 0===f[b])throw new Error("No method named "+b);f[b]()}})}var c="lte.todolist",d={onCheck:function(a){return a},onUnCheck:function(a){return a}},e={data:'[data-widget="todo-list"]'},f={done:"done"},g=function(a,b){this.element=a,this.options=b,this._setUpListeners()};g.prototype.toggle=function(a){if(a.parents(e.li).first().toggleClass(f.done),!a.prop("checked"))return void this.unCheck(a);this.check(a)},g.prototype.check=function(a){this.options.onCheck.call(a)},g.prototype.unCheck=function(a){this.options.onUnCheck.call(a)},g.prototype._setUpListeners=function(){var b=this;a(this.element).on("change ifChanged","input:checkbox",function(){b.toggle(a(this))})};var h=a.fn.todoList;a.fn.todoList=b,a.fn.todoList.Constructor=g,a.fn.todoList.noConflict=function(){return a.fn.todoList=h,this},a(window).on("load",function(){a(e.data).each(function(){b.call(a(this))})})}(jQuery),function(a){"use strict";function b(b){return this.each(function(){var e=a(this);if(!e.data(c)){var f=a.extend({},d,e.data(),"object"==typeof b&&b);e.data(c,new h(e,f))}})}var c="lte.tree",d={animationSpeed:500,accordion:!0,followLink:!1,trigger:".treeview a"},e={tree:".tree",treeview:".treeview",treeviewMenu:".treeview-menu",open:".menu-open, .active",li:"li",data:'[data-widget="tree"]',active:".active"},f={open:"menu-open",tree:"tree"},g={collapsed:"collapsed.tree",expanded:"expanded.tree"},h=function(b,c){this.element=b,this.options=c,a(this.element).addClass(f.tree),a(e.treeview+e.active,this.element).addClass(f.open),this._setUpListeners()};h.prototype.toggle=function(a,b){var c=a.next(e.treeviewMenu),d=a.parent(),g=d.hasClass(f.open);d.is(e.treeview)&&(this.options.followLink&&"#"!=a.attr("href")||b.preventDefault(),g?this.collapse(c,d):this.expand(c,d))},h.prototype.expand=function(b,c){var d=a.Event(g.expanded);if(this.options.accordion){var h=c.siblings(e.open),i=h.children(e.treeviewMenu);this.collapse(i,h)}c.addClass(f.open),b.slideDown(this.options.animationSpeed,function(){a(this.element).trigger(d)}.bind(this))},h.prototype.collapse=function(b,c){var d=a.Event(g.collapsed);b.find(e.open).removeClass(f.open),c.removeClass(f.open),b.slideUp(this.options.animationSpeed,function(){b.find(e.open+" > "+e.treeview).slideUp(),a(this.element).trigger(d)}.bind(this))},h.prototype._setUpListeners=function(){var b=this;a(this.element).on("click",this.options.trigger,function(c){b.toggle(a(this),c)})};var i=a.fn.tree;a.fn.tree=b,a.fn.tree.Constructor=h,a.fn.tree.noConflict=function(){return a.fn.tree=i,this},a(window).on("load",function(){a(e.data).each(function(){b.call(a(this))})})}(jQuery);

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

	let params = getQueryParams(window.location.search);
	if(params){
		switch (params['alert']) {
			case 'update_avatar':
			objAlert.strAlertTipe = 'alert-success';
			objAlert.fnGenerate('Foto de perfil actualizado con exito!');
			case 'update_profile':
			objAlert.strAlertTipe = 'alert-success';
			objAlert.fnGenerate('Perfil actualizado con exito!');
			break;
		}
	}
	setTimeout(function(){ preloader.off(); }, 3000);
	
	var area = new Morris.Area({
		element   : 'revenue-chart',
		resize    : true,
		data      : MorrisArea,
		xkey      : 'y',
		ykeys     : ['item1'],
		labels    : ['Pagado'],
		lineColors: ['#a0d0e0'],
		hideHover : 'auto'
	  });
	  $('#tab_3').html($('#dues_chart'));
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