<?php

namespace App\Http\Controllers\Role;

use App\Models\Role\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    private $form_view = "pages.roles.form";
    private $list_view = "pages.roles.list";

    public function index()
    {
        $roles = Role::all();
        return view($this->list_view, compact('roles'));
    }

    public function create()
    {
        return view($this->form_view);
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:100',
        ]);

        Role::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view($this->form_view, compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'label' => 'required|string|max:100',
        ]);

        $role->update($request->all());
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}