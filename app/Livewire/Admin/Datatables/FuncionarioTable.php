<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Builder;

class FuncionarioTable extends DataTableComponent
{
    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return Funcionario::query()
            ->whereHas('user', function (Builder $query) {
                $query->role('funcionario');
            })
            ->with('user');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Ficha", "user.ficha")
                ->sortable(),
            Column::make("Nombre", "user.name")
                ->sortable(),
            Column::make("Direccion", "user.address")
                ->sortable(),
            Column::make("phone", "user.phone")
                ->sortable(),
            Column::make("Puesto", "puesto.name")
                ->format(function ($value){
                    return $value ? : 'N/A';
                })
                ->sortable(),
            Column::make("Acciones")
                ->label(function ($row) {
                    return view('admin.funcionarios.actions', [
                        'funcionario' => $row
                    ]);
                }),
        ];
    }
}
