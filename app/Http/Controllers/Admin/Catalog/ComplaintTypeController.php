<?php

namespace App\Http\Controllers\Admin\Catalog;
use App\Http\Controllers\Controller;

use App\Models\Catalog\ComplaintType;
use Illuminate\Http\Request;

/**
 * Class ComplaintTypeController
 * @package App\Http\Controllers
 */
class ComplaintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:complaintTypes-list',  ['only' => ['index']]);
        $this->middleware('permission:complaintTypes-view',  ['only' => ['show']]);
        $this->middleware('permission:complaintTypes-create',['only' => ['create','store']]);
        $this->middleware('permission:complaintTypes-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:complaintTypes-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaintTypes = ComplaintType::get();

        return view('admin.catalog.complaint-type.index', compact('complaintTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $complaintType = new ComplaintType();
        return view('admin.catalog.complaint-type.create', compact('complaintType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $complaintType = ComplaintType::create($request->all());
        return redirect()->route('complaint-types.index')
            ->with('success', 'ComplaintType created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complaintType = ComplaintType::find($id);

        return view('admin.catalog.complaint-type.show', compact('complaintType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complaintType = ComplaintType::find($id);

        return view('admin.catalog.complaint-type.edit', compact('complaintType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ComplaintType $complaintType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintType $complaintType)
    {
        $complaintType->update($request->all());

        return redirect()->route('complaint-types.index')
            ->with('success', 'ComplaintType updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $complaintType = ComplaintType::find($id)->delete();

        return redirect()->route('complaint-types.index')
            ->with('success', 'ComplaintType deleted successfully');
    }
}
