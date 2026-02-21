<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use App\Models\Puesto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read_funcionario');

        return view('admin.funcionarios.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcionario $funcionario)
    {
        Gate::authorize('update_funcionario');

        $puestos = Puesto::all();

        return view('admin.funcionarios.edit', compact('funcionario', 'puestos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        Gate::authorize('update_funcionario');

        $data = $request->validate([
            'puesto_id' =>'nullable|exists:puestos,id',
            'biography' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $funcionario->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Funcionario actualizado!',
            'text' => 'Los datos del Funcionario  se han actualizado correctamente',
        ]);

        return redirect()->route('admin.funcionarios.edit', $funcionario);
    }

    public function schedules(Funcionario $funcionario)
    {
        Gate::authorize('update_funcionario');
        
        return view('admin.funcionarios.schedules', compact('funcionario'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario)
    {
        //
    }
}
