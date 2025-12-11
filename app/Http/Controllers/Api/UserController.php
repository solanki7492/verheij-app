<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ApiResponse;
use App\Http\Resources\UserResource;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('admin.users.index');
    }

    public function list()
    {
        if (request()->ajax()) {
            $query = User::query()->orderByDesc('created_at');

            return DataTables::eloquent($query)
                ->setTransformer(function ($item) {
                    return UserResource::make($item)->resolve();
                })
                ->toJson();
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:' . User::ROLE_ADMIN . ',' . User::ROLE_API_USER,
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        return $this->success(['user' => $user]);
    }
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:' . User::ROLE_ADMIN . ',' . User::ROLE_API_USER,
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => isset($data['password']) && !empty($data['password']) ? Hash::make($data['password']) : $user->password,
            'role' => $data['role'],
        ]);

        return $this->success(['user' => $user]);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return $this->success();
    }
}