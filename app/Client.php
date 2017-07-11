<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salesbills() {
        return $this->hasMany(SalesBill::class);
    }

    public static function intrash()
    {
        return Client::withTrashed()->whereNotNull('deleted_at')->get();
    }

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','nit', 'number', 'address'];

    
}
