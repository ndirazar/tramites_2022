<?php

namespace App\Http\Livewire\Notas;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\DependenciaUser;
use App\Models\Movimiento;
use App\Models\Nota;


class NotasShow extends AdminComponent
{

    protected $listeners = ['resueltoTramite' => 'confirmarResuelto'];

    public $nota_id = null;

    public $observaciones = null;

    public $tramiteAResolver = null;

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
            ->select('users.*', 'notas.*', 'dependencias.nombre as oficina', 'estados.estado as estados')
            ->first();

        $userdep = DependenciaUser::where("user_id", "=", auth()->id())->first();

        //Controla de quien es el Tramite

        if (is_null($userdep)) {
            $es_mio = false;
        } else {
            if ($notas->dependencia_id === $userdep->dependencia_id) {
                $es_mio = true;
            } else {
                $es_mio = false;
            }
        }

        $finalizado = $notas->estado_id === 5 ? true : false;

        return view('livewire.notas.notas-show', [
            'notas' => $notas,
            'es_mio' => $es_mio,
            'finalizado' => $finalizado
        ]);
    }

    public function cancelarTramite()
    {
        $this->observaciones = null;
    }

    public function confirmarResuelto()
    {

        $item = Nota::where('id', $this->tramiteAResolver)->firstOrFail();

        // Estado = 5 => RESUELTO

        $item->estado_id = 5;

        $item->save();

        $mov = Movimiento::create([
            'nota_id' => $this->tramiteAResolver,
            'estado_id' => 5,
            'user_id' => auth()->id(),
            'observaciones' => strtoupper($this->observaciones),
        ]);

        $mov->save();

        $this->dispatchBrowserEvent('resuelto', ['message' => 'Trámite Resuelto - Nro: ' . $this->tramiteAResolver]);
    }

    public function resolverTramite($id)
    {

        $this->tramiteAResolver = $id;

        if (is_null($this->observaciones)) {

            $this->dispatchBrowserEvent('sinObservaciones', ['message' => 'La operacion no se pudo realizar - Trámite Nro: ' . $this->tramiteAResolver]);
        } else {

            $this->dispatchBrowserEvent('confirmation-resolver-tramite');
        }
    }
}
