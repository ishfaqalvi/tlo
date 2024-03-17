<?php

use App\Models\{Project,Activity,User,Stakeholder,Site,Indicator,ResultFramework};
use App\Models\Project\{ProjectPhase,ProjectReportingPeriod,ProjectDisaggregation};
use App\Models\Catalog\{Category,Province,StakeholderRole,ThematicArea,ComplaintType};

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function categories()
{
    return Category::pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function provinces()
{
    return Province::pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function stakeholderRoles()
{
    return StakeholderRole::pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function thematicAreas()
{
    return ThematicArea::pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function complaintTypes()
{
    return ComplaintType::get();
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function users()
{
    return User::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function stakeholders()
{
    return Stakeholder::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function sites()
{
    return Site::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function projects()
{
    return Project::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function activities()
{
    return Activity::pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function projectSites($id)
{
    return Site::select('sites.*')->join('project_sites','project_sites.site_id','=','sites.id')
        ->where('project_sites.project_id',$id)->pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function projectPhases($id)
{
    return ProjectPhase::whereProjectId($id)->pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function projectReportingPeriods($id)
{
    return ProjectReportingPeriod::whereProjectId($id)->pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function projectDisaggregations($id)
{
    return ProjectDisaggregation::whereProjectId($id)->pluck('type','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function resultFrameworks($id)
{
    return ResultFramework::whereProjectId($id)->pluck('title','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function indicators($id)
{
    return Indicator::whereProjectId($id)->pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function contributerIndicators($indicator)
{
    $project = $indicator->project;
    return $project->indicators()->whereFormat($indicator->format)->whereNull('aggregated')->pluck('name','id');
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function indicatorDisaggregations($id)
{
    return ProjectDisaggregation::select('project_disaggregations.*')
        ->join(
            'indicator_disaggregation_types',
            'indicator_disaggregation_types.project_disaggregation_id',
            '=',
            'project_disaggregations.id')
        ->where('indicator_disaggregation_types.indicator_id',$id)->pluck('type','id');
}