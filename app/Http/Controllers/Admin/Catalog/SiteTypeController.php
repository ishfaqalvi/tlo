<?php

namespace App\Http\Controllers\Admin\Catalog;
use App\Http\Controllers\Controller;

use App\Models\Catalog\SiteType;
use Illuminate\Http\Request;

/**
 * Class SiteTypeController
 * @package App\Http\Controllers
 */
class SiteTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:siteTypes-list',  ['only' => ['index']]);
        $this->middleware('permission:siteTypes-view',  ['only' => ['show']]);
        $this->middleware('permission:siteTypes-create',['only' => ['create','store']]);
        $this->middleware('permission:siteTypes-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:siteTypes-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteTypes = SiteType::get();

        return view('admin.catalog.site-type.index', compact('siteTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siteType = new SiteType();
        return view('admin.catalog.site-type.create', compact('siteType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siteType = SiteType::create($request->all());
        return redirect()->route('site-types.index')
            ->with('success', 'SiteType created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siteType = SiteType::find($id);

        return view('admin.catalog.site-type.show', compact('siteType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siteType = SiteType::find($id);

        return view('admin.catalog.site-type.edit', compact('siteType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SiteType $siteType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteType $siteType)
    {
        $siteType->update($request->all());

        return redirect()->route('site-types.index')
            ->with('success', 'SiteType updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $siteType = SiteType::find($id)->delete();

        return redirect()->route('site-types.index')
            ->with('success', 'SiteType deleted successfully');
    }
}
