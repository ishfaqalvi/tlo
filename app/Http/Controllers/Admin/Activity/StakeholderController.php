<?php

namespace App\Http\Controllers\Admin\Activity;
use App\Http\Controllers\Controller;

use App\Models\{Activity,Stakeholder};
use App\Models\Activity\ActivityStakeholder;
use Illuminate\Http\Request;

/**
 * Class ActivityStakeholderController
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
        $this->middleware('permission:activityStakeholder-list',  ['only' => ['index']]);
        $this->middleware('permission:activityStakeholder-create',['only' => ['store']]);
        $this->middleware('permission:activityStakeholder-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $activity = Activity::find($id);

        return view('admin.activities.stakeholder.index', compact('activity'));
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
        ActivityStakeholder::create($input);
        return redirect()->back()->with('success', 'Stakeholder created successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $activityStakeholder = ActivityStakeholder::find($id)->delete();

        return redirect()->back()->with('success', 'Stakeholder deleted successfull!y');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRecord(Request $request)
    {
        $activity= $request->activity_id;
        $stakeholder   = $request->stakeholder_id;
        if(ActivityStakeholder::whereActivityId($activity)->whereStakeholderId($stakeholder)->first()){
            echo "false";
        }else{
            echo "true";
        }
    }
}
