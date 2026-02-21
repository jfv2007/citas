<?php

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::get('/plantillas', function (Request $request) {
    return User::query()
        ->select('id', 'name', 'email')
        ->when(
            $request->search,
            fn($query) => $query
                ->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%")
        )
        ->when(
            $request->exists('selected'),
            /* fn($query) => $query->whereIn('id', $request->input('selected', [])), */
            fn($query) => $query->whereHas('plantilla', function ($query) use ($request) {
            $query->whereIn('id',$request->input('selected',[]));
            }),
            fn($query) => $query->limit(10)
        )
        ->whereHas('plantilla')
        ->with('plantilla')
        ->orderBy('name')
        ->get()
        ->map(function (User $user) {
            return [
                'id' => $user->plantilla->id,
                'name' => $user->name,
            ];
        });
})->name('api.plantillas.index');

Route::get('/appointments', function(Request $request){

     $appointments = Appointment::with(['plantilla.user', 'funcionario.user'])
        ->whereBetween('date', [$request->start, $request->end])
        ->get(); 

        /* $appointments = Appointment::whereBetween('date', [$request->start, $request->end])
        ->get(); */

     /* return $appointments; */

      return $appointments->map(function($appointment){
        return [
            'id' => $appointment->id,
            'title'=> $appointment->plantilla->user->name,
            'start'=> $appointment->start->toIso8601String(),
            'end' => $appointment->end->toIso8601String(),
            'color'=> $appointment->status->colorHex(),
            'extendedProps' => [
                'dateTime' => $appointment->start->format('d-m-Y H:i:s'),
                'plantilla' => $appointment->plantilla->user->name,
                'funcionario' => $appointment->funcionario->user->name,
                'status' => $appointment->status->label(),
                'color' => $appointment->status->color(),
                'url' => route('admin.appointments.consultation', $appointment->id),
            ]
        ];
    })->values();


})->name('api.appointments.index');
