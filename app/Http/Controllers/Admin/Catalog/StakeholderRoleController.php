<?php

namespace App\Http\Controllers\Admin\Catalog;
use App\Http\Controllers\Controller;

use App\Models\Catalog\StakeholderRole;
use Illuminate\Http\Request;

/**
 * Class StakeholderRoleController
 * @package App\Http\Controllers
 */
class StakeholderRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:stakeholderRoles-list',  ['only' => ['index']]);
        $this->middleware('permission:stakeholderRoles-view',  ['only' => ['show']]);
        $this->middleware('permission:stakeholderRoles-create',['only' => ['create','store']]);
        $this->middleware('permission:stakeholderRoles-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:stakeholderRoles-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stakeholderRoles = StakeholderRole::get();

        return view('admin.catalog.stakeholder-role.index', compact('stakeholderRoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stakeholderRole = new StakeholderRole();
        return view('admin.catalog.stakeholder-role.create', compact('stakeholderRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stakeholderRole = StakeholderRole::create($request->all());
        return redirect()->route('stakeholder-roles.index')
            ->with('success', 'StakeholderRole created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stakeholderRole = StakeholderRole::find($id);

        return view('admin.catalog.stakeholder-role.show', compact('stakeholderRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stakeholderRole = StakeholderRole::find($id);

        return view('admin.catalog.stakeholder-role.edit', compact('stakeholderRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  StakeholderRole $stakeholderRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StakeholderRole $role)
    {
        $role->update($request->all());

        return redirect()->route('stakeholder-roles.index')
            ->with('success', 'StakeholderRole updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $stakeholderRole = StakeholderRole::find($id)->delete();

        return redirect()->route('stakeholder-roles.index')
            ->with('success', 'StakeholderRole deleted successfully');
    }
}
