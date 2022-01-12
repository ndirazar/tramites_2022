<?php

namespace App\Http\Livewire\Notas;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Dependencia;
use App\Models\DependenciaUser;
use App\Models\Movimiento;
use App\Models\Nota;
use App\Models\Setting;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class NotaCreate extends AdminComponent
{

    public $state = [];

    public $archivo;

    use WithFileUploads;

    public function render()
    {

        $userdep= DependenciaUser::where("user_id","=",auth()->id())->first();

        if (is_null($userdep)) {
            $generaTramite = false;
        } else {
            $dependencia = Dependencia::where('id', $userdep->dependencia_id)->firstOrFail();
            $generaTramite = $dependencia->genera_tramite;
        };

        $dependencias = Dependencia::get();

        return view('livewire.notas.nota-create',[
            'dependencias' => $dependencias,
            'generaTramite' => $generaTramite
        ]);
    }

    public function CrearNota()
    {
        $notaId = Setting::get();

        $this->state['id'] = $notaId[0]->nroNota;

		Validator::make(
			$this->state,
			[
				'id' => 'required',
                'titulo' => 'required',
                'descripcion' => 'required',
                'nombre' => 'required',
				'telefono' => 'required|numeric',
                'dependencia_id' => 'required',
			],
			[
				'dependencia_id.required' => 'La Oficina / Area es Obligatoria'
			])->validate();

        // To UpperCase
        $this->state['titulo'] = strtoupper($this->state['titulo']);
        $this->state['descripcion'] = strtoupper($this->state['descripcion']);
        $this->state['nombre'] = strtoupper($this->state['nombre']);

        $this->state['user_id'] = auth()->id();
        $this->state['estado_id'] = 1;
        $this->state['finalizada'] = false;
        $this->state['visto'] = false;

        Nota::create($this->state);

        $date = Carbon::now();

        $idNota = Nota::latest('id')->first();

        $setting = Setting::first();

        $setting->nroNota = $idNota->id + 1;

        $setting->save();

        $mov = Movimiento::create([
            'nota_id' => $idNota->id,
            'created_at' => $date,
            'estado_id' => 1,
            'user_id' => auth()->id(),
        ]);

        $mov->save();

		$this->dispatchBrowserEvent('alert', ['message' => 'Appointment created successfully!']);

        return redirect()->route('admin.notas.list');
    }

}
