<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Feadback;
use Illuminate\Http\Request;

/**
 * Class FeadbackController
 * @package App\Http\Controllers
 */
class FeadbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:feadbacks-list',  ['only' => ['index']]);
        $this->middleware('permission:feadbacks-view',  ['only' => ['show']]);
        $this->middleware('permission:feadbacks-create',['only' => ['create','store']]);
        $this->middleware('permission:feadbacks-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:feadbacks-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feadbacks = Feadback::get();

        return view('admin.feadback.index', compact('feadbacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $feadback = new Feadback();
        return view('admin.feadback.create', compact('feadback'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feadback = Feadback::create($request->all());
        return redirect()->route('feadbacks.index')
            ->with('success', 'Feadback created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feadback = Feadback::find($id);

        return view('admin.feadback.show', compact('feadback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feadback = Feadback::find($id);

        return view('admin.feadback.edit', compact('feadback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Feadback $feadback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feadback $feadback)
    {
        $feadback->update($request->all());

        return redirect()->route('feadbacks.index')
            ->with('success', 'Feadback updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $feadback = Feadback::find($id)->delete();

        return redirect()->route('feadbacks.index')
            ->with('success', 'Feadback deleted successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function responceStore(Request $request)
    {
        $feadback = Feadback::find($request->feadback_id);
        if($request->status == 'Assign'){
            $status = 'Assign';
        }elseif($request->status == 'Responce Share'){
            $status = 'Processing';
        }elseif($request->status == 'Complainer Agree'){
            $status = 'Closed';
        }elseif($request->status == 'Complainer DisAgree'){
            $status = 'Reprocessing';
        }
        $feadback->update(['status' => $status]);
        $feadback->responces()->create($request->all());
        return redirect()->back()->with('success', 'Feadback Responce added successfully.');
    }
}
