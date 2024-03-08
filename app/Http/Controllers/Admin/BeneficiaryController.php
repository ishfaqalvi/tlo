<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BenificiaryImport;

/**
 * Class BeneficiaryController
 * @package App\Http\Controllers
 */
class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:beneficiaries-list',  ['only' => ['index']]);
        $this->middleware('permission:beneficiaries-view',  ['only' => ['show']]);
        $this->middleware('permission:beneficiaries-create',['only' => ['create','store']]);
        $this->middleware('permission:beneficiaries-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:beneficiaries-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beneficiaries = Beneficiary::get();

        return view('admin.beneficiary.index', compact('beneficiaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beneficiary = new Beneficiary();
        return view('admin.beneficiary.create', compact('beneficiary'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $beneficiary = Beneficiary::create($request->all());
        return redirect()->route('beneficiaries.index')
            ->with('success', 'Beneficiary created successfully.');
    }

    /**
     * Show the form for importing a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'file'       => 'required|mimes:csv,xlsx,xls'
        ]);
        $input = $request->all();
        $file = $request->file('file')->store('import');
        $import = new BenificiaryImport($input);
        $import->import($file);
        return redirect()->back()->with('success', 'Beneficiary imported successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beneficiary = Beneficiary::find($id);

        return view('admin.beneficiary.show', compact('beneficiary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beneficiary = Beneficiary::find($id);

        return view('admin.beneficiary.edit', compact('beneficiary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Beneficiary $beneficiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beneficiary $beneficiary)
    {
        $beneficiary->update($request->all());

        return redirect()->route('beneficiaries.index')
            ->with('success', 'Beneficiary updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $beneficiary = Beneficiary::find($id)->delete();

        return redirect()->route('beneficiaries.index')
            ->with('success', 'Beneficiary deleted successfully.');
    }
}
