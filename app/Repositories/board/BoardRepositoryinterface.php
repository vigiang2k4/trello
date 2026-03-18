<?php

namespace App\Repositories\Board;

interface BoardRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
