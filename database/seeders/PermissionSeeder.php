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

                  'projectSite-list',
                  'projectSite-create',
                  'projectSite-delete',

                  'projectPhase-list',
                  'projectPhase-create',
                  'projectPhase-edit',
                  'projectPhase-delete',

                  'projectStakeholder-list',
                  'projectStakeholder-create',
                  'projectStakeholder-delete',
                  
                  'projectFile-list',
                  'projectFile-create',
                  'projectFile-edit',
                  'projectFile-delete',

                  'projectDisaggregation-list',
                  'projectDisaggregation-create',
                  'projectDisaggregation-edit',
                  'projectDisaggregation-delete',

                  'projectTeamMember-list',
                  'projectTeamMember-create',
                  'projectTeamMember-delete',

                  'projectReportingPeriod-list',
                  'projectReportingPeriod-create',
                  'projectReportingPeriod-edit',
                  'projectReportingPeriod-delete',

                  'resultFrameworks-list', 
                  'resultFrameworks-view', 
                  'resultFrameworks-create', 
                  'resultFrameworks-edit', 
                  'resultFrameworks-delete',

                  'indicators-list', 
                  'indicators-view', 
                  'indicators-create', 
                  'indicators-edit', 
                  'indicators-delete',

                  'indicatorTarget-list', 
                  'indicatorTarget-link', 
                  'indicatorTarget-unlink',

                  'indicatorDataCollections-list',
                  'indicatorDataCollections-view', 
                  'indicatorDataCollections-create', 
                  'indicatorDataCollections-edit',
                  'indicatorDataCollections-delete',
 
                  'indicatorDataDisaggregation-create', 
                  'indicatorDataDisaggregation-edit', 
                  'indicatorDataDisaggregation-delete',

                  'indicatorContributions-list', 
                  'indicatorContributions-create', 
                  'indicatorContributions-delete',

                  'activities-list', 
                  'activities-view', 
                  'activities-create', 
                  'activities-edit', 
                  'activities-delete',

                  'activityBudget-list',
                  'activityBudget-create', 
                  'activityBudget-edit', 
                  'activityBudget-delete',

                  'activityFile-list',
                  'activityFile-create', 
                  'activityFile-edit', 
                  'activitiFile-delete',

                  'activitySite-list',
                  'activitySite-create',
                  'activitySite-delete',

                  'activityStakeholder-list',
                  'activityStakeholder-create',
                  'activityStakeholder-delete',

                  'activityIndicator-list',
                  'activityIndicator-create',
                  'activityIndicator-delete',

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

                  'thematicArea-list', 
                  'thematicArea-view', 
                  'thematicArea-create', 
                  'thematicArea-edit', 
                  'thematicArea-delete',

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