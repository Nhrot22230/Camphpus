<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios\Usuario;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{

    public function index()
    {
        $this->authorize('ver usuarios');
        $usuarios = Usuario::all();
        Log::channel('usuarios')->info('Listando usuarios', ['user_id' => Auth::id()]);
        return response()->json($usuarios);
    }

    public function store(Request $request)
    {
        $this->authorize('crear usuarios');
        $data = $request->validate([
            'dni' => 'required|unique:usuario,dni',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuario,correo',
            'password' => 'required|string|min:8',
            'estado' => 'boolean',
        ]);

        $usuario = Usuario::create($data);
        Log::channel('usuarios')->info('Usuario creado', ['user_id' => Auth::id(), 'created_user' => $usuario->idUsuario]);
        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        $this->authorize('ver usuarios');
        $usuario = Usuario::findOrFail($id);
        Log::channel('usuarios')->info('Mostrando usuario', ['user_id' => Auth::id(), 'viewed_user' => $id]);
        return response()->json($usuario);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('editar usuarios');
        $usuario = Usuario::findOrFail($id);

        $data = $request->validate([
            'dni' => 'required|unique:usuario,dni,'.$id.',idUsuario',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuario,correo,'.$id.',idUsuario',
            'password' => 'nullable|string|min:8',
            'estado' => 'boolean',
        ]);
        $usuario->update($data);
        Log::channel('usuarios')->info('Usuario actualizado', ['user_id' => Auth::id(), 'updated_user' => $usuario->idUsuario]);
        return response()->json($usuario);
    }

    public function destroy($id)
    {
        $this->authorize('eliminar usuarios');
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        Log::channel('usuarios')->info('Usuario eliminado', ['user_id' => Auth::id(), 'deleted_user' => $id]);
        return response()->json(null, 204);
    }

    public function indexPermissions()
    {
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    public function indexRoles()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function createRole(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);
        $role = Role::create(['name' => $data['name']]);
        Log::channel('usuarios')->info('Rol creado', ['user_id' => Auth::id(), 'role' => $role->id]);
        return response()->json($role, 201);
    }

    public function assignRole(Request $request, $userId)
    {
        $this->authorize('editar usuarios');

        $data = $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);
        $usuario = Usuario::findOrFail($userId);
        $usuario->assignRole($data['role']);
        Log::channel('usuarios')->info('Rol asignado a usuario', ['user_id' => Auth::id(), 'assigned_user' => $userId, 'role' => $data['role']]);
        return response()->json(['message' => 'Rol asignado con éxito.']);
    }

    public function assignPermission(Request $request, $userId)
    {
        $this->authorize('editar usuarios');

        $data = $request->validate([
            'permission' => 'required|string|exists:permissions,name',
        ]);
        $usuario = Usuario::findOrFail($userId);
        $permission = Permission::findByName($data['permission']);
        $usuario->givePermissionTo($permission);
        Log::channel('usuarios')->info('Permiso asignado a usuario', ['user_id' => Auth::id(), 'assigned_user' => $userId, 'permission' => $data['permission']]);
        return response()->json(['message' => 'Permiso asignado con éxito.']);
    }
}
