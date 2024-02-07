<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Project\ProjectIndicator;
use Illuminate\Http\Request;

/**
 * Class ProjectIndicatorController
 * @package App\Http\Controllers
 */
class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:indicators-list',  ['only' => ['index']]);
        $this->middleware('permission:indicators-view',  ['only' => ['show']]);
        $this->middleware('permission:indicators-create',['only' => ['create','store']]);
        $this->middleware('permission:indicators-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:indicators-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectIndicators = ProjectIndicator::get();

        return view('admin.indicator.index', compact('projectIndicators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectIndicator = new ProjectIndicator();
        return view('admin.indicator.create', compact('projectIndicator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $projectIndicator = ProjectIndicator::create($request->all());
        return redirect()->route('indicators.index')
            ->with('success', 'Indicator created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectIndicator = ProjectIndicator::find($id);

        return view('admin.indicator.show', compact('projectIndicator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectIndicator = ProjectIndicator::find($id);

        return view('admin.indicator.edit', compact('projectIndicator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectIndicator $projectIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectIndicator $indicator)
    {
        $indicator->update($request->all());

        return redirect()->route('indicators.index')
            ->with('success', 'Indicator updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectIndicator = ProjectIndicator::find($id)->delete();

        return redirect()->route('indicators.index')
            ->with('success', 'Indicator deleted successfully');
    }
}
