<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\IndicatorDataDisaggregationField;
use Illuminate\Http\Request;

/**
 * Class IndicatorDataDisaggregationFieldController
 * @package App\Http\Controllers
 */
class IndicatorDataDisaggregationFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:indicatorDataDisaggregationFields-list',  ['only' => ['index']]);
        $this->middleware('permission:indicatorDataDisaggregationFields-view',  ['only' => ['show']]);
        $this->middleware('permission:indicatorDataDisaggregationFields-create',['only' => ['create','store']]);
        $this->middleware('permission:indicatorDataDisaggregationFields-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:indicatorDataDisaggregationFields-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicatorDataDisaggregationFields = IndicatorDataDisaggregationField::get();

        return view('admin.indicator-data-disaggregation-field.index', compact('indicatorDataDisaggregationFields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indicatorDataDisaggregationField = new IndicatorDataDisaggregationField();
        return view('admin.indicator-data-disaggregation-field.create', compact('indicatorDataDisaggregationField'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $indicatorDataDisaggregationField = IndicatorDataDisaggregationField::create($request->all());
        return redirect()->route('indicator-data-disaggregation-fields.index')
            ->with('success', 'IndicatorDataDisaggregationField created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $indicatorDataDisaggregationField = IndicatorDataDisaggregationField::find($id);

        return view('admin.indicator-data-disaggregation-field.show', compact('indicatorDataDisaggregationField'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $indicatorDataDisaggregationField = IndicatorDataDisaggregationField::find($id);

        return view('admin.indicator-data-disaggregation-field.edit', compact('indicatorDataDisaggregationField'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  IndicatorDataDisaggregationField $indicatorDataDisaggregationField
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndicatorDataDisaggregationField $indicatorDataDisaggregationField)
    {
        $indicatorDataDisaggregationField->update($request->all());

        return redirect()->route('indicator-data-disaggregation-fields.index')
            ->with('success', 'IndicatorDataDisaggregationField updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $indicatorDataDisaggregationField = IndicatorDataDisaggregationField::find($id)->delete();

        return redirect()->route('indicator-data-disaggregation-fields.index')
            ->with('success', 'IndicatorDataDisaggregationField deleted successfully');
    }
}
