<?php

namespace App\Http\Controllers\Admin\Indicator;
use App\Http\Controllers\Controller;

use App\Models\Indicator;
use App\Models\Indicator\IndicatorContribution;
use Illuminate\Http\Request;

/**
 * Class IndicatorContributionController
 * @package App\Http\Controllers
 */
class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:indicatorContributions-list',  ['only' => ['index']]);
        $this->middleware('permission:indicatorContributions-create',['only' => ['store']]);
        $this->middleware('permission:indicatorContributions-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $indicator = Indicator::find($id);

        return view('admin.indicators.contribution.index', compact('indicator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $indicatorContribution = IndicatorContribution::create($request->all());
        return redirect()->back()->with('success', 'Indicator added successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $contribution = IndicatorContribution::find($id)->delete();

        return redirect()->back()->with('success', 'Indicator removed successfully.');
    }

    /**
     * Check the specified resource in storage.
     */
    public function checkRecord(Request $request)
    {
        $check = IndicatorContribution::whereIndicatorId($request->indicator_id)->whereContributerId($request->contributer_id)->first();
        if($check) { echo "false"; }else{ echo "true";}
    }
}
