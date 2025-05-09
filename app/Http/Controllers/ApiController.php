<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Proyectos
    public function getProjects(Request $request){
        $mainQuery = Project::query();
        if ($request->filled('status')) {
            $mainQuery->where('status', $request->status);
        }
        if ($request->filled('name')) {
            $mainQuery->where('name', 'like', '%'.$request->name.'%');
        }
        if ($request->filled('from') && $request->filled('to')) {
            $mainQuery->whereBetween('created_at', [$request->from, $request->to]);
        }
        $proyectos = $mainQuery->get();
        return response()->json($proyectos);
    }
    public function createProject(CreateProjectRequest $request){
        $validatedData = $request->validated();

        $project = Project::create($validatedData);
        return $project;
    }
    public function getProjectDetails($id){
        return Project::find($id);
    }
    public function updateProject($id, UpdateProjectRequest $request){
        $validatedData = $request->validated();
        $project = Project::find($id);
        $project->update($validatedData);
        return $project;
    }
    public function deleteProject($id){
        return Project::destroy($id);
    }

    // Tareas
    public function getTasks(Request $request){
        $mainQuery = Task::query();
        if ($request->filled('status')) {
            $mainQuery->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $mainQuery->where('priority', $request->priority);
        }
        if ($request->filled('due_date')) {
            $mainQuery->where('due_date', $request->due_date);
        }
        if ($request->filled('project_id')) {
            $mainQuery->where('project_id', $request->project_id);
        }
        $tareas = $mainQuery->get();
        return response()->json($tareas);
    }
    public function createTask(CreateTaskRequest $request){
        $validatedData = $request->validated();
        $project = Task::create($validatedData);
        return $project;
    }
    public function getTaskDetails($id){
        return Task::find($id);
    }
    public function updateTask($id, UpdateTaskRequest $request){
        $validatedData = $request->validated();
        $task = Task::find($id);
        $task->update($validatedData);
        return $task;
    }
    public function deleteTask($id){
        return Task::destroy($id);
    }
}
