<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Project;
use Illuminate\Http\Request;

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
    public function index($id)
    {
        $project = Project::find($id);

        return view('admin.projects.beneficiary.index', compact('project'));
    }
}
