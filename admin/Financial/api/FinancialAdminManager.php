<?php
if (!class_exists('LeavesAdminManager')) {
	class FinancialAdminManager extends AbstractModuleManager{
		
		public function initializeUserClasses(){
			
		}
		
		public function initializeFieldMappings(){
			
		}
		
		public function initializeDatabaseErrorMappings(){

		}
		
		public function setupModuleClassDefinitions(){
			$this->addModelClass('BenefitsCategorys');
			$this->addModelClass('Benefits');
			$this->addModelClass('AdvantagesCategorys');
			$this->addModelClass('Advantages');
			$this->addModelClass('AllowancesCategorys');
			$this->addModelClass('Allowances');

		}
		
	}
}

if (!class_exists('BenefitsCategorys')) {
	class BenefitsCategorys extends ICEHRM_Record {
		var $_table = 'BenefitsCategorys';

		public function getAdminAccess(){
			return array("get","element","save","delete");
		}


		public function getUserAccess(){
			return array();
		}
	}
}
if (!class_exists('Benefits')) {
	class Benefits extends ICEHRM_Record {
		var $_table = 'Benefits';

		public function getAdminAccess(){
			return array("get","element","save","delete");
		}


		public function getUserAccess(){
			return array();
		}

	}
}
if (!class_exists('AdvantagesCategorys')) {
	class AdvantagesCategorys extends ICEHRM_Record {
		var $_table = 'AdvantagesCategorys';

		public function getAdminAccess(){
			return array("get","element","save","delete");
		}


		public function getUserAccess(){
			return array();
		}

	}
}
if (!class_exists('Advantages')) {
	class Advantages extends ICEHRM_Record {
		var $_table = 'Advantages';

		public function getAdminAccess(){
			return array("get","element","save","delete");
		}


		public function getUserAccess(){
			return array();
		}

		public function validateSave($obj)
		{
			if($obj->depreciation_time < date("Y-m-d"))
			{
				return new IceResponse(IceResponse::ERROR,"Depreciation date should be after today");
			}
			if($obj->depreciation_percentage < 0) {
				return new IceResponse(IceResponse::ERROR,"Percentage can't be less than 0");
			}
			return new IceResponse(IceResponse::SUCCESS,"");

		}

	}
}

if (!class_exists('AllowancesCategorys')) {
	class AllowancesCategorys extends ICEHRM_Record {
		var $_table = 'AllowancesCategorys';

		public function getAdminAccess(){
			return array("get","element","save","delete");
		}


		public function getUserAccess(){
			return array();
		}

	}
}

if (!class_exists('Allowances')) {
	class Allowances extends ICEHRM_Record {
		var $_table = 'Allowances';

		public function getAdminAccess(){
			return array("get","element","save","delete");
		}


		public function getUserAccess(){
			return array();
		}

	}
}

