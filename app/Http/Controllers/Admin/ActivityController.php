<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Project\{ProjectActivity,ProjectPhase};
use App\Models\Site;
use Illuminate\Http\Request;

/**
 * Class ProjectActivityController
 * @package App\Http\Controllers
 */
class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:activities-list',  ['only' => ['index']]);
        $this->middleware('permission:activities-view',  ['only' => ['show']]);
        $this->middleware('permission:activities-create',['only' => ['create','store']]);
        $this->middleware('permission:activities-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:activities-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectActivities = ProjectActivity::get();

        return view('admin.activity.index', compact('projectActivities'));
    }

    /**
     * Get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPhase(Request $request)
    {
        
        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectActivity = new ProjectActivity();
        return view('admin.activity.create', compact('projectActivity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectActivity = ProjectActivity::create($request->all());
        return redirect()->route('activities.index')
            ->with('success', 'Project Activity created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectActivity = ProjectActivity::find($id);

        return view('admin.activity.show', compact('projectActivity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectActivity = ProjectActivity::find($id);

        return view('admin.activity.edit', compact('projectActivity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectActivity $projectActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectActivity $activity)
    {
        $activity->update($request->all());

        return redirect()->route('activities.index')
            ->with('success', 'Project Activity updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectActivity = ProjectActivity::find($id)->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Project Activity deleted successfully');
    }

    /**
     * Get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDropdown(Request $request)
    {
        $sites = Site::select('sites.*')->join('project_sites','project_sites.site_id','=','sites.id')->where('project_sites.project_id',$request->id)->get();
        $phase = ProjectPhase::whereProjectId($request->id)->get();
        echo json_encode(['sites' => $sites,'phase'=>$phase]);
    }
}
