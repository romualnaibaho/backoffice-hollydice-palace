<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class BackofficeController extends Controller
{
    public function index()
    {
        $allUser = User::countUsers();
        $deletedUserCount = User::onlyTrashed()->count();
        $activeUserCount = User::whereNull('deleted_at')->count();

        return view('pages.backoffice.dashboard', compact(
            'allUser',
            'deletedUserCount',
            'activeUserCount'
        ));
    }

    public function roles()
    {
        $roles = Role::whereNull('deleted_at')->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.backoffice.roles', compact('roles'));
    }

    public function permissions()
    {
        $permissions = Permission::paginate(10);

        return view('pages.backoffice.permissions', compact('permissions'));
    }

    public function users()
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->whereNull('users.deleted_at')
            ->select('users.*', 'roles.name as role_name')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $role_options = Role::all();

        return view('pages.backoffice.users', compact('users', 'role_options'));
    }

    public function deletedUsers()
    {
        $users = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->onlyTrashed()->select('users.*', 'roles.name as role_name')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        $role_options = Role::all();
        $deletedPage = true;

        return view('pages.backoffice.users', compact('users', 'role_options', 'deletedPage'));
    }

    public function createUser(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->roleId
        ]);

        return redirect()->route('users');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $role_options = Role::all();

        return view('pages.backoffice.edit-user', compact('user', 'role_options'));
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4'
        ]);

        User::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'role_id' => $request->roleId
            ]);

        return redirect()->route('users');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();

        return redirect()->route('users');
    }

    public function createRole(Request $request)
    {
        Role::create([
            'name' => $request->name
        ]);

        return redirect()->route('roles');
    }

    public function editRole($id)
    {
        $role = Role::find($id);

        return view('pages.backoffice.edit-role', compact('role'));
    }

    public function updateRole(Request $request)
    {
        Role::where('id', $request->id)
            ->update([
                'name' => $request->name
            ]);

        return redirect()->route('roles');
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);

        $role->permission()->detach();

        $role->delete();

        return redirect()->route('roles');
    }

    public function managePermission($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();

        return view('pages.backoffice.manage-permission', compact('role', 'permissions'));
    }

    public function storeManagedPermission(Request $request)
    {
        // Validate the request, ensuring the selectedPermission field is an array
        $request->validate([
            'selectedPermission' => 'array',
        ]);

        $role = Role::find($request->roleId);

        // Sync the selected permissions for the role
        $role->permission()->sync($request->input('selectedPermission'));

        return redirect()->route('roles');
    }
}
