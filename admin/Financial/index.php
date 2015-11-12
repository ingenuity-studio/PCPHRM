<?php
/*
This file is part of iCE Hrm.

iCE Hrm is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

iCE Hrm is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with iCE Hrm. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------

Original work Copyright (c) 2012 [Gamonoid Media Pvt. Ltd]  
Developer: Thilina Hasantha (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */
$moduleName = 'financial';
define('MODULE_PATH',dirname(__FILE__));
include APP_BASE_PATH.'header.php';
include APP_BASE_PATH.'modulejslibs.inc.php';
?><div class="span9">
	<ul class="nav nav-tabs" id="modTab" style="margin-bottom:0px;margin-left:5px;border-bottom: none;">
		<li class="active"><a id="tabBenefitsCategorys" href="#tabPageBenefitsCategorys">Benefits Category</a></li>
		<li ><a id="tabBenefits" href="#tabPageBenefits">Benefits Item</a></li>
		<li ><a id="tabAdvantagesCategorys" href="#tabPageAdvantagesCategorys">Advantages Category</a></li>
		<li ><a id="tabAdvantages" href="#tabPageAdvantages">Advantages Item</a></li>
		<li ><a id="tabAllowancesCategorys" href="#tabPageAllowancesCategorys">Allowances Category</a></li>
		<li ><a id="tabAllowances" href="#tabPageAllowances">Allowances Item</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="tabPageBenefitsCategorys">
			<div id="BenefitsCategorys" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="BenefitsCategorysForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
		<div class="tab-pane" id="tabPageBenefits">
				<div id="Benefits" class="reviewBlock" data-content="List" style="padding-left:5px;">

				</div>
				<div id="BenefitsForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">

				</div>
		</div>
		<div class="tab-pane" id="tabPageAdvantagesCategorys">
			<div id="AdvantagesCategorys" class="reviewBlock" data-content="List" style="padding-left:5px;">

			</div>
			<div id="AdvantagesCategorysForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">

			</div>
		</div>
		<div class="tab-pane" id="tabPageAdvantages">
			<div id="Advantages" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="AdvantagesForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
		<div class="tab-pane" id="tabPageAllowancesCategorys">
			<div id="AllowancesCategorys" class="reviewBlock" data-content="List" style="padding-left:5px;">

			</div>
			<div id="AllowancesCategorysForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">

			</div>
		</div>
		<div class="tab-pane" id="tabPageAllowances">
			<div id="Allowances" class="reviewBlock" data-content="List" style="padding-left:5px;">
		
			</div>
			<div id="AllowancesForm" class="reviewBlock" data-content="Form" style="padding-left:5px;display:none;">
		
			</div>
		</div>
	</div>
</div>
<script>
var modJsList = new Array();
modJsList['tabBenefitsCategorys'] = new CategorysAdapter('BenefitsCategorys');
modJsList['tabBenefits'] = new BenefitsAdapter('Benefits');
modJsList['tabAdvantagesCategorys'] = new CategorysAdapter('AdvantagesCategorys');
modJsList['tabAdvantages'] = new AdvantagesAdapter('Advantages');
modJsList['tabAllowancesCategorys'] = new CategorysAdapter('AllowancesCategorys');
modJsList['tabAllowances'] = new AllowancesAdapter('Allowances');
var modJs = modJsList['tabBenefitsCategorys'];
</script>

<?php include APP_BASE_PATH.'footer.php';?>