<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    public function employee() {
        return $this->hasOne(Employee::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    

    public function inrole($id)
    {
            if($this->role_id == $id)
            {
                return ' checked ';
            }
        return ' ';
    }
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    public static function isusernameunique($username)
    {
        return  User::where('username', $username)->count() == 0 ;
    }

    public function ismyusername($username)
    {
        return $this->username == $username;
    }

    public function getRoles()
    {
        $modulesadded = array();
        $role = $this->role;
        if(is_null($role))
        {
            return array();
        }
        $accions = $role->accions;
        $results =  array();

        foreach ($accions as $accion) {
            if(!array_key_exists($accion->module_id,$modulesadded))
            {
                $moduleArray =array();
                $accionArray =array();

                $modulesadded[$accion->module_id] = $accion->module_id;
                $module = $accion->module;
                array_push($moduleArray, $module->id);
                array_push($moduleArray, $module->name);
                array_push($moduleArray, $module->description);
                array_push($accionArray, $accion->id);
                array_push($moduleArray, $accionArray);

                $results[$accion->module_id] = $moduleArray;
            }else
            {
                $accionArray = ($results[$accion->module_id])[3];
                array_push($accionArray, $accion->id);
                ($results[$accion->module_id])[3]=$accionArray;
            }
        }
        return $results;
    }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password', 'email','role_id'];

    
}
