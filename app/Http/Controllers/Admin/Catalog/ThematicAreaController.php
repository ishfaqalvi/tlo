<?php

namespace App\Http\Controllers\Admin\Catalog;
use App\Http\Controllers\Controller;

use App\Models\Catalog\ThematicArea;
use Illuminate\Http\Request;

/**
 * Class ThematicAreaController
 * @package App\Http\Controllers
 */
class ThematicAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:thematicArea-list',  ['only' => ['index']]);
        $this->middleware('permission:thematicArea-view',  ['only' => ['show']]);
        $this->middleware('permission:thematicArea-create',['only' => ['create','store']]);
        $this->middleware('permission:thematicArea-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:thematicArea-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thematicAreas = ThematicArea::get();

        return view('admin.catalog.thematic-area.index', compact('thematicAreas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thematicArea = new ThematicArea();
        return view('admin.catalog.thematic-area.create', compact('thematicArea'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thematicArea = ThematicArea::create($request->all());
        return redirect()->route('thematic-areas.index')
            ->with('success', 'ThematicArea created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thematicArea = ThematicArea::find($id);

        return view('admin.catalog.thematic-area.show', compact('thematicArea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thematicArea = ThematicArea::find($id);

        return view('admin.catalog.thematic-area.edit', compact('thematicArea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ThematicArea $thematicArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThematicArea $thematicArea)
    {
        $thematicArea->update($request->all());

        return redirect()->route('thematic-areas.index')
            ->with('success', 'ThematicArea updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $thematicArea = ThematicArea::find($id)->delete();

        return redirect()->route('thematic-areas.index')
            ->with('success', 'ThematicArea deleted successfully');
    }
}
