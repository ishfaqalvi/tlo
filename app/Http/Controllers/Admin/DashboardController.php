<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Project,ResultFramework,Indicator,Activity,Stakeholder,Site,Beneficiary,Feadback,Lesson,RiskPlan
};
use App\Models\Catalog\{Category,Province,ComplaintType};

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function widgets()
    {
        $widgets = [
            'projects'        => Project::count(),
            'resultFramework' => ResultFramework::whereNull('parent_id')->count(),
            'indicators'      => Indicator::count(),
            'activities'      => Activity::count(),
            'stakeholders'    => Stakeholder::count(),
            'sites'           => Site::count(),
            'beneficiaries'   => Beneficiary::count(),
            'feadbacks'       => Feadback::count()
        ];
        return view('admin.dashboard.widgets', compact('widgets'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function projects()
    {
        $stages = ['Pipeline', 'Implementation', 'Finalisation', 'Inprogress', 'On Track', 'Delays', 'Closed', 'Cancelled', 'Suspended'];
        $projectsCountByStage = [];
        foreach ($stages as $stage) {
            $count = Project::where('stage', $stage)->count();
            $projectsCountByStage[$stage] = $count;
        }

        $categories = Category::withCount('projects')->get();
        $totalProjects = Project::count();
        $categoriesData = $categories->map(function ($category) use ($totalProjects) {
            $categoryProjectsCount = $category->projects_count;
            $percentage = $totalProjects > 0 ? ($categoryProjectsCount / $totalProjects) * 100 : 0;
            return [
                'category_name' => $category->title,
                'projects_count' => $categoryProjectsCount,
                'percentage' => $percentage,
            ];
        });
        $provinces = Province::withCount('projects')->get();
        return view('admin.dashboard.projects', compact('projectsCountByStage','categoriesData','provinces'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function budget(Request $request)
    {
        $selectedProject = '';
        $selectedProject = $request->session()->get('dashboardBudgetProjectId');
        if (!empty($selectedProject)) {
            $projects = Project::with('activities.budgets')->whereId($selectedProject)->get();
        }else{
            $projects = Project::with('activities.budgets')->get();    
        }
        $total = 0;
        $spent = 0;
        foreach($projects as $project){
            $total += $project->activities->flatMap(function ($activity) {
                return $activity->budgets;
            })->sum('budget_amount');
            $spent += $project->activities->flatMap(function ($activity) {
                return $activity->budgets;
            })->sum('actual_spent');
        }
        $projectData = ['total' => $total, 'spent'=>$spent,'remaining'=>$total-$spent];

        $selectedActivity = '';
        $selectedActivity = $request->session()->get('dashboardBudgetActivityId');
        if (!empty($selectedActivity)) {
            $activities = Activity::with('budgets')->whereId($selectedActivity)->get();
        }else{
            $activities = Activity::with('budgets')->get();    
        }
        $total = 0;
        $spent = 0;
        $total = $activities->flatMap(function ($activity) {
                return $activity->budgets;
            })->sum('budget_amount');
        $spent = $activities->flatMap(function ($activity) {
            return $activity->budgets;
        })->sum('actual_spent');
        $activityData = ['total' => $total, 'spent'=>$spent,'remaining'=>$total-$spent];
        return view('admin.dashboard.budget', compact('projectData','selectedProject','activityData','selectedActivity'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indicators(Request $request)
    {
        $selectedProject = $request->session()->get('dashboardIndicatorProjectId');
    
        // Use a base query to avoid repetition
        $baseQuery = Indicator::query();
        
        if ($selectedProject) {
            $baseQuery->where('project_id', $selectedProject);
        }

        // Retrieve all indicators based on the selected project, if any
        $indicators = $baseQuery->get();

        // Retrieve data indicators excluding 'Qualitative Only' and where 'aggregated' is null
        $dataindicators = $baseQuery->where('format', '!=', 'Qualitative Only')
                                    ->whereNull('aggregated')
                                    ->get();

        // Define statuses and prepare to count indicators by status
        $statuses = ['Not yet started', 'Postponed', 'Paused', 'On Track', 'Minor Delays', 'Major Delays'];
        $statusCounts = $this->countIndicatorsByStatus($baseQuery, $statuses);

        return view('admin.dashboard.indicators', compact('indicators', 'dataindicators', 'statusCounts', 'selectedProject'));
    }

    /**
     * Count indicators by their statuses.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $statuses
     * @return array
     */
    protected function countIndicatorsByStatus($query, $statuses)
    {
        $statusCounts = [];
        foreach ($statuses as $status) {
            $count = (clone $query)->where('status', $status)->count();
            $statusCounts[$status] = $count;
        }

        return $statusCounts;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function feadbacks()
    {
        // Type-wise feedback count
        $typeWise = ComplaintType::withCount('feadbacks')->get();

        // Sensitivity-wise feedback count
        $sensitivityCounts = Feadback::whereHas('complaintType', function ($query) {
            $query->whereIn('type', ['Sensitive', 'Insensitive']);
        })->get()->groupBy('complaintType.type')->map->count();

        $sensitive = $sensitivityCounts->get('Sensitive', 0);
        $insensitive = $sensitivityCounts->get('Insensitive', 0);
        $sensitiveness = ['first'=> $sensitive, 'second' => $insensitive];

        // Agreement-wise feedback count
        $agreementCounts = Feadback::whereIn('status', ['Closed', 'Reprocessing'])
                            ->get()->groupBy('status')->map->count();

        $agree = $agreementCounts->get('Closed', 0);
        $disagree = $agreementCounts->get('Reprocessing', 0);
        $agreeness = ['first' => $agree, 'second' => $disagree];

        // Status-wise feedback count (Optimized to a single query and mapping)
        $statusCounts = Feadback::whereIn('status', ['Pending', 'Assign', 'Processing', 'Reprocessing', 'Closed'])
                            ->get()->groupBy('status')->map->count();

        $statusWise = [
            'Pending' => $statusCounts->get('Pending', 0),
            'Assign' => $statusCounts->get('Assign', 0),
            'Processing' => $statusCounts->get('Processing', 0),
            'Reprocessing' => $statusCounts->get('Reprocessing', 0),
            'Closed' => $statusCounts->get('Closed', 0),
        ];

        return view('admin.dashboard.feadbacks', compact('typeWise', 'sensitiveness', 'agreeness', 'statusWise'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function beneficiaries()
    {
        $projectWise = Project::withCount('beneficiaries')->get();
        
        $gender = Beneficiary::get()->groupBy('gender')->map->count();
        $genderBase = ['Male' => $gender->get('Male', 0), 'Female' => $gender->get('Female', 0)];
        
        return view('admin.dashboard.beneficiaries', compact('projectWise','genderBase'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function lessons()
    {
        $projectWise = Project::withCount('lessons')->get();
        $need = Lesson::get()->groupBy('neded')->map->count();
        $needBase = ['Yes' => $need->get('Yes', 0), 'No' => $need->get('No', 0)];
        
        return view('admin.dashboard.lessons', compact('projectWise','needBase'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function riskPlans()
    {
        $projectWise = Project::withCount('riskPlans')->get();

        $probability = RiskPlan::get()->groupBy('probability')->map->count();
        $probabilityBase = [
            $probability->get('High 3', 0), 
            $probability->get('Medium 2', 0),
            $probability->get('Low 1', 0)
        ];

        $impact = RiskPlan::get()->groupBy('impact')->map->count();
        $impactBase = [
            $impact->get('High 3', 0), 
            $impact->get('Medium 2', 0),
            $impact->get('Low 1', 0)
        ];

        $priority = RiskPlan::get()->groupBy('priority')->map->count();
        $priorityBase = [
            $priority->get('1', 0), 
            $priority->get('2', 0),
            $priority->get('3', 0)
        ];

        $level = RiskPlan::get()->groupBy('level')->map->count();
        $levelBase = [
            $level->get('9', 0), 
            $level->get('6', 0),
            $level->get('3', 0),
            $level->get('2', 0)
        ];

        $strategy = RiskPlan::get()->groupBy('strategy')->map->count();
        $strategyBase = [
            $strategy->get('Avoid', 0), 
            $strategy->get('Mitigate', 0),
            $strategy->get('Transfer', 0),
            $strategy->get('Accepted', 0)
        ];

        $status = RiskPlan::get()->groupBy('status')->map->count();
        $statusBase = [
            $status->get('Started', 0), 
            $status->get('Open', 0),
            $status->get('Closed', 0)
        ];
        // dd($probabilityBase);
        return view('admin.dashboard.risk_plan', compact('projectWise','probabilityBase','impactBase','priorityBase','levelBase','strategyBase','statusBase'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setProject(Request $request)
    {
        if ($request->type == 'Indicator') {
            $request->session()->put('dashboardIndicatorProjectId', $request->id);    
        }else{
            $request->session()->put('dashboardBudgetProjectId', $request->id);
        }
        
        return response()->json(['message' => 'Project selected successfully!']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setActivity(Request $request)
    {
        $request->session()->put('dashboardBudgetActivityId', $request->id);
        return response()->json(['message' => 'Activity selected successfully!']);
    }
}
