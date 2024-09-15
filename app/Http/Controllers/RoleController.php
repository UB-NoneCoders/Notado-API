<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Cria um novo Role
    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $role = Role::createRole($validated);
        return response()->json($role, 201);
    }

    // Atualiza um Role existente
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
        ]);

        $role->updateRole($validated);
        return response()->json($role);
    }

    // Retorna todos os usuários associados a um Role
    public function getUsers(Role $role)
    {
        $users = $role->users;
        return response()->json($users);
    }
}
