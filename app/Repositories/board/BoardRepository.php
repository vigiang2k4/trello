<?php

namespace App\Repositories\Board;

use App\Models\Board;
use App\Models\Workspace;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class BoardRepository implements BoardRepositoryInterface
{
    public function create(array $data)
    {
        if (empty($data['name']) || empty($data['workspace_id'])) {
            throw new InvalidArgumentException('workspace_id và name là bắt buộc.');
        }
        $boardData = Arr::only($data, ['name', 'workspace_id']);
        $boardData['creator_id'] = Auth::id();

        return Board::create($boardData);
    }

    public function update($id, array $data)
    {
        $board = Board::where('owner_id', Auth::id())
            ->findOrFail($id);

        $board->update($data);

        return $board;
    }

    public function delete($id)
    {
        Board::findOrFail($id)->delete();

        return Board::destroy($id);
    }
}
