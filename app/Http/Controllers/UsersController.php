<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(Request $request)
    {
         $searchableColumns = ['name', 'email'];

        $usersQuery = User::query();

        // Apply search
        $usersQuery->search($request, $searchableColumns);

        // Apply month filter
        if ($request->filled('month')) {
            $usersQuery->filterByMonth($request->month);
        }

        // Apply sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $usersQuery->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $usersQuery->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $usersQuery->orderBy('name', 'desc');
                break;
            case 'newest':
            default:
                $usersQuery->orderBy('created_at', 'desc');
                break;
        }

        $users = $usersQuery->paginate(12)->onEachSide(2)->withQueryString();

        return view('page.tambahdata.user.index', compact('users'));
    }

    public function create()
    {
        return view('page.tambahdata.user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dibuat!');
    }

    public function show(User $user)
    {
        return view('page.tambahdata.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('page.tambahdata.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
