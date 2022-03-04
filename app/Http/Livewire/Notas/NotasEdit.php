<?php

namespace App\Http\Livewire\Notas;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Dependencia;
use App\Models\DependenciaUser;
use App\Models\Nota;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class NotasEdit extends AdminComponent
{
    public $nota_id = null;

    public $state = [];

    public function mount($idNota)
    {
        $this->nota_id =  $idNota;
    }

    public function render()
    {

        $userdep= DependenciaUser::where("user_id","=",auth()->id())->first();

        if (is_null($userdep)) {
            $generaTramite = false;
        } else {
            $dependencia = Dependencia::where('id', $userdep->dependencia_id)->firstOrFail();
            $generaTramite = $dependencia->genera_tramite;
        };

        $dependencias = Dependencia::orderBy('nombre','asc')->get();

        $notas = Nota::join('users', 'notas.user_id', '=', 'users.id')
            ->join('dependencias', 'notas.dependencia_id', '=', 'dependencias.id')
            ->join('estados', 'notas.estado_id', '=', 'estados.id')
            ->where('notas.id', '=', $this->nota_id)
            ->select('users.*', 'notas.*',trim('notas.descripcion as desc'), 'dependencias.nombre as oficina', 'estados.estado as estados')
            ->first();

        $finalizado = $notas->estado_id === 5 ? true : false;

        $this->state['nombre'] = $notas->nombre;
        $this->state['titulo'] = $notas->titulo;
        $this->state['descripcion'] = $notas->descripcion;
        $this->state['telefono'] = $notas->telefono;
        $this->state['dependencia_id'] = $notas->dependencia_id;

        return view('livewire.notas.notas-edit',[
            'dependencias' => $dependencias,
            'finalizado' => $finalizado,
            'notas' => $notas
        ]);
    }
    public function EditarNota()
    {

        Validator::make($this->state,[
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

        $notaUpdate = Nota::find($this->nota_id);

        $notaUpdate->titulo      = $this->state['titulo'];
        $notaUpdate->descripcion = $this->state['descripcion'];
        $notaUpdate->nombre      = $this->state['nombre'];
        $notaUpdate->telefono    = $this->state['telefono'];
        $notaUpdate->dependencia_id    = $this->state['dependencia_id'];

        $notaUpdate->save();

		$this->dispatchBrowserEvent('alert', ['message' => 'Nota Editada con Exito!']);

        return redirect()->route('admin.notas.list');

    }










}
