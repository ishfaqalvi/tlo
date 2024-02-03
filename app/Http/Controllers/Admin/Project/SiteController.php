<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

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
        $this->middleware('permission:projectSite-create',['only' => ['store']]);
        $this->middleware('permission:projectSite-delete',['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectSite = ProjectSite::create($request->all());
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
