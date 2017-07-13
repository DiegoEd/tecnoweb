<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasesBillDetail extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'purchases_bill_details';

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function purchasesbill() {
        return $this->belongsTo(PurchasesBill::class);
    }

    public function isf($idprod)
    {
        return $this->product_id==$idprod?'selected ':'disabled';
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
    protected $fillable = ['price', 'amount', 'product_id', 'purchases_bill_id'];

    
}
