<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workspace;
use App\Repositories\Workspace\WorkspaceRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    protected $workspaceRepo;

    public function __construct(WorkspaceRepositoryInterface $workspaceRepo)
    {
        $this->workspaceRepo = $workspaceRepo;
    }

    public function index()
    {
        $workspaces = $this->workspaceRepo->index();
        $allworkspaces = $this->workspaceRepo->getAll();
        return view('dashboard', compact('workspaces', 'allworkspaces'));
    }

    public function show(Workspace $workspace)
    {
        $allworkspaces = $this->workspaceRepo->getAll();
        $showworkspaces = $this->workspaceRepo->findById($workspace->id);
        return view('workspace.show', compact('showworkspaces', 'allworkspaces'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->workspaceRepo->create($data);

        return redirect()->back()->with('success', 'Workspace created successfully');
    }

    public function update(Request $request, Workspace $workspace)
    {
        if ($workspace->owner_id !== Auth::id()) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $updated = $this->workspaceRepo->update($workspace->id, $data);

        return response()->json([
            'message' => 'Workspace updated',
            'data' => $updated
        ]);
    }

    public function destroy(Workspace $workspace)
    {
        if ($workspace->owner_id !== Auth::id()) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        $this->workspaceRepo->delete($workspace->id);

        return response()->json([
            'message' => 'Workspace deleted'
        ]);
    }
}
