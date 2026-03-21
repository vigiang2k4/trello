<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\Task\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    protected $taskRepo;

    public function __construct(TaskRepository $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($workspaceId)
    {
        $tasks = $this->taskRepo->getAllByWorkspace($workspaceId);

        return view('workspace.show', compact('tasks', 'workspaceId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->taskRepo->create([
            'board_id' => $request->board_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->back()->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->taskRepo->update($id, [
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->back()->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->taskRepo->delete($id);

        return redirect()->back()->with('success', 'Task deleted successfully');
    }
}
