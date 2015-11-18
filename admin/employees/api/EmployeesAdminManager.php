<?php
if (!class_exists('EmployeesAdminManager')) {
	class EmployeesAdminManager extends AbstractModuleManager{

		public function initializeUserClasses(){
				
		}

		public function initializeFieldMappings(){
			
		}

		public function initializeDatabaseErrorMappings(){
			$this->addDatabaseErrorMapping('CONSTRAINT `Fk_User_Employee` FOREIGN KEY',"Can not delete Employee, please delete the User for this employee first.");
			$this->addDatabaseErrorMapping("Duplicate entry|for key 'employee'","A duplicate entry found");
		}

		public function setupModuleClassDefinitions(){
			$this->addModelClass('Employee');
			$this->addModelClass('EmploymentStatus');
		}

	}
}

if (!class_exists('Employee')) {
	class Employee extends ICEHRM_Record {
		var $_table = 'Employees';

		public function getAdminAccess(){
			return array("get","element","save","delete");
		}
	
		public function getManagerAccess(){
			return array("get","element","save","delete");
		}

		public function getUserAccess(){
			return array("get","element","save","delete");
		}
	
		public function getUserOnlyMeAccess(){
			return array("get","element","save","delete");
		}
	
		public function getUserOnlyMeAccessField(){
			return "id";
		}


	}
}

if (!class_exists('EmploymentStatus')) {
	class EmploymentStatus extends ICEHRM_Record {
		
		var $_table = 'EmploymentStatus';
	
		public function getAdminAccess(){
			return array("get","element","save","delete");
		}
		
		public function getManagerAccess(){
			return array("get","element","save");
		}
	
		public function getUserAccess(){
			return array();
		}
	}
}

if (!class_exists('Eduction')) {
	class Eduction extends ICEHRM_Record {

		var $_table = 'eductions';

		public function getAdminAccess(){
			return array("get","element","save","delete");
		}

		public function getManagerAccess(){
			return array("get","element","save");
		}

		public function getUserAccess(){
			return array();
		}
	}
}

if (!class_exists('EmployeeEducations')) {
	class EmployeeEducations extends ICEHRM_Record {
		var $_table = 'employeeeducations';
		public function getAdminAccess(){
			return array("get","element","save","delete");
		}

		public function getManagerAccess(){
			return array("get","element","save");
		}

		public function getUserAccess(){
			return array();
		}
	}
}

if (!class_exists('Institutes')) {
	class Institutes extends ICEHRM_Record {

		var $_table = 'institutes';

		public function getAdminAccess(){
			return array("get","element","save","delete");
		}

		public function getManagerAccess(){
			return array("get","element","save");
		}

		public function getUserAccess(){
			return array();
		}
	}
}
