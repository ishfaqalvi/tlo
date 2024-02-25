<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\{Project,ResultFramework};
use Illuminate\Http\Request;

/**
 * Class ResultFrameworkController
 * @package App\Http\Controllers
 */
class ResultFrameworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:resultFrameworks-list',  ['only' => ['index']]);
        $this->middleware('permission:resultFrameworks-create',['only' => ['store']]);
        $this->middleware('permission:resultFrameworks-edit',  ['only' => ['update']]);
        $this->middleware('permission:resultFrameworks-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project = '';
        $resultFrameworkProjectId = $request->session()->get('resultFrameworkProjectId');
        if (!empty($resultFrameworkProjectId)) {
            $project = Project::find($resultFrameworkProjectId); 
        }

        return view('admin.result-framework.index', compact('project','resultFrameworkProjectId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resultFramework = ResultFramework::create($request->all());
        return redirect()->back()->with('success', 'Results Framework created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setProject(Request $request)
    {
        $request->session()->put('resultFrameworkProjectId', $request->id);
        return response()->json(['message' => 'Project selected successfully!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ResultFramework $resultFramework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $resultFramework = ResultFramework::find($request->id); 
        $resultFramework->update($request->all());

        return redirect()->back()->with('success', 'Result Framework updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $resultFramework = ResultFramework::find($id);
        if($resultFramework->children->isNotEmpty()){
            return redirect()->back()->with('warning', 'Opps! against this framework record exist.');
        }
        $resultFramework->delete();

        return redirect()->back()->with('success', 'Result Framework deleted successfully.');
    }
}
