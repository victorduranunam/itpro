function $()
{
	var elements = new Array();
	for (var i = 0; i < arguments.length; i++)
	{
		var element = arguments[i];
		if (typeof element == 'string')
			element = document.getElementById(element);
		if (arguments.length == 1)
			return element;
		elements.push(element);
	}
	return elements;
}
function validateSearch()
{
	var searchtext = $('searchtext');
	var st = searchtext.value;
	var stc = st.replace(" ", "");
	if(stc == '') { alert ('Please fill in your search text'); searchtext.focus(); return false; }
	if(stc.length == 1) { alert ('Please fill in more than 1 character'); searchtext.focus(); return false; }
	var st1 = st.replace("/", "-");
	var st2 = st1.replace("'", "%27");
	var st3 = st2.replace('"', '%22');
	$('searchtext').value = st3;
	return true;
}
function validateAdvanceSearch()
{
	var c1 = $('animations').checked;
	var c2 = $('glitters').checked;
	var c3 = $('icons').checked;
	var c4 = $('images').checked;
	var searchtext = $('searchtext');
	var st = searchtext.value;
	var stc = st.replace(" ", "");
	if(!c1 && !c2 && !c3 && !c4) { alert ('Please select category'); return false; }
	if(stc == '') { alert ('Please fill in your search text'); searchtext.focus(); return false; }
	if(stc.length == 1) { alert ('Please fill in more than 1 character'); searchtext.focus(); return false; }
	var st1 = st.replace("/", "-");
	var st2 = st1.replace("'", "%27");
	var st3 = st2.replace('"', '%22');
	$('searchtext').value = st3;
	return true;
}
function selectContent(id)
{
	$(id).focus();
	$(id).select();
	var ua = navigator.userAgent;
	if(ua.indexOf('MSIE')!=-1)
	{
		CopiedTxt = document.selection.createRange();
		CopiedTxt.execCommand("Copy");
	}
}