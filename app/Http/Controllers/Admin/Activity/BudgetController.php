<?php

namespace App\Http\Controllers\Admin\Activity;
use App\Http\Controllers\Controller;

use App\Models\Activity;
use App\Models\Activity\ActivityBudget;
use Illuminate\Http\Request;

/**
 * Class ActivityBudgetController
 * @package App\Http\Controllers
 */
class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:activityBudget-list',  ['only' => ['index']]);
        $this->middleware('permission:activityBudget-create',['only' => ['store']]);
        $this->middleware('permission:activityBudget-edit',  ['only' => ['update']]);
        $this->middleware('permission:activityBudget-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $activity = Activity::find($id);

        return view('admin.activities.budget.index', compact('activity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activityBudget = ActivityBudget::create($request->all());
        return redirect()->back()->with('success', 'Budget created successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ActivityBudget $activityBudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $activity = ActivityBudget::find($request->id);
        $activity->update($request->all());

        return redirect()->back()->with('success', 'Budget updated successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $activityBudget = ActivityBudget::find($id)->delete();

        return redirect()->back()->with('success', 'Budget deleted successfully!');
    }
}
