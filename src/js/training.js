var baseData;
var userData;
var userClothes;

function setContent(id, dataWithTags) {
	document.getElementById(id).innerHTML = dataWithTags;
};

function setSelectionsOfCities(arrayOfCities) {
	selectionsWithTags = '';
	for (i = 0; i < arrayOfCities.length; i++) {
		selectionsWithTags += '<option>' + arrayOfCities[i] + '</option>';
	}
	setContent('city', selectionsWithTags);
};

function setSelectionsOfTimes() {
	selectionsWithTags = '';
	for (i = 0; i < 24; i++) {
		selectionsWithTags += '<option>' + i + ':00</option>';
	}
	setContent('time', selectionsWithTags);
};

function setSelectionsOfWindDirections() {
	stringArrayOfWindDirection = [
		'С', 'ССВ', 'СВ', 'ВСВ', 'В', 'ВЮВ', 'ЮВ', 'ЮЮВ', 'Ю', 
		'ЮЮЗ', 'ЮЗ', 'ЗЮЗ', 'З', 'ЗСЗ', 'СЗ', 'ССЗ', 'Штиль'
	];
	selectionsWithTags = '';
	for (i = 0; i < stringArrayOfWindDirection.length; i++) {
		selectionsWithTags += '<option>' + stringArrayOfWindDirection[i] + '</option>';
	}
	setContent('wind-direction', selectionsWithTags);
};

function setSelectionsOfClothes(arrayOfClothes) {
	selectionsWithTags = '';
	for (i = 0; i < arrayOfClothes.length; i++) {
		selectionsWithTags += '<option>' + arrayOfClothes[i] + '</option>';
	}
	setContent('clothes', selectionsWithTags);
};

function updateSelections(arrayOfCities, arrayOfClothes) {
	console.log(arrayOfCities);
	console.log(arrayOfClothes);
	userClothes = arrayOfClothes;

	setSelectionsOfCities(arrayOfCities);
	setSelectionsOfTimes();
	setSelectionsOfWindDirections();
	setSelectionsOfClothes(arrayOfClothes);
};

function updateTables(baseData, userData) {
	//baseData = getDataWithTags();
	//userData = getDataWithTags();
};

function updateCategories(categories) {
	
};