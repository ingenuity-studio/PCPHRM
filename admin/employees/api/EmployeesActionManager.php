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


class EmployeesActionManager extends SubActionManager{
	
	public function getInitData($req){

		$data = array();
		$employees = new Employee();
		$data['numberOfEmployees'] = $employees->Count("1 = 1");
		
		$company = new CompanyStructure();
		$data['numberOfCompanyStuctures'] = $company->Count("1 = 1");
		
		$user = new User();
		$data['numberOfUsers'] = $user->Count("1 = 1");
		
		$project = new Project();
		$data['numberOfProjects'] = $project->Count("status = 'Active'");
		
		$attendance = new Attendance();
		$data['numberOfAttendanceLastWeek'] = $attendance->Count("in_time > '".date("Y-m-d H:i:s",strtotime("-1 week"))."'");
		
		$empLeave = new EmployeeLeave();
		$data['numberOfLeaves'] = $empLeave->Count("date_start > '".date("Y-m-d")."'");
		
		$timeEntry = new EmployeeTimeEntry();
		$data['numberOfAttendanceLastWeek'] = $attendance->Count("in_time > '".date("Y-m-d H:i:s",strtotime("-1 week"))."'");
		
		
		return new IceResponse(IceResponse::SUCCESS,$data);
		
	}
	public function saveEmployee($req)
	{
		$req=(array)$req;
		$employee = new Employee();

		foreach($req as $key => $value)
		{
			if(preg_match('/employee_education\d/',$key)){
				$employee_education[] = $value;
				unset($req[$key]);
			}
			if(preg_match('/employee_institution\d/',$key)){
				$employee_institution[] = $value;
				unset($req[$key]);
			}
		}

		$employee->employee_education=serialize($employee_education);
		$employee->employee_institution=serialize($employee_institution);
		$employee->employee_id = $req['employee_id'];
		$employee->first_name = $req['first_name'];
		$employee->middle_name = $req['middle_name'];
		$employee->last_name = $req['last_name'];
		$employee->nationality = $req['nationality'];
		$employee->birthday = $req['birthday'];
		$employee->gender = $req['gender'];
		$employee->marital_status = $req['marital_status'];
		$employee->military_status = $req['military_status'];
		$employee->id_number = $req['id_number'];
		$employee->id_expdate = $req['id_expdate'];
		$employee->postal_code = $req['postal_code'];
		$employee->home_phone = $req['home_phone'];
		$employee->mobile_phone = $req['mobile_phone'];
		$employee->work_email = $req['work_email'];
		$employee->address1 = $req['address1'];
		$employee->address2 = $req['address2'];
		$employee->city = $req['city'];
		$employee->province = $req['province'];
		$employee->country = $req['country'];
		$employee->language_id = $req['language_id'];
		$employee->reading = $req['reading'];
		$employee->writing = $req['writing'];
		$employee->understanding = $req['understanding'];
		$employee->private_email = $req['private_email'];
		$employee->car_owner = $req['car_owner'];
		$employee->driving_license = $req['driving_license'];
		$employee->driving_license_exp_date = $req['driving_license_exp_date'];
		$employee->bank_account = $req['bank_account'];
		$employee->contract_startdate = $req['contract_startdate'];
		$employee->contract_enddate = $req['contract_enddate'];
		$employee->employment_status = $req['employment_status'];
		$employee->job_title = $req['job_title'];
		$employee->pay_grade = $req['pay_grade'];
		$employee->work_station_id = $req['work_station_id'];
		$employee->joined_date = $req['joined_date'];
		$employee->confirmation_date = $req['confirmation_date'];
		$employee->department = $req['department'];
		$employee->supervisor = $req['supervisor'];
		$ok = $employee->Save();
		if($ok)
			return new IceResponse(IceResponse::SUCCESS,$employee);
		else
			return new IceResponse(IceResponse::ERROR,"");

	}
	
}