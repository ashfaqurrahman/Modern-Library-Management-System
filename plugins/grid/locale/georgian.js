if ($.fn.pagination){
	$.fn.pagination.defaults.beforePageText = 'გვერდი';
	$.fn.pagination.defaults.afterPageText = '{pages}ის';
	$.fn.pagination.defaults.displayMsg = 'ჩვენება {from} დან {to} {total} წიგნიდან';
}
if ($.fn.datagrid){
	$.fn.datagrid.defaults.loadMsg = 'მიმდინარეობს დამუშავება, გთხოვთ დაელოდეთ ...';
}
if ($.fn.treegrid && $.fn.datagrid){
	$.fn.treegrid.defaults.loadMsg = $.fn.datagrid.defaults.loadMsg;
}
if ($.messager){
	$.messager.defaults.ok = 'დიახ';
	$.messager.defaults.cancel = 'გაუქმება';
}
$.map(['validatebox','textbox','filebox','searchbox',
		'combo','combobox','combogrid','combotree',
		'datebox','datetimebox','numberbox',
		'spinner','numberspinner','timespinner','datetimespinner'], function(plugin){
	if ($.fn[plugin]){
		$.fn[plugin].defaults.missingMessage = 'ეს ველი სავალდებულოა.';
	}
});
if ($.fn.validatebox){
	$.fn.validatebox.defaults.rules.email.message = 'გთხოვთ შეიყვანოთ რეალური email მისამართი.';
	$.fn.validatebox.defaults.rules.url.message = 'გთხოვთ შეიყვანოთ რეალური URL.';
	$.fn.validatebox.defaults.rules.length.message = 'გთხოვთ შეიყვანოთ მნიშვნელობა დიაპაზონში {0} და {1}.';
	$.fn.validatebox.defaults.rules.remote.message = 'გთხოვთ შეასწორეთ ველი';
}
if ($.fn.calendar){
	$.fn.calendar.defaults.weeks = ['კ','ო','ს','ო','ხ','პ','შ'];
	$.fn.calendar.defaults.months = ['იან', 'თებ', 'მარ', 'აპრ', 'მაი', 'ივნ', 'ივლ', 'აგვ', 'სექ', 'ოქტ', 'ნოე', 'დეკ'];
}
if ($.fn.datebox){
	$.fn.datebox.defaults.currentText = 'დღეს';
	$.fn.datebox.defaults.closeText = 'დახურვა';
	$.fn.datebox.defaults.okText = 'თანხმობა';
}
if ($.fn.datetimebox && $.fn.datebox){
	$.extend($.fn.datetimebox.defaults,{
		currentText: $.fn.datebox.defaults.currentText,
		closeText: $.fn.datebox.defaults.closeText,
		okText: $.fn.datebox.defaults.okText
	});
}
