<?php
/**
 * Class TaxesAdminManager
 *
 */

if (!class_exists('TaxesAdminManager')) {
	class TaxesAdminManager extends AbstractModuleManager{
		public function initializeUserClasses(){
		}
		public function initializeFieldMappings(){
		}
		public function initializeDatabaseErrorMappings(){
		}
		public function setupModuleClassDefinitions(){
		}
	}
}
if (!class_exists('Taxes')) {
	class Taxes extends ICEHRM_Record {
		public function getAdminAccess(){
			return array("get","element","save","delete");
		}
		public function getUserAccess(){
			return array();
		}
		public function validateSave($obj){
		}
		var $_table = 'Taxes';
	}	
}