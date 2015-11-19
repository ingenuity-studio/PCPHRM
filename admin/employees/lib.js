/**
 * Author: Thilina Hasantha
 */

function EmployeeAdapter(endPoint) {
	this.initAdapter(endPoint);
}

EmployeeAdapter.inherits(AdapterBase);

EmployeeAdapter.method('getDataMapping', function() {
	return [
	        "id",
	        "employee_id",
	        "first_name",
	        "last_name",
	        "mobile_phone",
	        "department",
	        "gender",
	        "supervisor"
	];
});

EmployeeAdapter.method('getHeaders', function() {
	return [
			{ "sTitle": "ID" },
			{ "sTitle": "Employee Number" },
			{ "sTitle": "First Name" },
			{ "sTitle": "Last Name"},
			{ "sTitle": "Mobile"},
			{ "sTitle": "Department"},
			{ "sTitle": "Gender"},
			{ "sTitle": "Supervisor"}
	];
});

EmployeeAdapter.method('getInitData', function() {
    alert('x');
});

EmployeeAdapter.method('getFormFields', function() {
	var compArray = [["Elementary Proficiency","Elementary Proficiency"],
		["Limited Working Proficiency","Limited Working Proficiency"],
		["Professional Working Proficiency","Professional Working Proficiency"],
		["Full Professional Proficiency","Full Professional Proficiency"],
		["Native or Bilingual Proficiency","Native or Bilingual Proficiency"]];

	return [
	        [ "id", {"label":"ID","type":"hidden","validation":""}],
	        [ "employee_id", {"label":"Employee Number","type":"text","validation":""}],
	        [ "first_name", {"label":"First Name","type":"text","validation":""}],
	        [ "middle_name", {"label":"Middle Name","type":"text","validation":"none"}],
	        [ "last_name", {"label":"Last Name","type":"text","validation":""}],
	        [ "nationality", {"label":"Nationality","type":"select2","remote-source":["Nationality","id","name"]}],
	        [ "birthday", {"label":"Date of Birth","type":"date","validation":""}],
	        [ "gender", {"label":"Gender","type":"select","source":[["Male","Male"],["Female","Female"]]}],
	        [ "marital_status", {"label":"Marital Status","type":"select","source":[["Married","Married"],["Single","Single"],["Divorced","Divorced"],["Widowed","Widowed"],["Other","Other"]]}],
			[ "military_status", {"label":"Military Status","type":"select","source":[["Completed","Completed"],["Not Applied","Not Applied"],["Exempted","Exempted"]]}],
			[ "image", {"label":"Employee Image","type":"fileupload", "required":false ,"validation":"none"}],
			[ "id_number", {"label":"ID Number","type":"text", "required":true }],
			[ "id_expdate", {"label":"ID Expire Date","type":"date", "required":true }],
			[ "postal_code", {"label":"Postal/Zip Code","type":"text","validation":"none"}],
			[ "home_phone", {"label":"Home Phone","type":"text","validation":"none"}],
			[ "mobile_phone", {"label":"Mobile Phone","type":"text","validation":"none"}],
			[ "work_phone", {"label":"Work Phone","type":"text","validation":"none"}],
			[ "work_email", {"label":"Work Email","type":"text","validation":"emailOrEmpty"}],
			[ "address1", {"label":"Address Line 1","type":"text","validation":"none"}],
			[ "address2", {"label":"Address Line 2","type":"text","validation":"none"}],
			[ "city", {"label":"City","type":"text","validation":"none"}],
			[ "country", {"label":"Country","type":"select2","remote-source":["Country","code","name"]}],
			[ "province", {"label":"Province","type":"select2","allow-null":true,"remote-source":["Province","id","name"]}],
			[ "language_id", {"label":"Language","type":"select2","allow-null":false,"remote-source":["Language","id","name"]}],
			[ "reading", {"label":"Reading","type":"select","source":compArray}],
			[ "speaking", {"label":"Speaking","type":"select","source":compArray}],
			[ "writing", {"label":"Writing","type":"select","source":compArray}],
			[ "understanding", {"label":"Understanding","type":"select","source":compArray}],
			[ "private_email", {"label":"Private Email","type":"text","validation":"emailOrEmpty"}],
			[ "car_owner", {"label":"Car Owner?","type":"select","validation":"none","source":[["Yes","Yes"],["No","No"]]}],
			[ "driving_license", {"label":"Driving License No","type":"text","validation":"none","name":"dl"}],
			[ "driving_license_exp_date", {"label":"License Exp Date","type":"date","validation":"none"}],
			[ "employee_education", {"label":"Education Degree","type":"select","validation":"none","remote-source":["Education","id","name"]}],
			[ "employee_institution", {"label":"Education institution","type":"select","validation":"none","remote-source":["Institutes","id","name"]}],
		    /*[ "ssn_num", {"label":"SSN/NRIC","type":"text","validation":"none"}],
	        [ "nic_num", {"label":"NIC","type":"text","validation":"none"}],
	        [ "other_id", {"label":"Other ID","type":"text","validation":"none"}],*/
	        [ "bank_account", {"label":"Bank Account Number","type":"text","validation":"none"}],
			[ "contract_startdate", {"label":"Contract Signature Date","type":"date","require":true}],
			[ "contract_enddate", {"label":"Contract End Date","type":"date","require":true}],
	        [ "employment_status", {"label":"Employment Status","type":"select2","remote-source":["EmploymentStatus","id","name"]}],
			[ "job_title", {"label":"Job Title","type":"select2","remote-source":["JobTitle","id","name"]}],
	        [ "pay_grade", {"label":"Pay Grade","type":"select2","allow-null":true,"remote-source":["PayGrade","id","name"]}],
	        [ "work_station_id", {"label":"Work Station Id","type":"text","validation":"none"}],
	        [ "joined_date", {"label":"Joined Date","type":"date","validation":""}],
	        [ "confirmation_date", {"label":"Confirmation Date","type":"date","validation":"none"}],
	        [ "department", {"label":"Department","type":"select2","remote-source":["CompanyStructure","id","title"]}],
	        [ "supervisor", {"label":"Supervisor","type":"select2","allow-null":true,"remote-source":["Employee","id","first_name+last_name"]}],


	];
});


EmployeeAdapter.method('getFilters', function() {
	return [
	        [ "job_title", {"label":"Job Title","type":"select2","allow-null":true,"null-label":"All Job Titles","remote-source":["JobTitle","id","name"]}],
	        [ "department", {"label":"Department","type":"select2","allow-null":true,"null-label":"All Departments","remote-source":["CompanyStructure","id","title"]}],
	        [ "supervisor", {"label":"Supervisor","type":"select2","allow-null":true,"null-label":"Anyone","remote-source":["Employee","id","first_name+last_name"]}]
	];
});

EmployeeAdapter.method('getActionButtonsHtml', function(id) {
	var html = '<div style="width:110px;"><img class="tableActionButton" src="_BASE_images/user.png" style="cursor:pointer;" rel="tooltip" title="Login as this Employee" onclick="modJs.setAdminEmployee(_id_);return false;"></img><img class="tableActionButton" src="_BASE_images/edit.png" style="cursor:pointer;margin-left:15px;" rel="tooltip" title="Edit" onclick="modJs.edit(_id_);return false;"></img><img class="tableActionButton" src="_BASE_images/delete.png" style="margin-left:15px;cursor:pointer;" rel="tooltip" title="Terminate Employee" onclick="modJs.deleteRow(_id_);return false;"></img></div>';
	html = html.replace(/_id_/g,id);
	html = html.replace(/_BASE_/g,this.baseUrl);
	return html;
});

EmployeeAdapter.method('getHelpLink', function () {
	return 'http://blog.icehrm.com/?page_id=69';
});

EmployeeAdapter.method('transferEmployee', function() {
	$('#tabProject').modal('show');
});

EmployeeAdapter.method('closeTransferWindows', function() {
	$('#tabProject').modal('hide');
});

EmployeeAdapter.method('addEducation', function(instituteField) {
    var copyEducation = $("#field_employee_education").clone();
    var copyInstitute = $("#field_employee_institution").clone();
    instituteField.after(copyInstitute);
    instituteField.after(copyEducation);
});

EmployeeAdapter.method('changeProvince', function(country) {
	var table='province';
	$.post(this.moduleRelativeURL,{'a':'loadSub','t': table  ,'sm':null , 'subSet':'country','subSetValue':country.val()},function(data){
		if(data.status == "SUCCESS"){
			console.log(data);
			}else{
			alert("Something went wrong , refresh the page");
		}
	});
});


function ProjectAdapter(endPoint) {
	this.initAdapter(endPoint);
}

ProjectAdapter.inherits(AdapterBase);

ProjectAdapter.method('getDataMapping', function() {
	return [
		"id",
		"name"
	];
});

ProjectAdapter.method('getFormFields',function(){
	return[
	["project", {"label":"Project","type": "select2","remote-source":["projects","id","name"]}],
	];
});
