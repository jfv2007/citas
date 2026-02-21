<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class VerifyRole implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if(auth()->user()->hasRole('Funcionario')) {
            $builder->whereHas('funcionario', function ($query) {
                $query->where('user_id', auth()->id());
            });
        }

        if (auth()->user()->hasRole('Trabajador')) {
            $builder->whereHas('plantilla', function ($query) {
                $query->where('user_id', auth()->id());
            });
        }
    }
}
