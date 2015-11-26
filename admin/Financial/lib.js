/**
 * CategorysAdapter
 */


function CategorysAdapter(endPoint) {
	this.initAdapter(endPoint);
}

CategorysAdapter.inherits(AdapterBase);



CategorysAdapter.method('getDataMapping', function() {
	return [
		"id",
		"name",
	];
});

CategorysAdapter.method('getHeaders', function() {
	return [
		{ "sTitle": "ID" ,"bVisible":false},
		{ "sTitle": "Name" },
	];
});

CategorysAdapter.method('getFormFields', function() {
	return [
		[ "id", {"label":"ID","type":"hidden","validation":""}],
		[ "name", {"label":"Category Name","type":"text", "required":true ,"validation":"notEmpty"}],
		[ "description", {"label":"Category Description","type":"textarea", "required":false , "validation":"none"}],
		[ "parent_cat", {"label":"Parent Category","type":"select2", "allow-null":true, "null-label":"No Parent" ,"remote-source":[ this.table ,"id","name"]}],
	];
});

CategorysAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=90';
});


/**
 * BenefitsAdapter
 */

function BenefitsAdapter(endPoint) {
	this.initAdapter(endPoint);
}

BenefitsAdapter.inherits(AdapterBase);



BenefitsAdapter.method('getDataMapping', function() {
	return [
		"id",
		"name",
	];
});

BenefitsAdapter.method('getHeaders', function() {
	return [
		{ "sTitle": "ID" ,"bVisible":false},
		{ "sTitle": "Item" },
	];
});

BenefitsAdapter.method('getFormFields', function() {
	return [
<<<<<<< HEAD
		[ "benefitscategory_id", {"label":"Category","type":"select2", "allow-null":false , "remote-source":["benefitscategorys","id","name"]}],
		[ "benefitssubcategory_id", {"label":"Sub Category","type":"select2", "allow-null":false , "remote-source":["benefitscategorys","id","name"]}],
		[ "id", {"label":"ID","type":"hidden","validation":""}],
		[ "name", {"label":"Item Name","type":"text", "required":true ,"validation":"notEmpty"}],
		];
=======
		[ "id", {"label":"ID","type":"hidden","validation":""}],
		[ "name", {"label":"Item Name","type":"text", "required":true ,"validation":"notEmpty"}],
		[ "benefitscategory_id", {"label":"Category","type":"select2", "allow-null":false , "remote-source":["benefitscategorys","id","name"]}],
	];
>>>>>>> 4da1ae57504ec67f9e28ed7132fd6b88773688c8
});

BenefitsAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=90';
});


/**
 * AdvantagesAdapter
 */

function AdvantagesAdapter(endPoint) {
	this.initAdapter(endPoint);
}

AdvantagesAdapter.inherits(AdapterBase);

AdvantagesAdapter.method('getDataMapping', function() {
    return [
        "id",
        "name",
    ];
});

AdvantagesAdapter.method('getHeaders', function() {
	return [
		{ "sTitle": "ID" ,"bVisible":false},
		{ "sTitle": "Item" },
	];
});

AdvantagesAdapter.method('getFormFields', function() {
	return [
<<<<<<< HEAD
		[ "advantagescategorys_id", {"label":"Category","type":"select2", "allow-null":false , "remote-source":["advantagescategorys","id","name"]}],
		[ "advantagessubcategorys_id", {"label":"Sub Category","type":"select2", "allow-null":false , "remote-source":["advantagescategorys","id","name"]}],
=======
>>>>>>> 4da1ae57504ec67f9e28ed7132fd6b88773688c8
		[ "id", {"label":"ID","type":"hidden","validation":""}],
		[ "name", {"label":"Item Name","type":"text", "required":true ,"validation":"notEmpty"}],
		[ "depreciation_time", {"label":"Depreciation Date","type":"date", "required":true ,"validation":""}],
		[ "depreciation_percentage", {"label":"Depreciation percentage %","type":"text", "required":true ,"validation":"postiveNumber"}],
		[ "image", {"label":"Item Image","type":"fileupload", "required":false ,"validation":"none"}],
<<<<<<< HEAD
=======
		[ "advantagescategorys_id", {"label":"Category","type":"select2", "allow-null":false , "remote-source":["advantagescategorys","id","name"]}],
>>>>>>> 4da1ae57504ec67f9e28ed7132fd6b88773688c8
	];
});

AdvantagesAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=90';
});

<<<<<<< HEAD

=======
>>>>>>> 4da1ae57504ec67f9e28ed7132fd6b88773688c8
/**
 * AllowancesAdapter
 */

function AllowancesAdapter(endPoint) {
    this.initAdapter(endPoint);
}

AllowancesAdapter.inherits(AdapterBase);

AllowancesAdapter.method('getDataMapping', function() {
    return [
        "id",
        "name",
    ];
});

AllowancesAdapter.method('getHeaders', function() {
    return [
        { "sTitle": "ID" ,"bVisible":false},
        { "sTitle": "Item" },
    ];
});

AllowancesAdapter.method('getFormFields', function() {
    return [
<<<<<<< HEAD
		[ "allowancescategory_id", {"label":"Category","type":"select2", "allow-null":false , "remote-source":["allowancescategorys","id","name"]}],
		[ "allowancessubcategory_id", {"label":"Sub Category","type":"select2", "allow-null":false , "remote-source":["allowancescategorys","id","name"]}],
		[ "id", {"label":"ID","type":"hidden","validation":""}],
        [ "name", {"label":"Item Name","type":"text", "required":true ,"validation":"notEmpty"}],
       ];
=======
        [ "id", {"label":"ID","type":"hidden","validation":""}],
        [ "name", {"label":"Item Name","type":"text", "required":true ,"validation":"notEmpty"}],
        [ "allowancescategory_id", {"label":"Category","type":"select2", "allow-null":false , "remote-source":["allowancescategorys","id","name"]}],
    ];
>>>>>>> 4da1ae57504ec67f9e28ed7132fd6b88773688c8
});

AllowancesAdapter.method('getHelpLink', function () {
    return 'http://blog.icehrm.com/?page_id=90';
});


