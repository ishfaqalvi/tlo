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
                  'projectPhase-list',
                  'projectPhase-create',
                  'projectPhase-edit',
                  'projectPhase-delete',
                  'projectSite-list',
                  'projectSite-create',
                  'projectSite-delete',
                  'projectActivity-list',
                  'projectActivity-create',
                  'projectActivity-edit',
                  'projectActivity-delete',

                  'stakeholders-list', 
                  'stakeholders-view', 
                  'stakeholders-create', 
                  'stakeholders-edit', 
                  'stakeholders-delete',

                  'sites-list', 
                  'sites-view', 
                  'sites-create', 
                  'sites-edit', 
                  'sites-delete',

                  'activities-list', 
                  'activities-view', 
                  'activities-create', 
                  'activities-edit', 
                  'activities-delete',

                  'indicators-list', 
                  'indicators-view', 
                  'indicators-create', 
                  'indicators-edit', 
                  'indicators-delete',

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

                  'stakeholderRoles-list', 
                  'stakeholderRoles-view', 
                  'stakeholderRoles-create', 
                  'stakeholderRoles-edit', 
                  'stakeholderRoles-delete',

                  'siteTypes-list', 
                  'siteTypes-view', 
                  'siteTypes-create', 
                  'siteTypes-edit', 
                  'siteTypes-delete',

                  'activityProgress-list', 
                  'activityProgress-view', 
                  'activityProgress-create', 
                  'activityProgress-edit', 
                  'activityProgress-delete',

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