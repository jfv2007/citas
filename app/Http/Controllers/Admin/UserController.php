<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read_user')
        ;
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create_user');

        $roles =Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create_user');
         /* return $request->all();  */
        /* return redirect()->route('admin.users.index');  */
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'ficha' => 'required|string|max:8',
            'email' => 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:8|confirmed',
            /* 'dni' => 'required|string|max:30|unique:users', */
            'phone' => 'nullable|string|max:15',
            'address'=> 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user =User::create($data);

        $user->roles()->attach($data['role_id']);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario creado correctamente',
            'text' => 'El usuario ha sido creado exitosamente',
        ]);

        if($user->hasRole('Trabajador'))// checar si es trabajador
            {
                $plantilla =$user->plantilla()->create([]);
                return redirect()->route('admin.plantillas.edit', $plantilla);
        }

        if ($user->hasRole('Funcionario')) // checar si es trabajador
        {
            $funcionario = $user->funcionario()->create([]);
            return redirect()->route('admin.funcionarios.edit', $funcionario);
        }



        return redirect()->route('admin.users.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        Gate::authorize('read_user');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Gate::authorize('update_user');

        $roles =Role::all();

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        /* return $request->all(); */
        Gate::authorize('update_user');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            /* 'dni' => 'required|string|max:30|unique:users,dni,'.$user->id, */
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update($data);

        if($request->password){
            $user->password =bcrypt($request->password);
            $user->save();
        }

        $user->roles()->sync([$data['role_id']]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario Actualizado',
            'text' => 'El usuario ha sido Actualizado exitosamente',
        ]);

        return redirect()->route('admin.users.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete_user');
        
        $user->roles()->detach();
        $user->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario eliminado',
            'text' => 'El usuario ha sido eliminado exitosamente.',
        ]);

        return redirect()->route('admin.users.index');
    }
}
