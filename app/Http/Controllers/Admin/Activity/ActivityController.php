<?php

namespace App\Http\Controllers\Admin\Activity;
use App\Http\Controllers\Controller;

use App\Models\Activity;
use Illuminate\Http\Request;

/**
 * Class ActivityController
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
    public function index(Request $request)
    {
        $activities = Activity::filter($request->all())->get();
        $request->method() == 'POST' ? $userRequest = $request : $userRequest = null;

        return view('admin.activities.activity.index', compact('activities','userRequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activity = new Activity();
        return view('admin.activities.activity.create', compact('activity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = Activity::create($request->all());
        return redirect()->route('activities.index')
            ->with('success', 'Activity created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);

        return view('admin.activities.activity.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);

        return view('admin.activities.activity.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Activity $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $activity->update($request->all());
        if (is_null($activity->milestone)) {
            $activity->start_date = null;
            $activity->save();
        }
        return redirect()->route('activities.index')
            ->with('success', 'Activity updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $activity = Activity::find($id)->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Activity deleted successfully');
    }
}
