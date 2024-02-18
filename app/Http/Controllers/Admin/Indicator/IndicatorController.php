<?php

namespace App\Http\Controllers\Admin\Indicator;
use App\Http\Controllers\Controller;

use App\Models\Indicator;
use Illuminate\Http\Request;

/**
 * Class IndicatorController
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
        $indicators = Indicator::get();

        return view('admin.indicators.indicator.index', compact('indicators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indicator = new Indicator();
        return view('admin.indicators.indicator.create', compact('indicator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $indicator = Indicator::create($request->all());
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
        $indicator = Indicator::find($id);

        return view('admin.indicators.indicator.show', compact('indicator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $indicator = Indicator::find($id);

        return view('admin.indicators.indicator.edit', compact('indicator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Indicator $indicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indicator $indicator)
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
        $indicator = Indicator::find($id)->delete();

        return redirect()->route('indicators.index')
            ->with('success', 'Indicator deleted successfully');
    }
}
