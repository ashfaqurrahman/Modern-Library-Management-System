if ($.fn.pagination){
	$.fn.pagination.defaults.beforePageText = 'পৃষ্ঠা নং';
	$.fn.pagination.defaults.afterPageText = ' মোট পৃষ্ঠা {pages}';
	$.fn.pagination.defaults.displayMsg = 'মোট {total} টি ফলাফলের মধ্যে {from} থেকে {to} পর্যন্ত দেখানো হচ্ছে';
}
if ($.fn.datagrid){
	$.fn.datagrid.defaults.loadMsg = 'অনুগ্রহ করে অপেক্ষা করুন ...';
}
if ($.fn.treegrid && $.fn.datagrid){
	$.fn.treegrid.defaults.loadMsg = $.fn.datagrid.defaults.loadMsg;
}
if ($.messager){
	$.messager.defaults.ok = 'ঠিক আছে';
	$.messager.defaults.cancel = 'বাতিল';
}
$.map(['validatebox','textbox','filebox','searchbox',
		'combo','combobox','combogrid','combotree',
		'datebox','datetimebox','numberbox',
		'spinner','numberspinner','timespinner','datetimespinner'], function(plugin){
	if ($.fn[plugin]){
		$.fn[plugin].defaults.missingMessage = 'এই তথ্যটি আবশ্যিক ।';
	}
});
if ($.fn.validatebox){
	$.fn.validatebox.defaults.rules.email.message = 'অনুগ্রহ করে বৈধ ইমেইল প্রদান করুন ।';
	$.fn.validatebox.defaults.rules.url.message = 'অনুগ্রহ করে বৈধ URL প্রদান করুন ।';
	$.fn.validatebox.defaults.rules.length.message = 'অনুগ্রহ করে  {0} থেকে {1} এর মধ্যে যেকোন মান প্রদান করুন ।.';
	$.fn.validatebox.defaults.rules.remote.message = 'অনুগ্রহ করে এই তথ্যটি সংশোধন করুন ।';
}
if ($.fn.calendar){
	$.fn.calendar.defaults.weeks = ['রবি','সোম','মঙ্গল','বুধ','বৃহঃ','শুক্র','শনি'];
	$.fn.calendar.defaults.months = ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
}
if ($.fn.datebox){
	$.fn.datebox.defaults.currentText = 'আজ';
	$.fn.datebox.defaults.closeText = 'বন্ধ';
	$.fn.datebox.defaults.okText = 'ঠিক আছে';
}
if ($.fn.datetimebox && $.fn.datebox){
	$.extend($.fn.datetimebox.defaults,{
		currentText: $.fn.datebox.defaults.currentText,
		closeText: $.fn.datebox.defaults.closeText,
		okText: $.fn.datebox.defaults.okText
	});
}
