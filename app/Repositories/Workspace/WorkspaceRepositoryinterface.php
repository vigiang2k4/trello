<?php

namespace App\Repositories\Workspace;

interface WorkspaceRepositoryInterface
{
    public function index();
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
