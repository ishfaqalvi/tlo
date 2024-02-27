<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Project\ProjectDisaggregation;
use Illuminate\Http\Request;

/**
 * Class ProjectDisaggregationController
 * @package App\Http\Controllers
 */
class DisaggregationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projectDisaggregation-list',  ['only' => ['index']]);
        $this->middleware('permission:projectDisaggregation-create',['only' => ['store']]);
        $this->middleware('permission:projectDisaggregation-edit',  ['only' => ['update']]);
        $this->middleware('permission:projectDisaggregation-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::find($id);

        return view('admin.projects.disaggregation.index', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $disaggregation = ProjectDisaggregation::create($request->all());
        foreach($request->fields as $title){
            $disaggregation->fields()->create(['name' => $title]);
        }
        return redirect()->back()->with('success', 'Disaggregation created successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectDisaggregation $projectDisaggregation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $disaggregation = ProjectDisaggregation::find($request->id);
        $disaggregation->update($request->all());
        $disaggregation->fields()->delete();
        foreach($request->fields as $title){
            $disaggregation->fields()->create(['name' => $title]);
        }

        return redirect()->back()->with('success', 'Disaggregation updated successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        ProjectDisaggregation::find($id)->delete();

        return redirect()->back()->with('success', 'Disaggregation deleted successfully!');
    }
}
