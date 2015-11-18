<?php

/*
This file is part of Ice Framework.

Ice Framework is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Ice Framework is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Ice Framework. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------

Original work Copyright (c) 2012 [Gamonoid Media Pvt. Ltd]  
Developer: Thilina Hasantha (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */

class BaseService{
	
	var $nonDeletables = array();
	var $errros = array();
	public $userTables = array();
	var $currentUser = null;
	var $db = null;
	var $auditManager = null;
	var $notificationManager = null;
	var $settingsManager = null;
	var $fileFields = null;
	var $moduleManagers = null;
	var $emailSender = null;
	
	private static $me = null;
	
	private function __construct(){
	
	}
	
	public static function getInstance(){
		if(empty(self::$me)){
			self::$me = new BaseService();
		}
	
		return self::$me;
	}
	
	public function get($table,$mappingStr = null, $filterStr = null, $orderBy = null, $limit = null){

		if(!empty($mappingStr)){
		$map = json_decode($mappingStr);
		}
		$obj = new $table();
		
		$this->checkSecureAccess("get",$obj);
		
		$query = "";
		$queryData = array();
		if(!empty($filterStr)){
			$filter = json_decode($filterStr, true);
			
			if(!empty($filter)){
				foreach($filter as $k=>$v){
					LogManager::getInstance()->info($filterStr);
					if($v == '__myid__'){
						$v = $this->getCurrentProfileId();
					}
					$query.=" and ".$k."=?";
					$queryData[] = $v;
				}	
			}	
		}
		
		if(empty($orderBy)){
			$orderBy = "";
		}else{
			$orderBy = " ORDER BY ".$orderBy;
		}
		
		
		if(in_array($table, $this->userTables)){
			$cemp = $this->getCurrentProfileId();
			if(!empty($cemp)){
				$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
				$list = $obj->Find($signInMappingField." = ?".$query.$orderBy, array_merge(array($cemp),$queryData));	
			}else{
				$list = array();
			}
					
		}else{
			$list = $obj->Find("1=1".$query.$orderBy,$queryData);	
		}	
		
		if(!empty($mappingStr) && count($map)>0){
			$list = $this->populateMapping($list, $map);
		}

		return $list;
	}
	
	
	public function getData($table,$mappingStr = null, $filterStr = null, $orderBy = null, $limit = null, $searchColumns = null, $searchTerm = null, $isSubOrdinates = false, $skipProfileRestriction = false){
		if(!empty($mappingStr)){
		$map = json_decode($mappingStr);
		}
		$obj = new $table();
		$this->checkSecureAccess("get",$obj);
		$query = "";
		$queryData = array();
		if(!empty($filterStr)){
			$filter = json_decode($filterStr);
			if(!empty($filter)){
				foreach($filter as $k=>$v){
					$query.=" and ".$k."=?";
					$queryData[] = $v;
				}	
			}	
		}
		
		
		if(!empty($searchTerm) && !empty($searchColumns)){
			$searchColumnList = json_decode($searchColumns);
			$tempQuery = " and (";
			foreach($searchColumnList as $col){
				
				if($tempQuery != " and ("){
					$tempQuery.=" or ";	
				}
				$tempQuery.=$col." like ?";
				$queryData[] = "%".$searchTerm."%";
			}	
			$query.= $tempQuery.")";	
		}
		
		if(empty($orderBy)){
			$orderBy = "";
		}else{
			$orderBy = " ORDER BY ".$orderBy;
		}
		
		if(empty($limit)){
			$limit = "";	
		}
		
		
		
		if(in_array($table, $this->userTables) && !$skipProfileRestriction){
			
			$cemp = $this->getCurrentProfileId();
			if(!empty($cemp)){
				if(!$isSubOrdinates){
					array_unshift($queryData, $cemp);
					$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
					$list = $obj->Find($signInMappingField." = ?".$query.$orderBy.$limit, $queryData);
				}else{
					$profileClass = ucfirst(SIGN_IN_ELEMENT_MAPPING_FIELD_NAME);
					$subordinate = new $profileClass();
					$subordinates = $subordinate->Find("supervisor = ?",array($cemp));
					$subordinatesIds = "";
					foreach($subordinates as $sub){
						if($subordinatesIds != ""){
							$subordinatesIds.=",";
						}
						$subordinatesIds.=$sub->id;
					}
					$subordinatesIds.="";
					$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
					$list = $obj->Find($signInMappingField." in (".$subordinatesIds.") ".$query.$orderBy.$limit, $queryData);
				}
					
			}else{
				$list = array();
			}
					
		}else{
			$list = $obj->Find("1=1".$query.$orderBy.$limit,$queryData);
		}	

		
		if(!empty($mappingStr) && count($map)>0){
			$list = $this->populateMapping($list, $map);
		}
		
		
		return $list;
	}
	
	public function populateMapping($list,$map){
		$listNew = array();
		if(empty($list)){
			return $listNew;
		}
		foreach($list as $item){
			$item = $this->populateMappingItem($item, $map);
			$listNew[] = $item;	
		}
		return 	$listNew;
	}
	
	public function populateMappingItem($item,$map){
		foreach($map as $k=>$v){
			$fTable = $v[0];
			$tObj = new $fTable();
			$tObj->Load($v[1]."= ?",array($item->$k));
			
			if($tObj->$v[1] == $item->$k){
				$v[2] = str_replace("+"," ",$v[2]);
				$values = explode(" ", $v[2]);
				if(count($values) == 1){
					$idField = $k."_id";
					$item->$idField = $item->$k;
					$item->$k = $tObj->$v[2];	
					
				}else{
					$objVal = "";
					foreach($values as $v){
						if($objVal != ""){
							$objVal .= " ";	
						}
						$objVal .= $tObj->$v;
					}
					$idField = $k."_id";
					$item->$idField = $item->$k;
					$item->$k = $objVal;
				}
			}	
		}
		return 	$item;
	}
	
	public function getElement($table,$id,$mappingStr = null, $skipSecurityCheck = false){
		$obj = new $table();
		
		
		if(in_array($table, $this->userTables)){
			$cemp = $this->getCurrentProfileId();
			if(!empty($cemp)){
				$obj->Load("id = ?", array($id));	
			}else{
			}
					
		}else{
			$obj->Load("id = ?",array($id));
		}
		
		if(!$skipSecurityCheck){
			$this->checkSecureAccess("element",$obj);
		}
		
		if(!empty($mappingStr)){
			$map = json_decode($mappingStr);	
		}
		if($obj->id == $id){
			if(!empty($mappingStr)){
				foreach($map as $k=>$v){
					$fTable = $v[0];
					$tObj = new $fTable();
					$tObj->Load($v[1]."= ?",array($obj->$k));
					if($tObj->$v[1] == $obj->$k){
						$name = $k."_Name";
						$values = explode("+", $v[2]);
						if(count($values) == 1){
							$idField = $name."_id";
							$obj->$idField = $obj->$name;
							$obj->$name = $tObj->$v[2];	
						}else{
							$objVal = "";
							foreach($values as $v){
								if($objVal != ""){
									$objVal .= " ";	
								}
								$objVal .= $tObj->$v;
							}
							$idField = $name."_id";
							$obj->$idField = $obj->$name;
							$obj->$name = $objVal;
						}
					}	
				}
			}
			return 	$obj;
		}
		return null;
	}
	
	public function addElement($table,$obj){
		$isAdd = true;
		$ele = new $table();

		if(class_exists("ProVersion")){
			$pro = new ProVersion();
			$subscriptionTables = $pro->getSubscriptionTables();
			if(in_array($table,$subscriptionTables)){
				$resp = $pro->subscriptionCheck($obj);
				if($resp->getStatus() != IceResponse::SUCCESS){
					return $resp;
				}
			}
		}

		if(!empty($obj['id'])){
			$isAdd = false;
			$ele->Load('id = ?',array($obj['id']));	
		}
		
		foreach($obj as $k=>$v){
			if($k == 'id' || $k == 't' || $k == 'a'){
				continue;	
			}
			if($v == "NULL"){
				$v = null;	
			}
			$ele->$k = $v;
		}

		if(empty($obj['id'])){	
			if(in_array($table, $this->userTables)){
				$cemp = $this->getCurrentProfileId();
				if(!empty($cemp)){
					$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
					$ele->$signInMappingField = $cemp;	
				}else{
					return new IceResponse(IceResponse::ERROR,"Profile id is not set");
				}		
			}
		}

		$this->checkSecureAccess("save",$ele);

		$resp =$ele->validateSave($ele);


 		if($resp->getStatus() != IceResponse::SUCCESS){
			return $resp;
		}
		if($isAdd){
			if(empty($ele->created)){
				$ele->created = date("Y-m-d H:i:s");
			}
		}
		
		if(empty($ele->updated)){
			$ele->updated = date("Y-m-d H:i:s");
		}

        if($isAdd){
			$ele = $ele->executePreSaveActions($ele)->getData();
		}else{
			$ele = $ele->executePreUpdateActions($ele)->getData();
		}

		$ok = $ele->Save();

        if(!$ok){

            $error = $ele->ErrorMsg();
			print_r($error);exit;
			LogManager::getInstance()->info($error);
			
			if($isAdd){
				$this->audit(IceConstants::AUDIT_ERROR, "Error occured while adding an object to ".$table." \ Error: ".$error);
			}else{
				$this->audit(IceConstants::AUDIT_ERROR, "Error occured while editing an object in ".$table." [id:".$ele->id."] \ Error: ".$error);
			}
			return new IceResponse(IceResponse::ERROR,$this->findError($error));		
		}
		
		if($isAdd){
			$ele->executePostSaveActions($ele);
			$this->audit(IceConstants::AUDIT_ADD, "Added an object to ".$table." [id:".$ele->id."]");
		}else{
			$ele->executePostUpdateActions($ele);
			$this->audit(IceConstants::AUDIT_EDIT, "Edited an object in ".$table." [id:".$ele->id."]");
		}

        return new IceResponse(IceResponse::SUCCESS,$ele);
	}
	
	public function deleteElement($table,$id){
		$fileFields = $this->fileFields;
		$ele = new $table();
		
		$ele->Load('id = ?',array($id));

		$this->checkSecureAccess("delete",$ele);
		
		if(isset($this->nonDeletables[$table])){
			$nonDeletableTable = $this->nonDeletables[$table];
			if(!empty($nonDeletableTable)){
				foreach($nonDeletableTable as $field => $value){
					if($ele->$field == $value){
						return "This item can not be deleted";
					}
				}
			}	
		}

		$ok = $ele->Delete();
		if(!$ok){
			$error = $ele->ErrorMsg();
			LogManager::getInstance()->info($error);
			return $this->findError($error);	
		}else{
			//Backup
			if($table == "Profile"){
				$newObj = $this->cleanUpAdoDB($ele);
				$dataEntryBackup = new DataEntryBackup();
				$dataEntryBackup->tableType = $table;
				$dataEntryBackup->data = json_encode($newObj);
				$dataEntryBackup->Save();
			}
			
			$this->audit(IceConstants::AUDIT_DELETE, "Deleted an object in ".$table." [id:".$ele->id."]");
		}
		
		
		
		if(isset($fileFields[$table])){
			foreach($fileFields[$table] as $k=>$v){
				if(!empty($ele->$k)){
					FileService::getInstance()->deleteFileByField($ele->$k,$v);
				}
					
			}
		}
		
		return null;
	}
	
	public function getFieldValues($table,$key,$value){
		$values = explode("+", $value);
		$ret = array();
		$ele = new $table();

		$list = $ele->Find('1 = 1',array());
		foreach($list as $obj){
			if(count($values) == 1){
				$ret[$obj->$key] = $obj->$value;	
			}else{
				$objVal = "";
				foreach($values as $v){
					if($objVal != ""){
						$objVal .= " ";	
					}
					$objVal .= $obj->$v;
				}
				$ret[$obj->$key] = $objVal;
			}
		}
		return $ret;
	}
	
	public function setNonDeletables($table, $field, $value){
		if(!isset($this->nonDeletables[$table])){
			$this->nonDeletables[$table] = array();	
		}
		$this->nonDeletables[$table][$field] = $value;
	}
	
	public function setSqlErrors($errros){
		$this->errros = $errros;	
	}
	
	public function setUserTables($userTables){
		$this->userTables = $userTables;	
	}
	
	public function setCurrentUser($currentUser){
		$this->currentUser = $currentUser;	
	}
	
	public function findError($error){
		foreach($this->errros as $k=>$v){
			if(strstr($error, $k)){
				return $v;
			}else{
				$keyParts = explode("|", $k);
				if(count($keyParts) >= 2){
					if(strstr($error, $keyParts[0]) && strstr($error, $keyParts[1])){
						return $v;
					}
				}
			}
		}	
		return $error;
	}
	
	public function getCurrentUser(){
		$user = SessionUtils::getSessionObject('user');
		return $user;
	}
	
	public function getCurrentProfileId(){
		if (!class_exists('SessionUtils')) {
			include (APP_BASE_PATH."include.common.php");
		}
		$adminEmpId = SessionUtils::getSessionObject('admin_current_profile');
		$user = SessionUtils::getSessionObject('user');
		if(empty($adminEmpId) && !empty($user)){
			$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
			return $user->$signInMappingField;
		}
		return $adminEmpId;
	}
	
	public function setCurrentAdminProfile($profileId){
		if (!class_exists('SessionUtils')) {
			include (APP_BASE_PATH."include.common.php");
		}
		
		if($profileId == "-1"){
			SessionUtils::saveSessionObject('admin_current_profile',null);
			return;
		}
		
		if($this->currentUser->user_level == 'Admin'){
			SessionUtils::saveSessionObject('admin_current_profile',$profileId);
					
		}else if($this->currentUser->user_level == 'Manager'){
			$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
			$signInMappingFieldTable = ucfirst($signInMappingField);
			$subordinate = new $signInMappingFieldTable();
			$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
			$subordinates = $subordinate->Find("supervisor = ?",array($this->currentUser->$signInMappingField));
			$subFound = false;
			foreach($subordinates as $sub){
				if($sub->id == $profileId){
					$subFound = true;
					break;
				}
			}
			
			if(!$subFound){
				return;	
			}
			
			SessionUtils::saveSessionObject('admin_current_profile',$profileId);
			
		}
	}
	
	public function cleanUpAdoDB($obj){
		unset($obj->_table);	
		unset($obj->_dbat);	
		unset($obj->_tableat);	
		unset($obj->_where);	
		unset($obj->_saved);	
		unset($obj->_lasterr);	
		unset($obj->_original);	
		unset($obj->foreignName);	
		
		return $obj;
	}
	
	public function setDB($db){
		$this->db = $db;
	}
	
	public function getDB(){
		return $this->db;
	}
	
	public function checkSecureAccessOld($type,$object){
		
		$accessMatrix = array();
		if($this->currentUser->user_level == 'Admin'){
			$accessMatrix = $object->getAdminAccess();
			if (in_array($type, $accessMatrix)) {
				return true;
			}
		}else if($this->currentUser->user_level == 'Manager'){
			$accessMatrix = $object->getManagerAccess();
			if (in_array($type, $accessMatrix)) {
				return true;
			}else{
				$accessMatrix = $object->getUserOnlyMeAccess();
				$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
				if (in_array($type, $accessMatrix) && $_REQUEST[$object->getUserOnlyMeAccessField()] == $this->currentUser->$signInMappingField) {
					return true;	
				}
				
				if (in_array($type, $accessMatrix)) {
					
					$field = $object->getUserOnlyMeAccessField();
					$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
					if($this->currentUser->$signInMappingField."" == $object->$field){
						return true;
					}
					
				}
			}
			
		}else{
			$accessMatrix = $object->getUserAccess();
			if (in_array($type, $accessMatrix)) {
				return true;
			}else{
				$accessMatrix = $object->getUserOnlyMeAccess();
				$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
				if (in_array($type, $accessMatrix) && $_REQUEST[$object->getUserOnlyMeAccessField()] == $this->currentUser->$signInMappingField) {
					return true;	
				}
				
				if (in_array($type, $accessMatrix)) {
					
					$field = $object->getUserOnlyMeAccessField();
					$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
					if($this->currentUser->$signInMappingField."" == $object->$field){
						return true;
					}
					
				}
			}
		}
		
		$ret['status'] = "ERROR";
		$ret['message'] = "Access violation";
		echo json_encode($ret);
		exit();
	}
	
	
	
	public function checkSecureAccess($type,$object){
		
		$accessMatrix = array();
		
		//Construct permission method
		$permMethod = "get".$this->currentUser->user_level."Access";
		$accessMatrix = $object->$permMethod();

		if (in_array($type, $accessMatrix)) {
			//The user has required permission, so return true

			return true;
		}else{
			//Now we need to check whther the user has access to his own records
			$accessMatrix = $object->getUserOnlyMeAccess();
			
			$userOnlyMeAccessRequestField = $object->getUserOnlyMeAccessRequestField();
			
			//This will check whether user can access his own records using a value in request
			if(isset($_REQUEST[$object->getUserOnlyMeAccessField()]) && isset($this->currentUser->$userOnlyMeAccessRequestField)){
				if (in_array($type, $accessMatrix) && $_REQUEST[$object->getUserOnlyMeAccessField()] == $this->currentUser->$userOnlyMeAccessRequestField) {
					return true;
				}
			}
			
			//This will check whether user can access his own records using a value in requested object
			if (in_array($type, $accessMatrix)) {
				$field = $object->getUserOnlyMeAccessField();
				if($this->currentUser->$userOnlyMeAccessRequestField == $object->$field){
					return true;
				}
			
			}
		}
		
		$ret['status'] = "ERROR";
		$ret['message'] = "Access violation";

        echo json_encode($ret);
		exit();
	}
	
	
	
	public function getUserFromProfileId($profileId){
		$user = new User();
		$signInMappingField = SIGN_IN_ELEMENT_MAPPING_FIELD_NAME;
		$user->load($signInMappingField." = ?",array($profileId));
		if($user->$signInMappingField == $profileId){
			return $user;	
		}
		return null;
	}
	
	public function getInstanceId(){
		$settings = new Setting();
		$settings->Load("name = ?",array("Instance : ID"));
		
		if($settings->name != "Instance : ID" || empty($settings->value)){
			$settings->value = md5(time());
			$settings->name = "Instance : ID";
			$settings->Save();
		}
		
		return $settings->value;
	}
	
	public function setInstanceKey($key){
		$settings = new Setting();
		$settings->Load("name = ?",array("Instance: Key"));
		if($settings->name != "Instance: Key"){
			$settings->name = "Instance: Key";
			
		}
		$settings->value = $key;
		$settings->Save();
	}
	
	public function getInstanceKey(){
		$settings = new Setting();
		$settings->Load("name = ?",array("Instance: Key"));
		if($settings->name != "Instance: Key"){
			return null;	
		}
		return $settings->value;
	}
	
	public function validateInstance(){
		$instanceId = $this->getInstanceId();
		if(empty($instanceId)){
			return true;
		}
	
		$key = $this->getInstanceKey();
	
		if(empty($key)){
			return false;
		}
	
		$data = AesCtr::decrypt($key, $instanceId, 256);
		$arr = explode("|",$data);
		if($arr[0] == KEY_PREFIX && $arr[1] == $instanceId){
			return true;
		}
	
		return false;
	}
	
	public function loadModulePermissions($group, $name, $userLevel){
		$module = new Module();
		$module->Load("update_path = ?",array($group.">".$name));
		$arr = array();
		$arr['user'] = json_decode($module->user_levels,true);

		
		$permission = new Permission();
		$modulePerms = $permission->Find("module_id = ? and user_level = ?",array($module->id,$userLevel));

		
		$perms = array();
		foreach($modulePerms as $p){
			$perms[$p->permission] = $p->value;
		}
		
		$arr['perm'] = $perms;
		
		return $arr;
	}
	
	public function getGAKey(){
		return "";
	}
	
	public function setAuditManager($auditManager){
		$this->auditManager = $auditManager;
	}
	
	public function setNotificationManager($notificationManager){
		$this->notificationManager = $notificationManager;
	}
	
	public function setSettingsManager($settingsManager){
		$this->settingsManager = $settingsManager;
	}
	
	public function setFileFields($fileFields){
		$this->fileFields = $fileFields;
	}
	
	public function audit($type, $data){
		if(!empty($this->auditManager)){
			$this->auditManager->addAudit($type, $data);
		}
	}
	
	public function fixJSON($json){
		$noJSONRequests = SettingsManager::getInstance()->getSetting("System: Do not pass JSON in request");
		if($noJSONRequests."" == "1"){
			$json = str_replace("|",'"',$json);
		}
		return $json;
	}
	
	public function addModuleManager($moduleManager){
		if(empty($this->moduleManagers)){
			$this->moduleManagers = array();
		}
		$this->moduleManagers[] = $moduleManager;
	}
	
	public function getModuleManagers(){
		return $this->moduleManagers;
	}
	
	public function setEmailSender($emailSender){
		$this->emailSender = $emailSender;
	}
	
	public function getEmailSender(){
		return $this->emailSender;
	}
}

class IceConstants{
	const AUDIT_AUTHENTICATION = "Authentication";
	const AUDIT_ADD = "Add";
	const AUDIT_EDIT = "Edit";
	const AUDIT_DELETE = "Delete";
	const AUDIT_ERROR = "Error";
	const AUDIT_ACTION = "User Action";
	
	const NOTIFICATION_LEAVE = "Leave Module";
	const NOTIFICATION_TIMESHEET = "Time Module";
}