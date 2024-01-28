<?php

namespace App\Http\Controllers\Admin\Catalog;
use App\Http\Controllers\Controller;

use App\Models\Catalog\Province;
use Illuminate\Http\Request;

/**
 * Class ProvinceController
 * @package App\Http\Controllers
 */
class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:provinces-list',  ['only' => ['index']]);
        $this->middleware('permission:provinces-view',  ['only' => ['show']]);
        $this->middleware('permission:provinces-create',['only' => ['create','store']]);
        $this->middleware('permission:provinces-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:provinces-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::get();

        return view('admin.catalog.province.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = new Province();
        return view('admin.catalog.province.create', compact('province'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $province = Province::create($request->all());
        return redirect()->route('provinces.index')
            ->with('success', 'Province created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $province = Province::find($id);

        return view('admin.catalog.province.show', compact('province'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $province = Province::find($id);

        return view('admin.catalog.province.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Province $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        $province->update($request->all());

        return redirect()->route('provinces.index')
            ->with('success', 'Province updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $province = Province::find($id)->delete();

        return redirect()->route('provinces.index')
            ->with('success', 'Province deleted successfully');
    }
}
