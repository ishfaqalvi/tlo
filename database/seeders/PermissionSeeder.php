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
            $permissions = [ 
                  'projects-list', 
                  'projects-view', 
                  'projects-create', 
                  'projects-edit', 
                  'projects-delete',
                  'projectStakeholder-list',
                  'projectStakeholder-create',
                  'projectStakeholder-delete',

                  'stakeholders-list', 
                  'stakeholders-view', 
                  'stakeholders-create', 
                  'stakeholders-edit', 
                  'stakeholders-delete',

                  'categories-list', 
                  'categories-view', 
                  'categories-create', 
                  'categories-edit', 
                  'categories-delete',

                  'provinces-list', 
                  'provinces-view', 
                  'provinces-create', 
                  'provinces-edit', 
                  'provinces-delete',

                  'roles-list', 
                  'roles-view', 
                  'roles-create', 
                  'roles-edit', 
                  'roles-delete',

                  'users-list', 
                  'users-view', 
                  'users-create', 
                  'users-edit', 
                  'users-delete',

                  'notifications-list', 
                  'notifications-view', 
                  'notifications-create', 
                  'notifications-edit', 
                  'notifications-delete',

                  'audits-list', 
                  'audits-view', 
                  'audits-create', 
                  'audits-edit', 
                  'audits-delete',

                  'logs-list', 
                  'logs-view', 
                  'logs-create', 
                  'logs-edit', 
                  'logs-delete',

                  'settings-list',
                  'settings-create',
            ];
        
            foreach ($permissions as $permission) {
                  Permission::create(['name' => $permission]);
            }
      }
}