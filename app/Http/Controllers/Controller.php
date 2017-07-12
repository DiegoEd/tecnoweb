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
    	$roless = session('roles');
    	$accions =(Accion::whereIn('id', (($roless[0])[$idmodulo])[3] )->get(['id']))->toArray();
        foreach ($accions as $clave => $valor)
        {
            if($idaccion == $valor['id'])
            {
                return true;
            }
        }
        return false;
    }
}
