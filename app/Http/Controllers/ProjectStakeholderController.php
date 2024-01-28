<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\ProjectStakeholder;
use Illuminate\Http\Request;

/**
 * Class ProjectStakeholderController
 * @package App\Http\Controllers
 */
class ProjectStakeholderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projectStakeholders-list',  ['only' => ['index']]);
        $this->middleware('permission:projectStakeholders-view',  ['only' => ['show']]);
        $this->middleware('permission:projectStakeholders-create',['only' => ['create','store']]);
        $this->middleware('permission:projectStakeholders-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:projectStakeholders-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectStakeholders = ProjectStakeholder::get();

        return view('admin.project-stakeholder.index', compact('projectStakeholders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectStakeholder = new ProjectStakeholder();
        return view('admin.project-stakeholder.create', compact('projectStakeholder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectStakeholder = ProjectStakeholder::create($request->all());
        return redirect()->route('project-stakeholders.index')
            ->with('success', 'ProjectStakeholder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectStakeholder = ProjectStakeholder::find($id);

        return view('admin.project-stakeholder.show', compact('projectStakeholder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectStakeholder = ProjectStakeholder::find($id);

        return view('admin.project-stakeholder.edit', compact('projectStakeholder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectStakeholder $projectStakeholder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectStakeholder $projectStakeholder)
    {
        $projectStakeholder->update($request->all());

        return redirect()->route('project-stakeholders.index')
            ->with('success', 'ProjectStakeholder updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectStakeholder = ProjectStakeholder::find($id)->delete();

        return redirect()->route('project-stakeholders.index')
            ->with('success', 'ProjectStakeholder deleted successfully');
    }
}
