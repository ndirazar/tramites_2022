<?php

namespace App\Http\Livewire\Dependencias;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Dependencia;
use App\Models\DependenciaUser;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DependenciaUsers extends AdminComponent
{

    public $state = [];

    public $principal = null;

    public $userAsignado = null;


    public function render()
    {

        $depUsers = DependenciaUser::join('dependencias', 'dependencia_users.dependencia_id', '=', 'dependencias.id')
        ->join('users','dependencia_users.user_id','=','users.id')
        ->select('users.name','dependencias.nombre','dependencia_users.*')
        ->paginate(10);

        $usuarios = User::get();

        $oficinas = Dependencia::pluck('nombre', 'id');

        return view('livewire.dependencias.dependencia-user', [
            'depUsers' => $depUsers,
            'usuarios' => $usuarios,
            'oficinas' => $oficinas
        ]);
    }

    public function newAsignacion()
    {
        $this->reset();

        $this->dispatchBrowserEvent('show-form');
    }

    public function asignarOficina()
    {

        if  (is_Null($this->principal)) {
            $this->state['principal'] =false;
        } else {
            $this->state['principal'] =true;
        }

        $validatedData = Validator::make($this->state, [
            'user_id' => 'required',
            'dependencia_id' => 'required',
        ],
        [
            'user_id.required' => 'El usuario es Obligatorio',
            'dependencia_id.required' => 'La Oficina / Area es Obligatoria'
        ])->validate();

        $validatedData['principal'] = $this->state['principal'];

        DependenciaUser::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'Oficina Creada Con Exito!!!']);
    }

    public function confirmarEliminacion($depUsers) {


        $this->userAsignado = $depUsers;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

	public function EliminarAsignacion()
	{

        $userDependencia = DependenciaUser::where('user_id','=',$this->userAsignado['user_id'])
                                ->where('dependencia_id','=',$this->userAsignado['dependencia_id']);

		$userDependencia->delete();

		$this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Asignacion Eliminada!!']);
	}
}
