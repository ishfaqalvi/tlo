<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\RiskPlan;
use Illuminate\Http\Request;

/**
 * Class RiskPlanController
 * @package App\Http\Controllers
 */
class RiskPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:riskPlans-list',  ['only' => ['index']]);
        $this->middleware('permission:riskPlans-view',  ['only' => ['show']]);
        $this->middleware('permission:riskPlans-create',['only' => ['create','store']]);
        $this->middleware('permission:riskPlans-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:riskPlans-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $riskPlans = RiskPlan::filter($request->all())->get();
        $request->method() == 'POST' ? $userRequest = $request : $userRequest = null;

        return view('admin.risk-plan.index', compact('riskPlans','userRequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $riskPlan = new RiskPlan();
        return view('admin.risk-plan.create', compact('riskPlan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $riskPlan = RiskPlan::create($request->all());
        return redirect()->route('risk-plans.index')
            ->with('success', 'RiskPlan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $riskPlan = RiskPlan::find($id);

        return view('admin.risk-plan.show', compact('riskPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $riskPlan = RiskPlan::find($id);

        return view('admin.risk-plan.edit', compact('riskPlan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RiskPlan $riskPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiskPlan $riskPlan)
    {
        $riskPlan->update($request->all());

        return redirect()->route('risk-plans.index')
            ->with('success', 'RiskPlan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $riskPlan = RiskPlan::find($id)->delete();

        return redirect()->route('risk-plans.index')
            ->with('success', 'RiskPlan deleted successfully');
    }
}
