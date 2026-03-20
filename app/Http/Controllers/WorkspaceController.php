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
            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa workspace này');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->workspaceRepo->update($workspace->id, $data);

        return redirect()->back()->with('success', 'Cập nhật workspace thành công');
    }

    public function destroy(Workspace $workspace)
    {
        if ($workspace->owner_id === Auth::id()) {
            $this->workspaceRepo->delete($workspace->id);

            return redirect()->back()->with('success', 'Workspace deleted successfully');
        }

        return redirect()->back()->with('error', 'Bạn không có quyền xóa workspace này');
    }
}
