<?php

namespace App\Http\Controllers\Admin\Activity;
use App\Http\Controllers\Controller;

use App\Models\{Activity,Site};
use App\Models\Activity\ActivitySite;
use Illuminate\Http\Request;

/**
 * Class ActivitySiteController
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
        $this->middleware('permission:activitySite-list',  ['only' => ['index']]);
        $this->middleware('permission:activitySite-create',['only' => ['store']]);
        $this->middleware('permission:activitySite-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $activity = Activity::find($id);

        return view('admin.activities.site.index', compact('activity'));
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
        $activitySite = ActivitySite::create($input);
        return redirect()->back()->with('success', 'Site created successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $activitySite = ActivitySite::find($id)->delete();

        return redirect()->back()->with('success', 'Site deleted successfully!');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRecord(Request $request)
    {
        $activity= $request->activity_id;
        $site   = $request->site_id;
        if(ActivitySite::whereActivityId($activity)->whereSiteId($site)->first()){
            echo "false";
        }else{
            echo "true";
        }
    }
}
