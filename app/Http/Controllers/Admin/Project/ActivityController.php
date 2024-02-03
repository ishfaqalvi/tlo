<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Project\ProjectActivity;
use Illuminate\Http\Request;

/**
 * Class ProjectActivityController
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
        $this->middleware('permission:projectActivity-create',['only' => ['store']]);
        $this->middleware('permission:projectActivity-edit',  ['only' => ['update']]);
        $this->middleware('permission:projectActivity-delete',['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectActivity = ProjectActivity::create($request->all());
        return redirect()->back()->with('success', 'Activity created successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectActivity $projectActivity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $activity = ProjectActivity::find($request->id);
        if($request->milestone == 0){
            $input['start_date'] = null; 
        }
        $activity->update($input);

        return redirect()->back()->with('success', 'Activity updated successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectActivity = ProjectActivity::find($id)->delete();

        return redirect()->back()->with('success', 'Activity deleted successfully!');
    }
}
