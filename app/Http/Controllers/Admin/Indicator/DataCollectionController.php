<?php

namespace App\Http\Controllers\Admin\Indicator;
use App\Http\Controllers\Controller;

use App\Models\Indicator;
use Illuminate\Http\Request;
use App\Models\Indicator\{IndicatorDataCollection,IndicatorDataDisaggregation};

/**
 * Class IndicatorDataCollectionController
 * @package App\Http\Controllers
 */
class DataCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:indicatorDataCollections-list',  ['only' => ['index']]);
        $this->middleware('permission:indicatorDataCollections-create',['only' => ['store']]);
        $this->middleware('permission:indicatorDataCollections-view',['only' => ['show']]);
        $this->middleware('permission:indicatorDataCollections-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:indicatorDataCollections-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $indicator = Indicator::find($id);

        return view('admin.indicators.data-collection.index', compact('indicator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        IndicatorDataCollection::create($request->all());
        return redirect()->back()->with('success', 'Data Collection added successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataCollect = IndicatorDataCollection::find($id);
        $indicator   = $dataCollect->indicator;
        $disaggregation = new IndicatorDataDisaggregation();

        return view('admin.indicators.data-collection.show', compact('dataCollect','indicator','disaggregation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  IndicatorDataCollection $indicatorDataCollection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = IndicatorDataCollection::find($request->id);
        $data->update($request->all());

        return redirect()->back()->with('success', 'Data Collection updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $dataCollect = IndicatorDataCollection::find($id);
        if ($dataCollect->dataDisaggregations()->count() > 0) {
            return redirect()->back()->with('warning', 'Opps! this record contain data.');    
        }
        $dataCollect->delete();

        return redirect()->back()->with('success', 'Data Collection deleted successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function checkLimit(Request $request)
    {
        $indicator = Indicator::find($request->indicator_id);
        $data = getIndicatorActualVsTarget($indicator);
        if (isset($request->id)) {
            $dataCollect= IndicatorDataCollection::find($request->id);
            $calculated = $data['calculated'] - $dataCollect->collected_value;
            $checkLimit = $data['target'] - $calculated;
        }else{
            $checkLimit = $data['target'] - $data['calculated'];
        }
        if($request->collected_value > $checkLimit){ echo "false"; }else{ echo "true";}
    }
}
