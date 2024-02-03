<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Project\ProjectPhase;
use Illuminate\Http\Request;

/**
 * Class PhaseController
 * @package App\Http\Controllers
 */
class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projectPhase-create',['only' => ['store']]);
        $this->middleware('permission:projectPhase-edit',  ['only' => ['update']]);
        $this->middleware('permission:projectPhase-delete',['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectPhase = ProjectPhase::create($request->all());
        return redirect()->back()->with('success', 'Phase created successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectPhase $projectPhase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $projectPhase = ProjectPhase::find($request->id);
        $projectPhase->update($request->all());

        return redirect()->back()->with('success', 'Phase updated successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectPhase = ProjectPhase::find($id)->delete();

        return redirect()->back()->with('success', 'Phase deleted successfully!');
    }
}
