<?php

namespace App\Http\Controllers\Admin\Catalog;
use App\Http\Controllers\Controller;

use App\Models\Catalog\ActivityProgress;
use Illuminate\Http\Request;

/**
 * Class ActivityProgressController
 * @package App\Http\Controllers
 */
class ActivityProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:activityProgress-list',  ['only' => ['index']]);
        $this->middleware('permission:activityProgress-view',  ['only' => ['show']]);
        $this->middleware('permission:activityProgress-create',['only' => ['create','store']]);
        $this->middleware('permission:activityProgress-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:activityProgress-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activityProgresses = ActivityProgress::get();

        return view('admin.catalog.activity-progress.index', compact('activityProgresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activityProgress = new ActivityProgress();
        return view('admin.catalog.activity-progress.create', compact('activityProgress'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activityProgress = ActivityProgress::create($request->all());
        return redirect()->route('activity-progresses.index')
            ->with('success', 'ActivityProgress created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activityProgress = ActivityProgress::find($id);

        return view('admin.catalog.activity-progress.show', compact('activityProgress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activityProgress = ActivityProgress::find($id);

        return view('admin.catalog.activity-progress.edit', compact('activityProgress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ActivityProgress $activityProgress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivityProgress $progress)
    {
        $progress->update($request->all());

        return redirect()->route('activity-progresses.index')
            ->with('success', 'ActivityProgress updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $activityProgress = ActivityProgress::find($id)->delete();

        return redirect()->route('activity-progresses.index')
            ->with('success', 'ActivityProgress deleted successfully');
    }
}
