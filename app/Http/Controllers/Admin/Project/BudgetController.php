<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Project;
use Illuminate\Http\Request;

/**
 * Class ActivityBudgetController
 * @package App\Http\Controllers
 */
class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::with('activities.budgets')->find($id);

        $total = $project->activities->flatMap(function ($activity) {
            return $activity->budgets;
        })->sum('budget_amount');

        $spent = $project->activities->flatMap(function ($activity) {
            return $activity->budgets;
        })->sum('actual_spent');

        $remaining = $total - $spent;

        $data = [
            'total'     => $total,
            'spent'     => $spent,
            'remaining' => $remaining,
        ];
        return view('admin.projects.budget.index', compact('project','data'));
    }
}