<?php

namespace App\Repositories\Account;

use App\Models\User;
use App\Repositories\Account\AccountRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountRepository implements AccountRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        // 2. Tạo workspace
        $workspace = $user->ownedWorkspaces()->create([
            'name' => $user->name . "My Workspace",
        ]);

        // 3. Tạo 3 board mặc định
        $today = Carbon::today();
        
        $workspace->boards()->createMany([
            ['name' => 'Đang làm'],
            ['name' => 'Đã làm'],
            ['name' => 'Sắp tới'],
        ]);

        // 4. Login
        Auth::login($user);

        return $user;
    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        return User::destroy($id);
    }
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }

    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return [
                'success' => true,
                'user' => $user,
            ];
        }
        return [
            'success' => false,
            'message' => 'Sai tài khoản hoặc mật khẩu',
        ];
    }
}
