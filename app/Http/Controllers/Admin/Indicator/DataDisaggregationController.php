<?php

namespace App\Http\Controllers\Admin\Indicator;
use App\Http\Controllers\Controller;

use App\Models\Project\ProjectDisaggregationField;
use App\Models\Indicator\{IndicatorDataDisaggregation,IndicatorDataCollection,IndicatorDataDisaggregationField};
use Illuminate\Http\Request;

/**
 * Class IndicatorDataDisaggregationController
 * @package App\Http\Controllers
 */
class DataDisaggregationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:indicatorDataDisaggregation-create',['only' => ['store']]);
        $this->middleware('permission:indicatorDataDisaggregation-edit',  ['only' => ['update']]);
        $this->middleware('permission:indicatorDataDisaggregation-delete',['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataCollect = IndicatorDataCollection::find($request->collection_id)->first();
        $disaggregatedData = 0;
        $fieldsData = 0;
        foreach($dataCollect->dataDisaggregations as $disaggregation){
            $disaggregatedData += $disaggregation->dataDisaggregationFields()->sum('value');
        }
        foreach($request->fields as $id => $value){
            $fields[] = ['field_id' => $id, 'value'=> $value];
            $fieldsData += $value;
        }
        if (($disaggregatedData+$fieldsData) > $dataCollect->collected_value){
            return redirect()->back()->with('warning','You can not disaggregate data greater then collected!');
        }
        $disaggregation = IndicatorDataDisaggregation::create($request->all());
        $disaggregation->dataDisaggregationFields()->createMany($fields);
        return redirect()->back()->with('success', 'Data Disaggregation saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $indicatorDataDisaggregation = IndicatorDataDisaggregation::find($id);

        return view('admin.indicator-data-disaggregation.show', compact('indicatorDataDisaggregation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $indicatorDataDisaggregation = IndicatorDataDisaggregation::find($id);

        return view('admin.indicator-data-disaggregation.edit', compact('indicatorDataDisaggregation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  IndicatorDataDisaggregation $indicatorDataDisaggregation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $field = IndicatorDataDisaggregationField::find($request->id); 
        $field->update($request->all());

        return redirect()->back()->with('success', 'Data Disaggregation updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $disaggregation = IndicatorDataDisaggregation::find($id);
        $disaggregation->dataDisaggregationFields()->delete();
        $disaggregation->delete();

        return redirect()->back()->with('success', 'Data Disaggregation deleted successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFields($id)
    {
        $fields = ProjectDisaggregationField::whereDisaggregationId($id)->get();

        return view('admin.indicators.data-disaggregation.fields', compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkRecord(Request $request)
    {
        $record = IndicatorDataDisaggregation::whereCollectionId($request->collection_id)->whereDisaggregationId($request->disaggregation_id)->first();
        if ($record) { echo "false"; }else{ echo "true"; }
    }
}
