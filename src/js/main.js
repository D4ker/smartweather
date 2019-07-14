var gismeteoTodayData;
var gismeteoYesterdayData;
var weatherTodayData;
var weatherYesterdayData;

function getDataWithTags(data) {
	stringArrayOfWindDirection = [
		'С', 'ССВ', 'СВ', 'ВСВ', 'В', 'ВЮВ', 'ЮВ', 'ЮЮВ', 'Ю', 
		'ЮЮЗ', 'ЮЗ', 'ЗЮЗ', 'З', 'ЗСЗ', 'СЗ', 'ССЗ', 'Штиль'
	];
	dataWithTags = '';
	for (i = 0; i < data.length; i++) {
		dataWithTags += '<p>' + data[i]['time'] + ' ' + data[i]['temperature'] + ' ' + 
		data[i]['wind_value'] + ' ' + stringArrayOfWindDirection[data[i]['wind_direction']] + ' ' + 
		data[i]['humidity'] + '</p>';
	}
	return dataWithTags;
}

function setContent(dataWithTags) {
	document.getElementById('weather-data').innerHTML = dataWithTags;
}

function updateData(data) {
	console.log(143323);
	console.log(data);
	gismeteoTodayData = getDataWithTags(data['gismeteo_today_data']);
	gismeteoYesterdayData = getDataWithTags(data['gismeteo_yesterday_data']);
	weatherTodayData = getDataWithTags(data['weather_today_data']);
	weatherYesterdayData = getDataWithTags(data['weather_yesterday_data']);
	setContent(gismeteoTodayData);
}