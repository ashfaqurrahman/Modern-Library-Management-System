if ($.fn.pagination){
	$.fn.pagination.defaults.beforePageText = 'पृष्ठ';
	$.fn.pagination.defaults.afterPageText = ' {pages} का ';
	$.fn.pagination.defaults.displayMsg = '{from} को {to} - कुल {total}';
}
if ($.fn.datagrid){
	$.fn.datagrid.defaults.loadMsg = 'प्रसंस्करण...';
}
if ($.fn.treegrid && $.fn.datagrid){
	$.fn.treegrid.defaults.loadMsg = $.fn.datagrid.defaults.loadMsg;
}
if ($.messager){
	$.messager.defaults.ok = 'ठीक है';
	$.messager.defaults.cancel = 'रद्द करना';
}
$.map(['validatebox','textbox','filebox','searchbox',
		'combo','combobox','combogrid','combotree',
		'datebox','datetimebox','numberbox',
		'spinner','numberspinner','timespinner','datetimespinner'], function(plugin){
	if ($.fn[plugin]){
		$.fn[plugin].defaults.missingMessage = 'यह फ़ील्ड आवश्यक है ।';
	}
});
if ($.fn.validatebox){
	$.fn.validatebox.defaults.rules.email.message = 'कृपया एक मान्य ईमेल पता दें ।';
	$.fn.validatebox.defaults.rules.url.message = 'कृपया एक मान्य URL दें ।';
	$.fn.validatebox.defaults.rules.length.message = 'के बीच एक मान दर्ज करें {0} और {1} ।';
	$.fn.validatebox.defaults.rules.remote.message = 'इस जानकारी ठीक करें।';
}
if ($.fn.calendar){
	$.fn.calendar.defaults.weeks = ['S','M','T','W','T','F','S'];
	$.fn.calendar.defaults.months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
}
if ($.fn.datebox){
	$.fn.datebox.defaults.currentText = 'आज';
	$.fn.datebox.defaults.closeText = 'बंद';
	$.fn.datebox.defaults.okText = 'ठीक है';
}
if ($.fn.datetimebox && $.fn.datebox){
	$.extend($.fn.datetimebox.defaults,{
		currentText: $.fn.datebox.defaults.currentText,
		closeText: $.fn.datebox.defaults.closeText,
		okText: $.fn.datebox.defaults.okText
	});
}
