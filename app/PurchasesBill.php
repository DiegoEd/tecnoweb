<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasesBill extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'purchases_bills';

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function purchasesbilldetails() {
        return $this->hasMany(PurchasesBillDetail::class);
    }

    public function isf($idclient)
    {
        return $this->client_id==$idclient?'selected ':' ';
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
    protected $fillable = ['purchasedate', 'totalamount', 'employee_id', 'supplier_id'];

    
}
