var baseDataWithTags;
var userDataWithTags;

function setContent(id, dataWithTags) {
	document.getElementById(id).innerHTML = dataWithTags;
};

function setSelectionsOfCities(arrayOfCities) {
	let selectionsWithTags = '<option>Выберете город</option>';
	for (i = 0; i < arrayOfCities.length; i++) {
		let currentRecord = arrayOfCities[i];
		selectionsWithTags += '<option value="' + currentRecord['id'] + '">' + currentRecord['name_ru'] + '</option>';
	}
	setContent('city', selectionsWithTags);
};

function setSelectionsOfTimes() {
	let selectionsWithTags = '<option>Выберете время</option>';
	for (i = 0; i < 24; i++) {
		selectionsWithTags += '<option value="' + i + '">' + i + ':00</option>';
	}
	setContent('time', selectionsWithTags);
};

function setSelectionsOfWindDirections() {
	let stringArrayOfWindDirection = [
		'С', 'ССВ', 'СВ', 'ВСВ', 'В', 'ВЮВ', 'ЮВ', 'ЮЮВ', 'Ю', 
		'ЮЮЗ', 'ЮЗ', 'ЗЮЗ', 'З', 'ЗСЗ', 'СЗ', 'ССЗ', 'Штиль'
	];
	let selectionsWithTags = '<option>Выберете направление ветра</option>';
	for (i = 0; i < stringArrayOfWindDirection.length; i++) {
		selectionsWithTags += '<option value="' + i + '">' + stringArrayOfWindDirection[i] + '</option>';
	}
	setContent('wind-direction', selectionsWithTags);
};

function setSelectionsOfClothes(arrayOfcategories, arrayOfClothes) {
	let optgroupsWithTags = '<option>Выберете одежду</option>';
	for (i = 0; i < arrayOfcategories.length; i++) {
		let currentRecord = arrayOfcategories[i];
		optgroupsWithTags += '<optgroup id="category-' + currentRecord['id'] + '" label="' + currentRecord['name'] + '"></optgroup>';
	}
	setContent('clothes', optgroupsWithTags);

	let optionsWithTags = '';
	for (i = 0; i < arrayOfClothes.length; i++) {
		let currentRecord = arrayOfClothes[i];
		optionsWithTags = '<option value="' + currentRecord['clothes_id'] + '">' + currentRecord['name'] + '</option>';
		setContent('category-' + currentRecord['category_id'], optionsWithTags);
	}
};

function updateSelections(arrayOfCities, arrayOfcategories, arrayOfClothes) {
	console.log(arrayOfCities);
	console.log(arrayOfClothes);

	setSelectionsOfCities(arrayOfCities);
	setSelectionsOfTimes();
	setSelectionsOfWindDirections();
	setSelectionsOfClothes(arrayOfcategories, arrayOfClothes);
};

function getDataWithTags(data) {
	let stringArrayOfWindDirection = [
		'С', 'ССВ', 'СВ', 'ВСВ', 'В', 'ВЮВ', 'ЮВ', 'ЮЮВ', 'Ю', 
		'ЮЮЗ', 'ЮЗ', 'ЗЮЗ', 'З', 'ЗСЗ', 'СЗ', 'ССЗ', 'Штиль'
	];
	let dataWithTags = '';
	for (i = 0; i < data.length; i++) {
		dataWithTags += '<tr><td class="city">' + data[i]['time'] + 
		'</td><td class="time">' + data[i]['time'] + 
		':00</td><td class="temperature">' + data[i]['temperature'] + 
		'</td><td class="wind-value">' + data[i]['wind_value'] + 
		'</td><td class="wind-direction">' + stringArrayOfWindDirection[data[i]['wind_direction']] + 
		'</td><td class="humidity">' + data[i]['humidity'] + '</td></tr>';
	}
	return dataWithTags;
};

function printTable(tableNum) {
	let tableHead;
	if (tableNum === 0) {
		tableHead = '<tr><th>Город</th>' + 
		'<th>Время</th>' + 
		'<th>Tемпература,&nbsp;°C</th>' + 
		'<th>Ветер, м/с</th>' + 
		'<th>Направление ветра</th>' + 
		'<th>Влажность, %</th>' + 
		'<th>Одежда</th></tr>';
	} else if (tableNum === 1) {
		tableHead = '<tr><th>Категория</th>' + 
		'<th>Одежда</th></tr>';
	}
	setContent('data-head', tableHead);

};

function updateTables(baseData, userData) {
	//baseData = getDataWithTags();
	//userData = getDataWithTags();
};

function updateCategories(arrayOfcategories) {
	
};

function updateData(data) {
	console.log(data);
	let cities = data['cities'];
	let clothes = data['user_clothes'];
	let baseData = data['base_data'];
	let userData = data['user_data'];
	let categories = data['clothes_category'];

	updateSelections(cities, categories, clothes);
	updateTables(baseData, userData);
	updateCategories(categories);
}