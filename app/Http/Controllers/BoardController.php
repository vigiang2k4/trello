<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Repositories\Board\BoardRepositoryInterface;
use Illuminate\Http\Request;

class BoardController extends Controller
{

    protected $boardRepo;

    public function __construct(BoardRepositoryInterface $boardRepo)
    {
        $this->boardRepo = $boardRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'workspace_id' => 'required|exists:workspaces,id',
        ]);

        $this->boardRepo->create($request->only('name', 'workspace_id'));

        return redirect()->back()->with('success', 'Board created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Board $board)
    {
        $data = $request->only(['name']); // lấy input name

        $this->boardRepo->update($board->id, $data);

        return redirect()->back()->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {

        $this->boardRepo->delete($board->id);

        return redirect()->back()->with('success', 'Board deleted successfully');
    }
}
