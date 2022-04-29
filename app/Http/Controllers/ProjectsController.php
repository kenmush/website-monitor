<?php

namespace App\Http\Controllers;

use App\Events\ProjectCreatedEvent;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return ProjectResource::collection(auth()->user()->projects);
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Project $project)
    {
        $this->validate($request, [
                'name' => 'required|max:255',
                'url'  => 'required|active_url|unique:projects,url',
        ]);

        $project->name = $request->name;
        $project->url = $request->url;
        $project->user_id = auth()->id();
        $project->save();

        ProjectCreatedEvent::dispatch($project);
        return response()->json($project,201);
    }

    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }
}