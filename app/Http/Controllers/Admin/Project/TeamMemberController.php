<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Project\ProjectTeamMember;
use Illuminate\Http\Request;

/**
 * Class ProjectTeamMemberController
 * @package App\Http\Controllers
 */
class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projectTeamMember-list',  ['only' => ['index']]);
        $this->middleware('permission:projectTeamMember-create',['only' => ['store']]);
        $this->middleware('permission:projectTeamMember-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::find($id);

        return view('admin.projects.team-member.index', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectTeamMember = ProjectTeamMember::create($request->all());
        return redirect()->back()->with('success', 'Member added successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectTeamMember = ProjectTeamMember::find($id)->delete();

        return redirect()->back()->with('success', 'Member deleted successfully!');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRecord(Request $request)
    {
        $project = $request->project_id;
        $user    = $request->user_id;
        if(ProjectTeamMember::whereProjectId($project)->whereUserId($user)->first()){
            echo "false";
        }else{
            echo "true";
        }
    }
}
