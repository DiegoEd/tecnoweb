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
        $module->description = 'Conjunto de acciones para administrar clientes';
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
		        ##Gestion de personal
        $module = new Module;
        $module->name = 'Gestión de personal';
        $module->description = 'Conjunto de acciones para administrar el personal de la empresa';
        $module->visitcount = 0;
        $module->save();
         ##Acciones de gestionar personal
		        $accion = new Accion;
		        $accion->name= 'Crear personal';
		        $accion->pageroute ='/employees/create';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Papelera de reciclaje';
		        $accion->pageroute ='/employees/trash';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Mostrar personal';
		        $accion->pageroute ='/employees/index/index';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Modificar personal';
		        $accion->pageroute ='/employees/index/indexedit';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Eliminar personal';
		        $accion->pageroute ='/employees/index/indexdelete';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		                ##Gestion de producto
        $module = new Module;
        $module->name = 'Gestión de productos';
        $module->description = 'Conjunto de Acciones para gestionar los productos de Hinolux';
        $module->visitcount = 0;
        $module->save();
##Acciones de gestionar cliente
		        $accion = new Accion;
		        $accion->name= 'Adicionar producto';
		        $accion->pageroute ='/products/create';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Papelera de reciclaje';
		        $accion->pageroute ='/products/trash';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Mostrar producto';
		        $accion->pageroute ='/products/index/index';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Modificar producto';
		        $accion->pageroute ='/products/index/indexedit';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Eliminar producto';
		        $accion->pageroute ='/products/index/indexdelete';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
 ##Gestion de categoria de producto
        $module = new Module;
        $module->name = 'Gestión de categoria-Productos';
        $module->description = 'Acciones para gestionar las distintas categorias de productos';
        $module->visitcount = 0;
        $module->save();
##Acciones de gestionar cliente
		        $accion = new Accion;
		        $accion->name= 'Adicionar categoria';
		        $accion->pageroute ='/product-categories/create';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Papelera de reciclaje';
		        $accion->pageroute ='/product-categories/trash';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Mostrar categorias';
		        $accion->pageroute ='/product-categories/index/index';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Modificar categoria';
		        $accion->pageroute ='/product-categories/index/indexedit';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Eliminar categoria';
		        $accion->pageroute ='/product-categories/index/indexdelete';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
 ##Gestion de categoria de producto
        $module = new Module;
        $module->name = 'Gestión de Proveedores';
        $module->description = 'Abarca todas las acciones para administrar la información de los proveedores asociados';
        $module->visitcount = 0;
        $module->save();
##Acciones de gestionar cliente
		        $accion = new Accion;
		        $accion->name= 'Crear proveedor';
		        $accion->pageroute ='/suppliers/create';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Papelera de reciclaje';
		        $accion->pageroute ='/suppliers/trash';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Mostrar proveedor';
		        $accion->pageroute ='/suppliers/index/index';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Modificar proveedor';
		        $accion->pageroute ='/suppliers/index/indexedit';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        $accion = new Accion;
		        $accion->name= 'Eliminar proveedor';
		        $accion->pageroute ='/suppliers/index/indexdelete';
		        $accion->visitcount = 0;
		        $accion->module_id = $module->id;
		        $accion->save();
		        




    }
}
