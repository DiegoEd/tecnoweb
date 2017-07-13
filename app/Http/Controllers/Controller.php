<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Session;
use App\Accion;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function islogged()
    {
        if (empty(session('id'))) {
            return false;
        }
        return true;
    }

    public function tienepermiso($idaccion,$idmodulo)
    {
        try {
        	$roless = session('roles');
            if(count($roless[0])==0)
            {
                return false;
            }
            if(!array_key_exists($idmodulo,$roless[0]))
            {
                return false;
            }
        	$accions =(Accion::whereIn('id', (($roless[0])[$idmodulo])[3] )->get(['id']))->toArray();
            foreach ($accions as $clave => $valor)
            {
                if($idaccion == $valor['id'])
                {
                    return true;
                }
            }
        } catch (Exception $e) {
            return false;
        }
        return false;
    }
}
