<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\Workspace;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class TaskRepository implements TaskRepositoryInterface
{

    public function getAllByWorkspace($workspaceId)
    {
        $workspace = Workspace::with('tasks.board')->findOrFail($workspaceId);

        return $workspace->tasks;
    }
    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $task = Task::findOrFail($id);

        $task->update($data);

        return $task;
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);

        return $task->delete();
    }
}
