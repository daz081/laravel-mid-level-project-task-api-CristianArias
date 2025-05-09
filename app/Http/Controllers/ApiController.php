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
    public function getProjects(){
        return Project::all();
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
    public function getTasks(){
        return Task::all();
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
