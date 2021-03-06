/**
 * Author: Thilina Hasantha
 */


/**
 * JobTitleAdapter
 */

function JobTitleAdapter(endPoint) {
	this.initAdapter(endPoint);
}

JobTitleAdapter.inherits(AdapterBase);



JobTitleAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "code",
	        "name"
	];
});

JobTitleAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Code" },
			{ "sTitle": "Name" }
	];
});

JobTitleAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
			[ "name", {"label":"Job Title","type":"text"}],
			[ "code", {"label":"Job Title Code","type":"text"}],
<<<<<<< HEAD
		    [ "department", {"label":"Job Department","type":"select2","remote-source":["CompanyStructures","id","title"]}],
=======
		    [ "department", {"label":"Job Department","type":"select2","remote-source":["CompanyStructures","id","name"]}],
>>>>>>> 4da1ae57504ec67f9e28ed7132fd6b88773688c8
		    [ "grade_category", {"label":"Grade Category","type":"select2","remote-source":["PayGrade","id","name"]}],
		    [ "reporting_to", {"label":"Reporting To","type":"select2","remote-source":["Employees","id","first_name+last_name"]}],
		    [ "benefits", {"label":"Benefits","type":"select2","remote-source":["Benefits","id","name"]}],
		    [ "job_summry", {"label":"Job Summry","type":"textarea"}],
		    [ "general_duties", {"label":"General Duties","type":"select2","remote-source":["JobDuties","id","name"]}],
		    [ "technical_duties", {"label":"Technical Duties","type":"select2","remote-source":["JobDuties","id","name"]}],
		    [ "strategic_duties", {"label":"Strategic Duties","type":"select2","remote-source":["JobDuties","id","name"]}],
			[ "education", {"label":"Education Degree","type":"select2","validation":"none","remote-source":["Educations","id","name"]}],
			[ "language", {"label":"Languages","type":"select2","validation":"none","remote-source":["Languages","id","name"]}],
			[ "work_location", {"label":"Work Location","type":"select2","source":[["Office","Office"],["Site","Site"]]}],
			[ "professional_knowledge", {"label":"Professional knowledge","type":"text"}],
			[ "description", {"label":"Description","type":"textarea"}],
	        [ "specification", {"label":"Specification","type":"textarea"}]
	];
});

JobTitleAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=80';
});


/**
 * PayGradeAdapter
 */

function PayGradeAdapter(endPoint) {
	this.initAdapter(endPoint);
}

PayGradeAdapter.inherits(AdapterBase);



PayGradeAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "currency",
	        "min_salary",
	        "max_salary"
	];
});

PayGradeAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" ,"bVisible":false},
			{ "sTitle": "Name" },
			{ "sTitle": "Currency"},
			{ "sTitle": "Min Salary" },
			{ "sTitle": "Max Salary"}
	];
});

PayGradeAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "name", {"label":"Pay Grade Name","type":"text"}],
	        [ "currency", {"label":"Currency","type":"select2","remote-source":["CurrencyType","code","name"]}],
	        [ "min_salary", {"label":"Min Salary","type":"text","validation":"float"}],
	        [ "max_salary", {"label":"Max Salary","type":"text","validation":"float"}]
	];
});

PayGradeAdapter.method('doCustomValidation', function(params) {
	try{
		if(parseFloat(params.min_salary)>parseFloat(params.max_salary)){
			return "Min Salary should be smaller than Max Salary";
		}
	}catch(e){
		
	}
	return null;
});



/**
 * EmploymentStatusAdapter
 */

function EmploymentStatusAdapter(endPoint) {
	this.initAdapter(endPoint);
}

EmploymentStatusAdapter.inherits(AdapterBase);



EmploymentStatusAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "name",
	        "description"
	];
});

EmploymentStatusAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" },
			{ "sTitle": "Name" },
			{ "sTitle": "Description"}
	];
});

EmploymentStatusAdapter.method('getFormFields', function() {
	return [
	        [ "id", {"label":"ID","type":"hidden"}],
	        [ "name", {"label":"Employment Status","type":"text"}],
	        [ "description",  {"label":"Description","type":"textarea","validation":""}]
	];
});

