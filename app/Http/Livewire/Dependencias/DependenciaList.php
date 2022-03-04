<?php

namespace App\Http\Livewire\Dependencias;
use App\Http\Livewire\Admin\AdminComponent;
use Illuminate\Support\Facades\Validator;
use App\Models\Dependencia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class DependenciaList extends AdminComponent
{
    public $state = [];

    public $searchTerm = null;

    public $showEditModal = false;

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

	public function addNew()
	{
        $this->reset();

		$this->showEditModal = false;

		$this->dispatchBrowserEvent('show-form');
	}

	public function createDependencia()
	{
        $validatedData = Validator::make($this->state, [
            'nombre' => 'required',
            'genera_tramite' => 'required',
        ])->validate();

        $validatedData['nombre'] = Str::upper($validatedData['nombre']);

        Dependencia::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Oficina Creada Con Exito!!!']);
	}

	public function editaDependencia(Dependencia $dependencia)
	{
		// $this->reset();

		$this->showEditModal = true;

		$this->dependencia = $dependencia;

		$this->state = $dependencia->toArray();

		$this->dispatchBrowserEvent('show-form');
	}

	public function updateDependencia()
	{
		$validatedData = Validator::make($this->state, [
			'nombre' => 'required',
            'genera_tramite' => 'required',
		])->validate();

		$validatedData['nombre'] = Str::upper($validatedData['nombre']);

        $this->dependencia->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'Oficina actualizada con Exito!']);
	}

    public function render()
    {
            $dependencias = Dependencia::where('nombre', 'like', '%'.$this->searchTerm.'%')
                            ->orderBy('nombre')
                            ->paginate(10);

        if (is_null($dependencias)) {

            $dependencias = Dependencia::orderBy('nombre')->paginate(10);

            return view('livewire.dependencias.dependencia-list', [
                'dependencias' => $dependencias
            ]);
        } else {

            return view('livewire.dependencias.dependencia-list', [
                'dependencias' => $dependencias
            ]);

        }

    }
}
