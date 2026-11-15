<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile')->paginate(5);

        return view('user.index', [
            'users' => $users,
            'title' => 'Lista de usuários do Sistema',
        ]);
    }

    public function show(int $id)
    {
        $user = User::findOrFail($id);

        return view('user.show', [
            'user' => $user,
        ]);
    }

    public function register()
    {
        return view('user.create');
    }

    public function create(Request $request)
    {
        $input = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($input) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
            ]);

            $user->profile()->create([
                'type' => 'comum',
                'description' => 'Usuário comum do sistema',
            ]);
        });

        return redirect()
            ->route('login')
            ->with('success', 'Cadastro realizado com sucesso! Faça seu login.');
    }

    public function adminCreate()
    {
        return view('user.create', [
            'administrativo' => true,
        ]);
    }

    public function adminStore(Request $request)
    {
        $input = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($input) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
            ]);

            $user->profile()->create([
                'type' => 'comum',
                'description' => 'Usuário comum do sistema',
            ]);
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }
}
