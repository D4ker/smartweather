var baseDataWithTags;
var userDataWithTags;

var userClothesWithTags;

function setContent(id, dataWithTags) {
	document.getElementById(id).innerHTML = dataWithTags;
};

function setSelectionsOfCities(arrayOfCities) {
	let selectionsWithTags = '<option>Выберете город</option>';
	for (let i = 0; i < arrayOfCities.length; i++) {
		let currentRecord = arrayOfCities[i];
		selectionsWithTags += '<option value="' + currentRecord['id'] + '">' + currentRecord['name_ru'] + '</option>';
	}
	setContent('city', selectionsWithTags);
};

function setSelectionsOfTimes() {
	let selectionsWithTags = '<option>Выберете время</option>';
	for (let i = 0; i < 24; i++) {
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
	for (let i = 0; i < stringArrayOfWindDirection.length; i++) {
		selectionsWithTags += '<option value="' + i + '">' + stringArrayOfWindDirection[i] + '</option>';
	}
	setContent('wind-direction', selectionsWithTags);
};

function setSelectionsOfClothes(arrayOfcategories, arrayOfClothes) {
	let optgroupsWithTags = '<option>Выберете одежду</option>';
	for (let i = 0; i < arrayOfcategories.length; i++) {
		let currentRecord = arrayOfcategories[i];
		optgroupsWithTags += '<optgroup id="category-' + currentRecord['id'] + '" label="' + currentRecord['name'] + '"></optgroup>';
	}
	setContent('clothes', optgroupsWithTags);

	for (let i = 0; i < arrayOfClothes.length; i++) {
		let currentRecord = arrayOfClothes[i];
		let optionsWithTags = '<option value="' + currentRecord['clothes_id'] + '">' + currentRecord['clothes_name'] + '</option>';
		setContent('category-' + currentRecord['category_id'], optionsWithTags);
	}
};

function updateSelections(arrayOfCities, arrayOfcategories, arrayOfClothes) {
	setSelectionsOfCities(arrayOfCities);
	setSelectionsOfTimes();
	setSelectionsOfWindDirections();
	setSelectionsOfClothes(arrayOfcategories, arrayOfClothes);
};

function printTable(tableNum) {
	let tableHead;
	let tableData;
	if (tableNum === 0) {
		tableHead = '<tr><th>Город</th>' + 
		'<th>Время</th>' + 
		'<th>Tемпература, °C</th>' + 
		'<th>Ветер, м/с</th>' + 
		'<th>Направление ветра</th>' + 
		'<th>Влажность, %</th>' + 
		'<th>Одежда</th></tr>';
		tableData = userDataWithTags;
	} else if (tableNum === 1) {
		tableHead = '<tr><th>Категория</th>' + 
		'<th>Одежда</th></tr>';
		tableData = userClothesWithTags;
	}
	setContent('data-head', tableHead);
	setContent('data', tableData);
};

function getFieldValueByFieldValue(array, soughtOutField, searchingField, value) {
	for (let i = 0; i < array.length; i++) {
		let currentRecord = array[i];
		if (currentRecord[searchingField] === value) {
			return currentRecord[soughtOutField];
		}
	}
	return '';
}

function getUserDataWithTags(data, cities, clothes) {
	let stringArrayOfWindDirection = [
		'С', 'ССВ', 'СВ', 'ВСВ', 'В', 'ВЮВ', 'ЮВ', 'ЮЮВ', 'Ю', 
		'ЮЮЗ', 'ЮЗ', 'ЗЮЗ', 'З', 'ЗСЗ', 'СЗ', 'ССЗ', 'Штиль'
	];
	let dataWithTags = '';
	for (let i = 0; i < data.length; i++) {
		let city = getFieldValueByFieldValue(cities, 'name_ru', 'id', data[i]['city_id']);
		if (city === null) city = '';

		let time = data[i]['time'];
		time = (time === null) ? '' : time + ':00';

		let windValue = data[i]['wind_value'];
		if (windValue === null) windValue = '';

		let windDirection = stringArrayOfWindDirection[data[i]['wind_direction']];
		if (windDirection === undefined) windDirection = '';

		let humidity = data[i]['humidity'];
		if (humidity === null) humidity = '';

		dataWithTags += '<tr><td class="city">' + city + 
		'</td><td class="time">' + time + 
		'</td><td class="temperature">' + data[i]['temperature'] + 
		'</td><td class="wind-value">' + windValue + 
		'</td><td class="wind-direction">' + windDirection + 
		'</td><td class="humidity">' + humidity + 
		'</td><td class="user-clothes">' + 
		getFieldValueByFieldValue(clothes, 'clothes_name', 'clothes_id', data[i]['clothes_id']) + '</td></tr>';
	}
	return dataWithTags;
};

function getUserClothesWithTags(categories, clothes) {
	let dataWithTags = '';
	for (let i = 0; i < clothes.length; i++) {
		dataWithTags += '<tr><td class="category">' + 
		getFieldValueByFieldValue(categories, 'name', 'id', clothes[i]['category_id']) + 
		'</td><td class="user-clothes">' + clothes[i]['clothes_name'] + '</td></tr>';
	}
	return dataWithTags;
};

function updateTables(baseData, userData, clothes, cities, categories) {
	//baseData = getBaseDataWithTags(baseData);
	userDataWithTags = getUserDataWithTags(userData, cities, clothes);
	userClothesWithTags = getUserClothesWithTags(categories, clothes);
};

function updateData(data) {
	console.log(data);
	let cities = data['cities'];
	let clothes = data['user_clothes'];
	let baseData = data['base_data'];
	let userData = data['user_data'];
	let categories = data['clothes_category'];

	updateSelections(cities, categories, clothes);
	updateTables(baseData, userData, clothes, cities, categories);
}