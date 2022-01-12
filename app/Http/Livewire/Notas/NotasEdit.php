<?php

namespace App\Http\Livewire\Notas;

use App\Http\Livewire\Admin\AdminComponent;
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

        return view('livewire.notas.notas-edit',[
            'notas' => $notas,
            'finalizado' => $finalizado
        ]);
    }
    public function EditarNota()
    {


        Validator::make($this->state,[
            'titulo' => 'required',
            'descripcion' => 'required',
            'nombre' => 'required',
            'telefono' => 'required|numeric',
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

        $notaUpdate->save();

		$this->dispatchBrowserEvent('alert', ['message' => 'Nota Editada con Exito!']);

        // return redirect()->route('admin.notas.list');
    }










}
