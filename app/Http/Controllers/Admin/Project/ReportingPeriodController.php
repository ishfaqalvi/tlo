<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Project\{ProjectReportingPeriod,ProjectReportingPeriodRange};
use Illuminate\Http\Request;

/**
 * Class ProjectReportingPeriodController
 * @package App\Http\Controllers
 */
class ReportingPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projectReportingPeriod-list',  ['only' => ['index']]);
        $this->middleware('permission:projectReportingPeriod-create',['only' => ['store']]);
        $this->middleware('permission:projectReportingPeriod-edit',  ['only' => ['update']]);
        $this->middleware('permission:projectReportingPeriod-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::find($id);

        return view('admin.projects.reporting-period.index', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProjectReportingPeriod::create($request->all());
        return redirect()->back()->with('success', 'Reporting Period created successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectReportingPeriod $projectReportingPeriod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $period = ProjectReportingPeriod::find($request->id);
        $period->update($request->all());

        return redirect()->back()->with('success', 'Reporting Period updated successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $period = ProjectReportingPeriod::find($id);
        if (count($period->ranges) > 0) {
            return redirect()->back()->with('warning', 'Opps! Ranges exist against this period!'); 
        }
        $period->delete();

        return redirect()->back()->with('success', 'Reporting Period deleted successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeRange(Request $request)
    {
        ProjectReportingPeriodRange::create($request->all());
        return redirect()->back()->with('success', 'Range created successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectReportingPeriod $projectReportingPeriod
     * @return \Illuminate\Http\Response
     */
    public function updateRange(Request $request)
    {
        $period = ProjectReportingPeriodRange::find($request->id);
        $period->update($request->all());

        return redirect()->back()->with('success', 'Range updated successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroyRange($id)
    {
        $period = ProjectReportingPeriodRange::find($id)->delete();

        return redirect()->back()->with('success', 'Range deleted successfully!');
    }
}
