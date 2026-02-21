<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlodeType;
use App\Models\Centro;
use App\Models\Ciudad;
use App\Models\Depto;
use App\Models\Estado;
use App\Models\Plantilla;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PlantillaController extends Controller
{
    public $ciudads = null;
    public $ciudad;
    public $state = [];
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        Gate::authorize('read_plantilla');

        return view('admin.plantillas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plantillas.create');
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
    public function show(Plantilla $plantilla)
    {
        return view('admin.plantillas.show', compact('plantilla'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plantilla $plantilla)
    {
        /* public $imagen; */
        Gate::authorize('update_plantilla');

        $blodTypes = BlodeType::all();
        $centros = Centro::all();
        $deptos = Depto::all();
        $estados = Estado::all();
         $ciudads = Ciudad::orderBy('nombre', 'ASC')->get();

        return view('admin.plantillas.edit', compact('plantilla', 'blodTypes', 'centros', 'deptos', 'estados', 'ciudads'));
    }

       public function updatedselectedEstado($estado)
    {
        /* $this->readyToLoad = true; */
        /*     dd($estado);   */
        $this->ciudads = Ciudad::where('estado_id', $estado)
            ->orderBy('nombre', 'ASC')->get();

        $this->ciudad = $this->ciudads->first()->id ?? null;
    }
    public function selectedCiudad($value)
    {
        $this->state = $value;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plantilla $plantilla)
    {
        Gate::authorize('update_plantilla');

        /* $request->validate([
            'image' => 'required|image|max:1024',
        ]); */
        /* return $request->all(); */
        /* return $request->file('image'); */
        $ficha = $plantilla->user->ficha;
        /*
        if($request->hasFile('image')){
             $data['image_path']=Storage::put('photo',$request->image);
        }
         $plantilla->update($data); */

         $data = $request->validate([
            'centro_id' => 'nullable',
            'depto_id' => 'nullable',
            'estado_id' => 'nullable',
            'ciudad_id' => 'nullable',
            'cp' => 'nullable',
            'situacionc' => 'nullable',
            'c_emergencia' => 'nullable',
            't_emergencia' => 'nullable',
            'blode_type_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);




        /*  $imageName = $ficha . '.' . $request->image->extension();
         $request->image->move(storage_path('app/public/photo'), $imageName);  */


        /* Storage::put('photo', $request->file('image')); */


        if ($request->hasFile('image')) {
            $destination = storage_path('app/public/') . $plantilla->image_path;
            /* dd($destination);  */

            if (File::exists($destination)) {
                File::delete($destination);
            }

            /* $file = $request->file('image'); */
            $imageName = $ficha . '.' . $request->image->extension();


            $request->image->move(storage_path('app/public/photo'), $imageName);

            /* dd($file); */
            /* $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/shops/', $filename); */
            /* $shop->image = $filename; */

            $data['image_path'] = 'photo/' . $imageName;
        }


        $plantilla->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Trabajador actualizado!',
            'text' => 'Los datos del Trabajador  se han actualizado correctamente',
        ]);

        return redirect()->route('admin.plantillas.edit', $plantilla);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plantilla $plantilla)
    {
        //
    }
}
