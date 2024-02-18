<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\{Project,Stakeholder};
use App\Models\Project\ProjectStakeholder;
use Illuminate\Http\Request;

/**
 * Class StakeholderController
 * @package App\Http\Controllers
 */
class StakeholderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projectStakeholder-list',  ['only' => ['index']]);
        $this->middleware('permission:projectStakeholder-create',['only' => ['store']]);
        $this->middleware('permission:projectStakeholder-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::find($id);
        return view('admin.projects.stakeholder.index', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if ($input['option'] == 'New Add') {
            $stakeholder = Stakeholder::create($request->all());
            $input['stakeholder_id'] = $stakeholder->id;
        }
        ProjectStakeholder::create($input);
        return redirect()->back()->with('success', 'Stakeholder added successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $project = ProjectStakeholder::find($id)->delete();

        return redirect()->back()
            ->with('success', 'Stakeholder deleted successfully!');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRecord(Request $request)
    {
        $project    = $request->project_id;
        $stakeholder= $request->stakeholder_id;
        if(ProjectStakeholder::whereProjectId($project)->whereStakeholderId($stakeholder)->first()){
            echo "false";
        }else{
            echo "true";
        }
    }
}
