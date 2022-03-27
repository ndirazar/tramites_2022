<?php

namespace App\Http\Livewire\Notas;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Dependencia;
use App\Models\DependenciaUser;
use App\Models\Movimiento;
use App\Models\Nota;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class NotasList extends AdminComponent
{
    public $searchTerm = null;

    public $idExpediente = 0;

    public $nroTramite = null;

    protected $queryString = ['nroTramite' => ['except' => '']];

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedNroTramite()
    {
        $this->resetPage();
    }

    public function render()
    {

        $now = Carbon::now();

        // Estados = 1 CREADO
        // Estados = 2 EN CURSO
        // Estados = 3 PENDIENTE
        // Estados = 4 ANULADO
        // Estados = 5 FINALIZADO

        //Trámites recibidos

        // Armo un Array con lsa Dependencias que tiene el USUARIO
        $userdep= DependenciaUser::where("user_id","=",auth()->id())->get('dependencia_id')->toArray();

        $user= User::where("id","=",auth()->id())->first();

        if ($user->isAdmin()) {

            $notas = Nota::join('users', 'notas.user_id', '=', 'users.id')
            ->join('dependencias', 'notas.dependencia_id', '=', 'dependencias.id')
            ->join('estados', 'notas.estado_id', '=', 'estados.id')
            ->select('users.*','notas.*','dependencias.nombre','estados.estado as estado_nombre')
            ->where('notas.estado_id' ,'=',1)
            ->where(DB::raw('DATE_FORMAT(notas.created_at,"%Y")') ,'=',$now->year)
            ->where('notas.id', 'like', '%'.$this->searchTerm.'%')
            ->orderBy('notas.created_at','desc')
            ->paginate(7, ['*']);

            //Tramites Pendientes

            $notas_pendientes = Nota::join('users', 'notas.user_id', '=', 'users.id')
                ->join('dependencias', 'notas.dependencia_id', '=', 'dependencias.id')
                ->join('estados', 'notas.estado_id', '=', 'estados.id')
                ->select('users.*','notas.*','dependencias.nombre','estados.estado as estado_nombre')
                ->WhereNotIn('notas.estado_id', [1,4,5])
                ->where(DB::raw('DATE_FORMAT(notas.created_at,"%Y")') ,'=',$now->year)
                ->where('notas.id', 'like', '%'.$this->searchTerm.'%')
                ->orderBy('notas.id','desc')
                ->paginate(7, ['*']);

            $resueltos = Nota::join('users', 'notas.user_id', '=', 'users.id')
                ->join('dependencias', 'notas.dependencia_id', '=', 'dependencias.id')
                ->join('estados', 'notas.estado_id', '=', 'estados.id')
                ->select('users.*','notas.*','dependencias.nombre','estados.estado as estado_nombre')
                ->where('notas.estado_id','=', 5)
                ->where(DB::raw('DATE_FORMAT(notas.created_at,"%Y")') ,'=',$now->year)
                ->orderBy('notas.created_at','desc')
                ->paginate(7, ['*']);

        } else {

            $notas = Nota::join('users', 'notas.user_id', '=', 'users.id')
                ->join('dependencias', 'notas.dependencia_id', '=', 'dependencias.id')
                ->join('estados', 'notas.estado_id', '=', 'estados.id')
                ->select('users.*','notas.*','dependencias.nombre','estados.estado as estado_nombre')
		        ->where('notas.estado_id' ,'=',1)
                ->where(DB::raw('DATE_FORMAT(notas.created_at,"%Y")') ,'=',$now->year)
                ->where('notas.id', 'like', '%'.$this->searchTerm.'%')
                ->whereIn('notas.dependencia_id' ,$userdep)
                ->orderBy('notas.created_at','desc')
                ->paginate(7, ['*']);

            //Tramites Pendientes

            $notas_pendientes = Nota::join('users', 'notas.user_id', '=', 'users.id')
                ->join('dependencias', 'notas.dependencia_id', '=', 'dependencias.id')
                ->join('estados', 'notas.estado_id', '=', 'estados.id')
                ->select('users.*','notas.*','dependencias.nombre','estados.estado as estado_nombre')
                ->WhereNotIn('notas.estado_id', [1,4,5])
                // ->where('notas.dependencia_id' ,'=',$userdep->dependencia_id)
                ->whereIn('notas.dependencia_id' ,$userdep)
                ->where('notas.id', 'like', '%'.$this->searchTerm.'%')
                ->where(DB::raw('DATE_FORMAT(notas.created_at,"%Y")') ,'=',$now->year)
                ->orderBy('notas.created_at','desc')
                ->paginate(7, ['*']);


            $resueltos = Nota::join('users', 'notas.user_id', '=', 'users.id')
                ->join('dependencias', 'notas.dependencia_id', '=', 'dependencias.id')
                ->join('estados', 'notas.estado_id', '=', 'estados.id')
                ->select('users.*','notas.*','dependencias.nombre','estados.estado as estado_nombre')
                ->where('notas.estado_id','=', 5)
                ->where(DB::raw('DATE_FORMAT(notas.created_at,"%Y")') ,'=',$now->year)
                ->whereIn('notas.dependencia_id' ,$userdep)
                ->orderBy('notas.created_at','desc')
                ->paginate(5, ['*']);
            }

        //EXPEDIENTES GENERADOS POR EL USUARIO
        $expedientes = Nota::join('users', 'notas.user_id', '=', 'users.id')
            ->join('dependencias', 'notas.dependencia_id', '=', 'dependencias.id')
            ->join('estados', 'notas.estado_id', '=', 'estados.id')
            ->select('users.*','notas.*','notas.nombre as apellido','dependencias.nombre','estados.estado as estado_nombre')
            ->where('notas.user_id', '=',auth()->id())
            ->where(DB::raw('DATE_FORMAT(notas.created_at,"%Y")') ,'=',$now->year)
            ->where(function($q) {
                    $q->where('notas.id', 'like', '%'.$this->nroTramite.'%')
                      ->orWhere('notas.nombre', 'like', '%'.$this->nroTramite.'%')
                      ->orWhere('dependencias.nombre', 'like', '%'.$this->nroTramite.'%');
                    })
            ->orderBy('notas.created_at','desc')
            ->paginate(6);

        $movimientos =  DB::select("SELECT movimientos.nota_id,
                                           movimientos.created_at as fecha,
                                           estados.estado,
                                           users.name as usuario,
                                           dependencias.nombre as area,
                                           movimientos.observaciones
                                    FROM movimientos,
                                         users,
                                         estados,
                                         dependencia_users,
                                         dependencias
                                    where movimientos.user_id = users.id
                                    and movimientos.estado_id = estados.id
                                    and users.id = dependencia_users.user_id
                                    and dependencia_users.dependencia_id = dependencias.id
                                    and movimientos.nota_id = $this->idExpediente
                                    order by movimientos.created_at asc");



        $usuarioDepPrincipal= DependenciaUser::where("user_id","=",auth()->id())
                                             ->where('principal','=',true)
                                             ->first();
        if (is_null($usuarioDepPrincipal)) {
                 $generaTramite = false;
        } else {
                 $dependencia = Dependencia::where('id', $usuarioDepPrincipal->dependencia_id)->firstOrFail();

                 $generaTramite = $dependencia->genera_tramite;
        };

        return view('livewire.notas.notas-list',[
            'notas' => $notas,
            'expedientes' => $expedientes,
            'resueltos' => $resueltos,
            'notas_pendientes' => $notas_pendientes,
            'movimientos' => $movimientos,
            'generaTramite' => $generaTramite
        ]);
    }

    public function isforme($id)
    {
        // UN USUARIO PUEDE REVOLVER TODO LO QUE TENGA A CARGO

        $user= User::where("id","=",auth()->id())->first();

        if ($user->isAdmin()) {

            return true;

        } else {

            // $userDep= DependenciaUser::where("user_id","=",auth()->id())
            //                      ->where('principal','=',true)
            //                      ->first();
            $userDep= DependenciaUser::where("user_id","=",auth()->id())->get('dependencia_id')->toArray();

            if (is_null($userDep)) {
                return false;

            } else {
                $cant = Nota::where('visto','=','false')
                            ->where('finalizada','=','false')
                            ->where('id','=',$id)
                            ->whereIn('dependencia_id',$userDep)
                            ->count();
                if ($cant > 0) {
                    return true;
                } else {
                    return false;
                };
            }
        }
    }

    public function selExpediente($id)
    {
        $this->idExpediente = $id;
    }

    public function anularNota($id)
    {
        $item = Nota::where('id', $id)->firstOrFail();
        $item->visto = true;
        // Estado = 4 => ANULADO
        $item->estado = 4;
        $item->save();
        session()->flash('message', 'Trámite Anulado Exitosamente!!!!');
    }

    public function visto($id)
    {
        $item = Nota::where('id', $id)->firstOrFail();
        $item->visto = true;
        // Estado = 3 => PENDIENTE
        $item->estado_id = 3;
        $item->save();

        //Generar Movimiento

        $date = Carbon::now();

        //Estado Pendiente id = 3

        $mov = Movimiento::create([
            'nota_id' => $id,
            'created_at' => $date,
            'estado_id' => 3,
            'user_id' => auth()->id(),
        ]);

        $mov->save();

        session()->flash('message', 'Nota en Estado => Pendiente');
    }
}
