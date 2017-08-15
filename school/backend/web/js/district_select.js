/**
 *      lonely (C) Lodov.com
 *
 *      $Id: areaselect.js [1] 2011-07-13
 */

function apend_options(obj,val,text)
{
	obj.options.add(new Option(text,val))
}

function clear_options(obj)
{
	for(var i = 0,len = obj.options.length; i < len; i++){
		obj.options[0] = null;
	}
	obj.options.add(new Option(pleaseselect,0));
}

function load_district(){

	if($('lodov_province').options[1]){
		return ;	
	}
	for(var i in province){
		apend_options($('lodov_province'),i,province[i]);
	}
	_attachEvent($('lodov_province'), 'change', function(){
		var province = $('lodov_province').value;
		$('province_val').value = $('lodov_province').options[$('lodov_province').selectedIndex].text;
		var e = $('lodov_city');
		e.options.length = 0;
		e.options.add(new Option(pleaseselect,0));
		for(var i in city[province]){
			apend_options(e,i,city[province][i]);
		}
		$('city_val').value = '';
		$('town_val').value = '';
		clear_options($('lodov_town'));
	});
	_attachEvent($('lodov_city'), 'change', function(){
		var city = $('lodov_city').value;
		$('city_val').value = $('lodov_city').options[$('lodov_city').selectedIndex].text;
		var e = $('lodov_town');
		e.options.length = 0;
		e.options.add(new Option(pleaseselect,0));
		for(var i in area[city]){
			apend_options(e,i,area[city][i]);
		}
	});
	_attachEvent($('lodov_town'), 'change', function(){
		$('town_val').value = $('lodov_town').options[$('lodov_town').selectedIndex].text;
	});
}