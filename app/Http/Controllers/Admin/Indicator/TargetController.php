<?php

namespace App\Http\Controllers\Admin\Indicator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indicator;
use App\Models\Indicator\{IndicatorReportingPeriod,IndicatorDisaggregationType};

class TargetController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $indicator = Indicator::find($id);
        $reportingPeriods = IndicatorReportingPeriod::whereIndicatorId($id)->get();
        $disaggregations = IndicatorDisaggregationType::whereIndicatorId($id)->get();

        return view('admin.indicators.target.index', compact('indicator','reportingPeriods','disaggregations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reportStore(Request $request)
    {
        $check = IndicatorReportingPeriod::whereIndicatorId($request->indicator)->whereReportingPeriodId($request->id)->first();
        if ($check) {
            return response()->json([
                'status'=>'warning', 'message' => 'Opps! already linked this reporting Period.'
            ]);
        }else{
            IndicatorReportingPeriod::create([
                'indicator_id'        => $request->indicator,
                'reporting_period_id' => $request->id
            ]);
            return response()->json([
                'status'=>'success', 'message' => 'Reporting Period linked successfully.'
            ]);  
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function disaggregationStore(Request $request)
    {
        $check = IndicatorDisaggregationType::whereIndicatorId($request->indicator)->whereProjectDisaggregationId($request->id)->first();
        if ($check) {
            return response()->json([
                'status'=>'warning', 'message' => 'Opps! already linked this Disaggregation.'
            ]);
        }else{
            IndicatorDisaggregationType::create([
                'indicator_id'              => $request->indicator,
                'project_disaggregation_id' => $request->id
            ]);
            return response()->json([
                'status'=>'success', 'message' => 'Disaggregation linked successfully.'
            ]);  
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function reportDestroy($id)
    {
        IndicatorReportingPeriod::find($id)->delete();

        return redirect()->back()->with('success', 'Reporting Period unlinked successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function disaggregationDestroy($id)
    {
        IndicatorDisaggregationType::find($id)->delete();

        return redirect()->back()->with('success', 'Disaggregation unlinked successfully.');
    }
}
