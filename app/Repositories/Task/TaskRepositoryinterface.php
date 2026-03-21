<?php

namespace App\Repositories\Task;

interface TaskRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getAllByWorkspace($workspaceId);
}
