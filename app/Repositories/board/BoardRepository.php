<?php

namespace App\Repositories\Workspace;

use App\Models\Workspace;
use Illuminate\Support\Facades\Auth;

class WorkspaceRepository implements WorkspaceRepositoryInterface
{

    public function index()
    {
        return Workspace::with('boards')
            ->where('owner_id', Auth::id())
            ->latest()       
            ->first();       
    }
    public function getAll()
    {
        return Workspace::with('boards')
            ->where('owner_id', Auth::id()) 
            ->get();
    }

    public function findById($id)
    {
        return Workspace::with('boards')
             ->where('owner_id', Auth::id())
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['owner_id'] = Auth::id();

        return Workspace::create($data);
    }

    public function update($id, array $data)
    {
        $workspace = Workspace::where('owner_id', Auth::id())
            ->findOrFail($id);

        $workspace->update($data);

        return $workspace;
    }

    public function delete($id)
    {
        $workspace = Workspace::where('owner_id', Auth::id())
            ->findOrFail($id);

        return $workspace->delete();
    }
}
