<?php

use Illuminate\Database\Seeder;
use App\Module;
use App\Accion;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	##Gestio de clientes
        $module = new Module;
        $module->name = 'Gestión de Clientes';
        $module->description = 'Conjunto de accinoes para administrar clientes';
        $module->visitcount = 0;
        $module->save();
        ##Acciones de gestionar cliente
		        $accion = new Accion;
		        $accion->name= 'Crear cliente';
		        $accion->pageroute ='/clients/create';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Papelera de reciclaje';
		        $accion->pageroute ='/clients/trash';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Mostrar clientes';
		        $accion->pageroute ='/clients/index/index';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Modificar clientes';
		        $accion->pageroute ='/clients/index/indexedit';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Eliminar clientes';
		        $accion->pageroute ='/clients/index/indexdelete';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        




    }
}
