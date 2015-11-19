/**
 * Author: Thilina Hasantha
 */

/**
 * ClientAdapter
 */

function ClientAdapter(endPoint,tab,filter,orderBy) {
	this.initAdapter(endPoint,tab,filter,orderBy);
}

ClientAdapter.inherits(AdapterBase);



ClientAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "details",
	        "address",
	        "contact_number"
	];
});

ClientAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID","bVisible":false },
			{ "sTitle": "Name" },
			{ "sTitle": "Details"},
			{ "sTitle": "Address"},
			{ "sTitle": "Contact Number"}
	];
});

ClientAdapter.method('getFormFields', function() {
	if(this.showSave){
		return [
		        [ "id", {"label":"ID","type":"hidden"}],
		        [ "name", {"label":"Name","type":"text"}],
		        [ "details",  {"label":"Details","type":"textarea","validation":"none"}],
		        [ "address",  {"label":"Address","type":"textarea","validation":"none"}],
		        [ "contact_number", {"label":"Contact Number","type":"text","validation":"none"}],
		        [ "contact_email", {"label":"Contact Email","type":"text","validation":"none"}],
		        [ "company_url", {"label":"Company Url","type":"text","validation":"none"}],
		        [ "status", {"label":"Status","type":"select","source":[["Active","Active"],["Inactive","Inactive"]]}],
		        [ "first_contact_date", {"label":"First Contact Date","type":"date","validation":"none"}]
		];
	}else{
		return [
		        [ "id", {"label":"ID","type":"hidden"}],
		        [ "name", {"label":"Name","type":"placeholder"}],
		        [ "details",  {"label":"Details","type":"placeholder","validation":"none"}],
		        [ "address",  {"label":"Address","type":"placeholder","validation":"none"}],
		        [ "contact_number", {"label":"Contact Number","type":"placeholder","validation":"none"}],
		        [ "contact_email", {"label":"Contact Email","type":"placeholder","validation":"none"}],
		        [ "company_url", {"label":"Company Url","type":"placeholder","validation":"none"}],
		        [ "status", {"label":"Status","type":"placeholder","source":[["Active","Active"],["Inactive","Inactive"]]}],
		        [ "first_contact_date", {"label":"First Contact Date","type":"placeholder","validation":"none"}]
		];
	}
});

ClientAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=85';
});

/**
 * ProjectAdapter
 */

function ProjectAdapter(endPoint,tab,filter,orderBy) {
	this.initAdapter(endPoint,tab,filter,orderBy);
}

ProjectAdapter.inherits(AdapterBase);



ProjectAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "client"
	];
});

ProjectAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID","bVisible":false },
			{ "sTitle": "Name" },
			{ "sTitle": "Client"},
	];
});

ProjectAdapter.method('getFormFields', function() {
	if(this.showSave){
		return [
		        [ "id", {"label":"ID","type":"hidden"}],
		        [ "name", {"label":"Name","type":"text"}],
				[ "project_manager", {"label":"Project Manager","type":"select2","remote-source":["Employees","id","first_name+last_name"]}],
				[ "client", {"label":"Client","type":"select2","remote-source":["Clients","id","name"]}],
				[ "client_representative", {"label":"Client Representative","type":"select2","remote-source":["Clients","id","name"]}],
				[ "third_party", {"label":"Third Party","type":"select2","remote-source":["ThirdParties","id","name"]}],
				[ "scope", {"label":"Scope","type":"select2","remote-source":["Scopes","id","name"]}],
				[ "categorization", {"label":"Categorization","type":"select2","remote-source":["Categorizations","id","name"]}],
				[ "country", {"label":"Country","type":"select2","remote-source":["Countries","id","name"]}],
				[ "governorate", {"label":"Governorate","type":"select2","remote-source":["Governoraties","id","name"]}],
				[ "area", {"label":"Area","type":"select2","remote-source":["Areas","id","name"]}],
				[ "digitalmedia", {"label":"Digital Media","type":"checkbox"}],
				/*[ "date_start", {"label":"Start Date","type":"date","validation":""}],
			 	[ "date_end", {"label":"End Date","type":"date","validation":"none"}],*/
				[ "status", {"label":"Status","type":"select","source":[["Current","Current"],["Inactive","Inactive"],["Completed","Completed"]]}],
				[ "phase", {"label":"Phase","type":"select","source":[["Current","Current"],["Inactive","Inactive"],["Completed","Completed"]]}],
				[ "project_team", {"label":"Project Team","type":"select2","remote-source":["Employee","id","first_name+last_name"]}],
		        [ "details",  {"label":"Details","type":"textarea","validation":"none"}],
		];
	}else{
		return [
		        [ "id", {"label":"ID","type":"hidden"}],
		        [ "name", {"label":"Name","type":"placeholder"}],
		        [ "client", {"label":"Client","type":"placeholder","allow-null":true,"remote-source":["Client","id","name"]}],
		        [ "details",  {"label":"Details","type":"placeholder","validation":"none"}],
		        [ "status", {"label":"Status","type":"placeholder","source":[["Active","Active"],["Inactive","Inactive"]]}]
		];
	}
	
});

ProjectAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=85';
});


/*
 * EmployeeProjectAdapter
 */


function EmployeeProjectAdapter(endPoint) {
	this.initAdapter(endPoint);
}

EmployeeProjectAdapter.inherits(AdapterBase);



EmployeeProjectAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "employee",
	        "project",
	        "status"
	];
});

EmployeeProjectAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Employee" },
			{ "sTitle": "Project" },
			/*{ "sTitle": "Start Date"},*/
			{ "sTitle": "Status"}
	];
});

EmployeeProjectAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "employee", {"label":"Employee","type":"select2","remote-source":["Employee","id","first_name+last_name"]}],
	        [ "project", {"label":"Project","type":"select2","remote-source":["Project","id","name"]}],
	        [ "details", {"label":"Details","type":"textarea","validation":"none"}]
	];
});

EmployeeProjectAdapter.method('getFilters', function() {
	return [
	        [ "employee", {"label":"Employee","type":"select2","remote-source":["Employee","id","first_name+last_name"]}]
	        
	];
});

EmployeeProjectAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=85';
});

/**
 * ThirdPartiesAdapter
 */

function ThirdPartiesAdapter(endPoint) {
	this.initAdapter(endPoint);
}

ThirdPartiesAdapter.inherits(AdapterBase);

ThirdPartiesAdapter.method('getDataMapping', function() {
	return [
		"id",
		"name"
	];
});

ThirdPartiesAdapter.method('getHeaders', function() {
	return [
		{ "sTitle": "ID" ,"bVisible":false},
		{ "sTitle": "Name" },
	];
});

ThirdPartiesAdapter.method('getFormFields', function() {
	return [
		[ "id", {"label":"ID","type":"hidden"}],
		[ "name", {"label":"Party Name","type":"text","required":true}],
	];
});

ThirdPartiesAdapter.method('getFilters', function() {
	return [
		[ "name", {"label":"Name","type":"select2","remote-source":["ThirdParties","id","name"]}]
	];
});

ThirdPartiesAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=85';
});

/**
 * ScopesAdapter
 */

function ScopesAdapter(endPoint) {
	this.initAdapter(endPoint);
}

ScopesAdapter.inherits(AdapterBase);

ScopesAdapter.method('getDataMapping', function() {
	return [
		"id",
		"name"
	];
});

ScopesAdapter.method('getHeaders', function() {
	return [
		{ "sTitle": "ID" ,"bVisible":false},
		{ "sTitle": "Name" },
	];
});

ScopesAdapter.method('getFormFields', function() {
	return [
		[ "id", {"label":"ID","type":"hidden"}],
		[ "name", {"label":"Scope Name","type":"text","required":true}],
	];
});

ScopesAdapter.method('getFilters', function() {
	return [
		[ "name", {"label":"Name","type":"select2","remote-source":["ThirdParties","id","name"]}]
	];
});

ScopesAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=85';
});

/**
 * CategoriesAdapter
 */

function CategoriesAdapter(endPoint) {
	this.initAdapter(endPoint);
}

CategoriesAdapter.inherits(AdapterBase);

CategoriesAdapter.method('getDataMapping', function() {
	return [
		"id",
		"name"
	];
});

CategoriesAdapter.method('getHeaders', function() {
	return [
		{ "sTitle": "ID" ,"bVisible":false},
		{ "sTitle": "Name" },
	];
});

CategoriesAdapter.method('getFormFields', function() {
	return [
		[ "id", {"label":"ID","type":"hidden"}],
		[ "name", {"label":"Category Name","type":"text","required":true}],
	];
});

CategoriesAdapter.method('getFilters', function() {
	return [
		[ "name", {"label":"Name","type":"select2","remote-source":["ThirdParties","id","name"]}]
	];
});

CategoriesAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=85';
});
