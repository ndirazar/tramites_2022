<?php

use App\Models\Dependencia;
use App\Models\DependenciaUser;
use App\Models\Setting;
use App\Models\User;
use App\NullSetting;
use Illuminate\Support\Facades\Cache;

function setting($key)
{
    $setting = Cache::rememberForever('setting', function () {
        return Setting::first() ?? NullSetting::make();
    });

    if ($setting) {
        return $setting->{$key};
    }
}

function canGenerateTramite($key)
{
    $canGenerateTramite = Cache::rememberForever('canGenerateTramite', function () {

        $userDep = DependenciaUser::where('user_id' ,'=',auth()->id())->first();

        if(is_Null($userDep))
        {
            return false;
        } else {

            return Dependencia::where('id','=',$userDep->dependencia_id)->first();
        }
    });

    if ($canGenerateTramite) {
        return $canGenerateTramite->{$key};
    }
}
