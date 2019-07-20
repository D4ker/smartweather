var baseDataWithTags;
var userDataWithTags;

function setContent(id, dataWithTags) {
	document.getElementById(id).innerHTML = dataWithTags;
};

function setSelectionsOfCities(arrayOfCities) {
	selectionsWithTags = '<option>Выберете город</option>';
	for (i = 0; i < arrayOfCities.length; i++) {
		currentRecord = arrayOfCities[i];
		selectionsWithTags += '<option value="' + currentRecord['id'] + '">' + currentRecord['name_ru'] + '</option>';
	}
	setContent('city', selectionsWithTags);
};

function setSelectionsOfTimes() {
	selectionsWithTags = '<option>Выберете время</option>';
	for (i = 0; i < 24; i++) {
		selectionsWithTags += '<option value="' + i + '">' + i + ':00</option>';
	}
	setContent('time', selectionsWithTags);
};

function setSelectionsOfWindDirections() {
	stringArrayOfWindDirection = [
		'С', 'ССВ', 'СВ', 'ВСВ', 'В', 'ВЮВ', 'ЮВ', 'ЮЮВ', 'Ю', 
		'ЮЮЗ', 'ЮЗ', 'ЗЮЗ', 'З', 'ЗСЗ', 'СЗ', 'ССЗ', 'Штиль'
	];
	selectionsWithTags = '<option>Выберете направление ветра</option>';
	for (i = 0; i < stringArrayOfWindDirection.length; i++) {
		selectionsWithTags += '<option value="' + i + '">' + stringArrayOfWindDirection[i] + '</option>';
	}
	setContent('wind-direction', selectionsWithTags);
};

function setSelectionsOfClothes(arrayOfcategories, arrayOfClothes) {
	optgroupsWithTags = '<option>Выберете одежду</option>';
	for (i = 0; i < arrayOfcategories.length; i++) {
		currentRecord = arrayOfcategories[i];
		optgroupsWithTags += '<optgroup id="category-' + currentRecord['id'] + '" label="' + currentRecord['name'] + '"></optgroup>';
	}
	setContent('clothes', optgroupsWithTags);

	optionsWithTags = '';
	for (i = 0; i < arrayOfClothes.length; i++) {
		currentRecord = arrayOfClothes[i];
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

function updateTables(baseData, userData) {
	//baseData = getDataWithTags();
	//userData = getDataWithTags();
};

function updateCategories(arrayOfcategories) {
	
};

function updateData(data) {
	console.log(data);
	cities = data['cities'];
	clothes = data['user_clothes'];
	baseData = data['base_data'];
	userData = data['user_data'];
	categories = data['clothes_category'];

	updateSelections(cities, categories, clothes);
	updateTables(baseData, userData);
	updateCategories(categories);
}