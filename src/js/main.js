var gismeteoTodayData;
var gismeteoYesterdayData;
var weatherTodayData;
var weatherYesterdayData;

function setContent(dataWithTags) {
	document.getElementById('weather-data-text').innerHTML = dataWithTags;
}

function updateData(data) {
	console.log(143323);
	console.log(data);
	setContent(data);
	return data;
}

function init(data) {
	updateData(data);
}