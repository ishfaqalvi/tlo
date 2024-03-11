<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\FeadbackResponce;
use Illuminate\Http\Request;

/**
 * Class FeadbackResponceController
 * @package App\Http\Controllers
 */
class FeadbackResponceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:feadbackResponces-list',  ['only' => ['index']]);
        $this->middleware('permission:feadbackResponces-view',  ['only' => ['show']]);
        $this->middleware('permission:feadbackResponces-create',['only' => ['create','store']]);
        $this->middleware('permission:feadbackResponces-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:feadbackResponces-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feadbackResponces = FeadbackResponce::get();

        return view('admin.feadback-responce.index', compact('feadbackResponces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $feadbackResponce = new FeadbackResponce();
        return view('admin.feadback-responce.create', compact('feadbackResponce'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feadbackResponce = FeadbackResponce::create($request->all());
        return redirect()->route('feadback-responces.index')
            ->with('success', 'FeadbackResponce created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feadbackResponce = FeadbackResponce::find($id);

        return view('admin.feadback-responce.show', compact('feadbackResponce'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feadbackResponce = FeadbackResponce::find($id);

        return view('admin.feadback-responce.edit', compact('feadbackResponce'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  FeadbackResponce $feadbackResponce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeadbackResponce $feadbackResponce)
    {
        $feadbackResponce->update($request->all());

        return redirect()->route('feadback-responces.index')
            ->with('success', 'FeadbackResponce updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $feadbackResponce = FeadbackResponce::find($id)->delete();

        return redirect()->route('feadback-responces.index')
            ->with('success', 'FeadbackResponce deleted successfully');
    }
}
