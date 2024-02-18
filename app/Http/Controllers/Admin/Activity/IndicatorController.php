<?php

namespace App\Http\Controllers\Admin\Activity;
use App\Http\Controllers\Controller;

use App\Models\Activity;
use App\Models\Activity\ActivityIndicator;
use Illuminate\Http\Request;

/**
 * Class ActivityIndicatorController
 * @package App\Http\Controllers
 */
class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:activityIndicator-list',  ['only' => ['index']]);
        $this->middleware('permission:activityIndicator-create',['only' => ['store']]);
        $this->middleware('permission:activityIndicator-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $activity = Activity::find($id);

        return view('admin.activities.indicator.index', compact('activity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activityIndicator = ActivityIndicator::create($request->all());
        return redirect()->back()->with('success', 'Indicator created successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $activityIndicator = ActivityIndicator::find($id)->delete();

        return redirect()->back()->with('success', 'Indicator deleted successfully!');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRecord(Request $request)
    {
        $activity= $request->activity_id;
        $indicator   = $request->indicator_id;
        if(ActivityIndicator::whereActivityId($activity)->whereIndicatorId($indicator)->first()){
            echo "false";
        }else{
            echo "true";
        }
    }
}
