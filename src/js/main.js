var gismeteoTodayData;
var gismeteoYesterdayData;
var weatherTodayData;
var weatherYesterdayData;

var currentSite;

function setSite(siteName) {
	currentSite = siteName;
	printData(0);
}

function printData(numberOfDay) {
	if (currentSite === 'gismeteo') {
		if (numberOfDay === -1) {
			setContent(gismeteoYesterdayData);
		} else if (numberOfDay === 0) {
			setContent(gismeteoTodayData);
		}
	} else if (currentSite === 'weather') {
		if (numberOfDay === -1) {
			setContent(weatherYesterdayData);
		} else if (numberOfDay === 0) {
			setContent(weatherTodayData);
		}
	}
};

function getDataWithTags(data) {
	let stringArrayOfWindDirection = [
		'С', 'ССВ', 'СВ', 'ВСВ', 'В', 'ВЮВ', 'ЮВ', 'ЮЮВ', 'Ю', 
		'ЮЮЗ', 'ЮЗ', 'ЗЮЗ', 'З', 'ЗСЗ', 'СЗ', 'ССЗ', 'Штиль'
	];
	let dataWithTags = '';
	for (i = 0; i < data.length; i++) {
		dataWithTags += '<tr><td class="time">' + data[i]['time'] + 
		':00</td><td class="temperature">' + data[i]['temperature'] + 
		'</td><td class="wind-value">' + data[i]['wind_value'] + 
		'</td><td class="wind-direction">' + stringArrayOfWindDirection[data[i]['wind_direction']] + 
		'</td><td class="humidity">' + data[i]['humidity'] + '</td></tr>';
	}
	return dataWithTags;
};

function setContent(dataWithTags) {
	document.getElementById('data').innerHTML = dataWithTags;
};

function updateData(data) {
	console.log(data);
	gismeteoTodayData = getDataWithTags(data['gismeteo_today_data']);
	gismeteoYesterdayData = getDataWithTags(data['gismeteo_yesterday_data']);
	weatherTodayData = getDataWithTags(data['weather_today_data']);
	weatherYesterdayData = getDataWithTags(data['weather_yesterday_data']);
	setSite('gismeteo');
};