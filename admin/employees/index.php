<?php

$moduleName = 'employees';
define('MODULE_PATH',dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';
?><div class="span9">
			  
	<ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
		<li class="active"><a id="tabEmployee" href="#tabPageEmployee">Employees</a></li>
	</ul>
	 
	<div class="tab-content">
		<div class="tab-pane active" id="tabPageEmployee">
			<div id="Employee" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="EmployeeForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">

			</div>
			<div class="modal" id="tabProject" tabindex="-1" role="dialog" aria-labelledby="adminTransferEmployeeModelLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><li class="fa fa-times"/></button>
							<h3 style="font-size: 17px;">Transfer Employee To Project</h3>
						</div>
						<div class="modal-body">
							<div class="control-group">
								<label class="control-label" for="newproject">To : </label>
								<div class="controls" id="ProjectForm" class="reviewBlock" data-content="Form">

									<span class="help-inline" id="help_newproject"></span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary" onclick="modJs.transferEmployee();">Transfer</button>
							<button class="btn" onclick="modJs.closeTransferWindows();">Not Now</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<script>
var modJsList = new Array();
modJsList['tabEmployee'] = new EmployeeAdapter('Employee');
modJsList['tabEmployee'].setRemoteTable(true);
modJsList['tabProject'] = new ProjectAdapter('Project');
modJsList['tabProject'].setRemoteTable(true);
var modJs = modJsList['tabEmployee'];
var num=0;
modJs.getInitData();
</script>
<?php include APP_BASE_PATH.'footer.php';?>
