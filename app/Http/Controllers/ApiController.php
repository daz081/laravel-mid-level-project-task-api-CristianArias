<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Documentación de la API de Proyectos y Tareas",
 *     description="API para gestionar proyectos y tareas con filtros dinámicos, validaciones, auditoría y más.",
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Servidor local"
 * )
 */
class ApiController extends Controller
{
    // Proyectos

    /**
     * @OA\Get(
     *     path="/api/projects",
     *     summary="Listar proyectos con filtros dinámicos",
     *     tags={"Proyectos"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de proyectos encontrada"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No se encontraron proyectos"
     *       )
     *       )
     */
    public function getProjects(Request $request) {
        $mainQuery = Project::query();
        if ($request->filled('status')) {
            $mainQuery->where('status', $request->status);
        }
        if ($request->filled('name')) {
            $mainQuery->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('from') && $request->filled('to')) {
            $mainQuery->whereBetween('created_at', [$request->from, $request->to]);
        }
        $proyectos = $mainQuery->get();
        if ($proyectos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron proyectos'], 404);
        }
        return response()->json(['proyectos' => $proyectos], 200);
    }
    
    /**
     * @OA\Post(
     *     path="/api/projects",
     *     summary="Crear un nuevo proyecto",
     *     tags={"Proyectos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "status"},
     *             @OA\Property(property="name", type="string", example="Nuevo Proyecto"),
     *             @OA\Property(property="status", type="string", example="active")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Proyecto creado correctamente"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validación fallida"
     *     )
     * )
     */
    public function createProject(CreateProjectRequest $request){
        $validatedData = $request->validated();
        $project = Project::create($validatedData);
        return response()->json(['proyecto' => $project, 'message' => 'Proyecto creado'], 201);
    }
    public function updateProject($id, UpdateProjectRequest $request){
        $validatedData = $request->validated();
        $project = Project::find($id);
        $project->update($validatedData);
        if (!$project) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }
        return response()->json(['proyecto' => $project, 'message' => 'Proyecto actualizado'], 200);
    }
    public function getProjectDetails($id){
        $project = Project::find($id);
        return response()->json(['proyecto' => $project], 200);
    }
    public function deleteProject($id){
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['message' => 'Proyecto no encontrado'], 404);
        }
        $project->delete();
        return response()->json(['message' => 'Proyecto eliminado'], 200);
    }

    // Tareas
    public function getTasks(Request $request) {
        $mainQuery = Task::query();
        if ($request->filled('status')) {
            $mainQuery->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $mainQuery->where('priority', $request->priority);
        }
        if ($request->filled('due_date')) {
            $mainQuery->whereDate('due_date', $request->due_date);
        }
        if ($request->filled('project_id')) {
            $mainQuery->where('project_id', $request->project_id);
        }
        $tareas = $mainQuery->get();
        if ($tareas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron tareas'], 404);
        }
        return response()->json(['tareas' => $tareas], 200);
    }
    public function createTask(CreateTaskRequest $request){
        try {
            $validatedData = $request->validated();
            $task = Task::create($validatedData);
            return response()->json(['tarea' => $task, 'message' => 'Tarea creada'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al crear la tarea'], 500);
        }
    }
    public function getTaskDetails($id){
        $task = Task::find($id);
        return response()->json(['tarea' => $task], 200);
    }
    public function updateTask($id, UpdateTaskRequest $request){
        try {
            $validatedData = $request->validated();
            $task = Task::find($id);
            $task->update($validatedData);
            return response()->json(['tarea' => $task, 'message' => 'Tarea actualizada'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al actualizar la tarea'], 500);
        }
    }
    public function deleteTask($id){
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Tarea no encontrada'], 404);
        }
        $task->delete();
        return response()->json(['message' => 'Tarea eliminada'], 200);
    }
}
