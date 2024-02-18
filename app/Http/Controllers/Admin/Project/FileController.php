<?php

namespace App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\Project\ProjectFile;
use Illuminate\Http\Request;

/**
 * Class ProjectFileController
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projectFile-list',  ['only' => ['index']]);
        $this->middleware('permission:projectFile-create',['only' => ['store']]);
        $this->middleware('permission:projectFile-edit',  ['only' => ['update']]);
        $this->middleware('permission:projectFile-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::find($id);

        return view('admin.projects.file.index', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->type == 'Upload') {
            foreach ($input['files'] as $key => $file)
            {
                $name = $file->getClientOriginalName();
                $file->move('upload/project/files', $name);
                $input['name'] = $input['fileNames'][$key];
                $input['path'] = 'upload/project/files/'.$name;
                ProjectFile::create($input);
            }
        }else{
            ProjectFile::create($request->all());
        }
        return redirect()->back()->with('success', 'Project File saved successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectFile $projectFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $file = ProjectFile::find($request->id);
        $file->update($request->all());

        return redirect()->back()->with('success', 'File updated successfully!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectFile = ProjectFile::find($id)->delete();

        return redirect()->back()->with('success', 'File deleted successfully!');
    }
}
