<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Estado;
use App\Models\Nota;
use App\Models\DependenciaUser;
use App\Models\User;
use Livewire\Component;

class Inicio extends Component
{

    public function render()
    {
        // $userdep= DependenciaUser::where("user_id","=",auth()->id())->first();
        $userdep= DependenciaUser::where("user_id","=",auth()->id())->get('dependencia_id')->toArray();

        $idPendiente = Estado::where('estado','=','PENDIENTE')->first();

        $idFinalizado = Estado::where('estado','=','FINALIZADO')->first();

        $date  = Carbon::today();

        $ahora = Carbon::now();

        $user=User::where("id","=",auth()->id())->first();

        if ( $user->role==='admin') {

            $cant_pendientes = Nota::where('estado_id','=',$idPendiente->id)->count();

            $creadas_hoy = Nota::whereBetween('created_at', [$date, $ahora])->count();

            $sin_ver = Nota::where('visto','=', false)->count();

            $cant_resueltos = Nota::where('estado_id','=',$idFinalizado->id)->count();

            $mis_tramites=0;

        } else {

            $mis_tramites = Nota::whereBetween('created_at', [$date, $ahora])
                            ->where('user_id','=',auth()->id())
                            ->count();


            $cant_pendientes = Nota::where('estado_id','=',$idPendiente->id)
                                // ->where('dependencia_id','=',$userdep->dependencia_id)
                                ->whereIn('dependencia_id',$userdep)
                                ->count();

            $creadas_hoy = Nota::whereBetween('created_at', [$date, $ahora])
                            // ->where('dependencia_id','=',$userdep->dependencia_id)
                            ->whereIn('dependencia_id',$userdep)
                            ->count();

            $sin_ver = Nota::where('visto','=', false)
                        // ->where('dependencia_id','=',$userdep->dependencia_id)
                        ->whereIn('dependencia_id',$userdep)
                        ->count();

            $cant_resueltos = Nota::where('estado_id','=',$idFinalizado->id)
                            // ->where('dependencia_id','=',$userdep->dependencia_id)
                            ->whereIn('dependencia_id',$userdep)
                            ->count();
            }

        return view('livewire.admin.inicio',[
            'cant_pendientes' => $cant_pendientes,
            'creadas_hoy' => $creadas_hoy,
            'sin_ver' => $sin_ver,
            'cant_resueltos' => $cant_resueltos,
            'mis_tramites' => $mis_tramites
        ]
    );
    }
}
