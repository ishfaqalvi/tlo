<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

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
        $this->middleware('permission:projectStakeholder-create',['only' => ['store']]);
        $this->middleware('permission:projectStakeholder-delete',['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = ProjectStakeholder::create($request->all());
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
