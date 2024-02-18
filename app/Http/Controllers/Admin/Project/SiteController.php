<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\{Project,Site};
use App\Models\Project\ProjectSite;
use Illuminate\Http\Request;

/**
 * Class ProjectSiteController
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projectSite-list',  ['only' => ['index']]);
        $this->middleware('permission:projectSite-create',['only' => ['store']]);
        $this->middleware('permission:projectSite-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::find($id);
        return view('admin.projects.site.index', compact('project'));
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
        if ($input['type'] == 'New Add') {
            $site = Site::create($request->all());
            $input['site_id'] = $site->id;
        }
        ProjectSite::create($input);
        return redirect()->back()->with('success', 'Site created successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectSite = ProjectSite::find($id)->delete();

        return redirect()->back()->with('success', 'Site deleted successfully!');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRecord(Request $request)
    {
        $project= $request->project_id;
        $site   = $request->site_id;
        if(ProjectSite::whereProjectId($project)->whereSiteId($site)->first()){
            echo "false";
        }else{
            echo "true";
        }
    }
}
