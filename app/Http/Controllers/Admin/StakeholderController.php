<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Stakeholder;
use Illuminate\Http\Request;

/**
 * Class StakeholderController
 * @package App\Http\Controllers
 */
class StakeholderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:stakeholders-list',  ['only' => ['index']]);
        $this->middleware('permission:stakeholders-view',  ['only' => ['show']]);
        $this->middleware('permission:stakeholders-create',['only' => ['create','store']]);
        $this->middleware('permission:stakeholders-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:stakeholders-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stakeholders = Stakeholder::get();

        return view('admin.stakeholder.index', compact('stakeholders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stakeholder = new Stakeholder();
        return view('admin.stakeholder.create', compact('stakeholder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stakeholder = Stakeholder::create($request->all());
        return redirect()->route('stakeholders.index')
            ->with('success', 'Stakeholder created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stakeholder = Stakeholder::find($id);

        return view('admin.stakeholder.show', compact('stakeholder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stakeholder = Stakeholder::find($id);

        return view('admin.stakeholder.edit', compact('stakeholder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Stakeholder $stakeholder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stakeholder $stakeholder)
    {
        $stakeholder->update($request->all());

        return redirect()->route('stakeholders.index')
            ->with('success', 'Stakeholder updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $stakeholder = Stakeholder::find($id)->delete();

        return redirect()->route('stakeholders.index')
            ->with('success', 'Stakeholder deleted successfully');
    }
}
