<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {
        // Create permissions


        //admin

        Permission::create(['name' => 'viewPermissions', 'display_name' => 'view permissions', 'role' => 'admin', 'description' => 'Allows admin view permissions']);
        Permission::create(['name' => 'setPermissions', 'display_name' => 'Set permissions to users', 'role' => 'admin', 'description' => 'Allows admin set/update permissions']);
        Permission::create(['name' => 'setRoles', 'display_name' => 'Set roles to users', 'role' => 'admin', 'description' => 'Allows admin set/update roles']);
        //!>


        //users
        Permission::create(['name' => 'checkIN', 'display_name' => 'Check in/out', 'role' => 'user', 'description' => 'Allows users check in/out']);
        Permission::create(['name' => 'vacationReq', 'display_name' => 'Vacation Request', 'role' => 'user', 'description' => 'Allows users to request vacations']);
        Permission::create(['name' => 'leaveReq', 'display_name' => 'Leave Request', 'role' => 'user', 'description' => 'Allows users to request leaves']);
        //!>


        //managers
        Permission::create(['name' => 'viewDepEmployees', 'display_name' => 'View Manager department`s staff ', 'role' => 'manager', 'description' => 'Allows manager to View Manager department`s staff ']);
        Permission::create(['name' => 'viewDepAttendence', 'display_name' => 'View Manager department`s staff attendence ', 'role' => 'manager', 'description' => 'Allows manager to View Manager department`s attendence ']);
        Permission::create(['name' => 'setDepSchedule', 'display_name' => 'Set Manager department`s staff schedule', 'role' => 'manager', 'description' => 'Allows manager to Set department`s staff schedule']);
        Permission::create(['name' => 'vacationReqAction', 'display_name' => 'Approve/Reject vacations requests', 'role' => 'manager', 'description' => 'Allows manager to Approve/Reject vacations requests']);
        Permission::create(['name' => 'leaveReqAction', 'display_name' => 'Approve/Reject leaves requests', 'role' => 'manager', 'description' => 'Allows manager to Approve/Reject leaves requests']);
        //!>


        //HR
        Permission::create(['name' => 'viewAllEmployees', 'display_name' => 'View all employees', 'role' => 'HR', 'description' => 'Allows HR to view all employees']);
        Permission::create(['name' => 'addEmployee', 'display_name' => 'Add employees', 'role' => 'HR', 'description' => 'Allows HR to Add employees']);
        Permission::create(['name' => 'editEmployee', 'display_name' => 'Edit employees', 'role' => 'HR', 'description' => 'Allows HR to Edit employees']);
        Permission::create(['name' => 'deleteEmployee', 'display_name' => 'Delete Employees', 'role' => 'HR', 'description' => 'Allows HR to Delete Employees']);
       
        Permission::create(['name' => 'setSchedule', 'display_name' => 'Set staff schedule', 'role' => 'HR', 'description' => 'Allows HR to Set staff schedule']);

        Permission::create(['name' => 'viewAttendence', 'display_name' => 'View employees attendence', 'role' => 'HR', 'description' => 'Allows HR to view employees attendence']);
        
        Permission::create(['name' => 'viewSalary', 'display_name' => 'View salaries', 'role' => 'HR', 'description' => 'Allows HR to View salaries']);
        Permission::create(['name' => 'editSalary', 'display_name' => 'Edit salaries', 'role' => 'HR', 'description' => 'Allows HR to Edit salaries']);
        
        Permission::create(['name' => 'viewDeduction', 'display_name' => 'View deductions', 'role' => 'HR', 'description' => 'Allows HR to view deductions']);
        Permission::create(['name' => 'addDeduction', 'display_name' => 'Add deductions', 'role' => 'HR', 'description' => 'Allows HR to add deductions']);
        Permission::create(['name' => 'editDeduction', 'display_name' => 'Edit deductions', 'role' => 'HR', 'description' => 'Allows HR to edit deductions']);

        Permission::create(['name' => 'viewAllownce', 'display_name' => 'View allownces', 'role' => 'HR', 'description' => 'Allows HR to view allownces']);
        Permission::create(['name' => 'addAllownce', 'display_name' => 'Add allownces', 'role' => 'HR', 'description' => 'Allows HR to add allownces']);
        Permission::create(['name' => 'editallownce', 'display_name' => 'Edit allownces', 'role' => 'HR', 'description' => 'Allows HR to edit allownces']);
        //!>



        //Accountant
        Permission::create(['name' => 'approvesalary', 'display_name' => 'Approve salaries', 'role' => 'accountant', 'description' => 'Allows accountant to Approve salaries']);
        Permission::create(['name' => 'approveDeduction', 'display_name' => 'Approve deductions', 'role' => 'accountant', 'description' => 'Allows accountant to Approve deductions']);
        Permission::create(['name' => 'approveAllownce', 'display_name' => 'Approve allownces', 'role' => 'accountant', 'description' => 'Allows accountant to Approve allownces']);
        
        Permission::create(['name' => 'salariesReport', 'display_name' => 'View salaries report', 'role' => 'accountant', 'description' => 'Allows accountant to view salaries report ']);
        Permission::create(['name' => 'deductionsReport', 'display_name' => 'View deductions report', 'role' => 'accountant', 'description' => 'Allows accountant to view deductions report ']);
        Permission::create(['name' => 'allowncesReport', 'display_name' => 'View allownces report', 'role' => 'accountant', 'description' => 'Allows accountant to view allownces report ']);
        //!>




    }
}
