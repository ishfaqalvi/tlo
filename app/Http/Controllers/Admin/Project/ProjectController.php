<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Project;
use Illuminate\Http\Request;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projects-list',  ['only' => ['index']]);
        $this->middleware('permission:projects-view',  ['only' => ['show']]);
        $this->middleware('permission:projects-create',['only' => ['create','store']]);
        $this->middleware('permission:projects-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:projects-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::filter($request->all())->get();
        $request->method() == 'POST' ? $userRequest = $request : $userRequest = null;

        return view('admin.projects.project.index', compact('projects','userRequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        return view('admin.projects.project.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = Project::create($request->all());
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        return view('admin.projects.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        return view('admin.projects.project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        if ($request->provinces) {
            $project->provinces()->delete();
            foreach($request->provinces as $id){
                $project->provinces()->create(['province_id' => $id]);
            }
        }

        return redirect()->back()->with('success', 'Project updated successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $project = Project::find($id)->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
