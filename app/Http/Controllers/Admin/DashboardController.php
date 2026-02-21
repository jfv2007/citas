<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        Gate::authorize('access_dashboard');

        $data=[];
        if(auth()->user()->hasRole(['Admin', 'Recepcionista'])){

            $data['total_plantillas'] = \App\Models\Plantilla::count();
            $data['total_funcionarios'] = \App\Models\Funcionario::count();
            $data['appointments_today'] = \App\Models\Appointment::whereDate('date', now()->toDateString())
                ->where('status', \App\Enums\AppointmentEnum::SCHEDULED)
                ->count();
            $data['recent_users'] = \App\Models\User::latest()
                ->take(5)
                ->get();
        }

        if(auth()->user()->hasRole('Funcionario')){
            $data['appointments_today_count'] = \App\Models\Appointment::whereDate('created_at', now())
                ->where('status', \App\Enums\AppointmentEnum::SCHEDULED)
                ->whereHas('funcionario', function($query){
                    $query->where('user_id', auth()->id());
                })
                ->count();
            $data['appointments_week_count'] = \App\Models\Appointment::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->where('status', \App\Enums\AppointmentEnum::SCHEDULED)
                ->whereHas('funcionario', function($query){
                    $query->where('user_id', auth()->id());
                })
                ->count();

            $data['next_appointment'] = \App\Models\Appointment::whereHas('funcionario', function ($query) {
                $query->where('user_id', auth()->id());
                })
                ->where('status', \App\Enums\AppointmentEnum::SCHEDULED)
                ->whereDate('date', '>=', now()->toDateString())
                ->whereTime('end_time', '>=', now()->toTimeString())
                ->orderBy('start_time')
                ->first();

            $data['appointments_today'] = \App\Models\Appointment::whereHas('funcionario', function ($query) {
                $query->where('user_id', auth()->id());
            })
                ->where('status', \App\Enums\AppointmentEnum::SCHEDULED)
                ->whereDate('date', '>=', now()->toDateString())
                ->whereTime('end_time', '>=', now()->toTimeString())
                ->orderBy('start_time')
                ->get();

        }

        if(auth()->user()->hasRole('Trabajador')) {
            $data['next_appointment'] = \App\Models\Appointment::whereHas('plantilla', function ($query) {
                $query->where('user_id', auth()->id());
            })


                ->latest()
                ->first();


                $data['past_appointments'] = \App\Models\Appointment::whereHas('plantilla', function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->latest()
                    ->take(5)
                    ->get();
        }



        return view('admin.dashboard', compact('data'));
    }
}
