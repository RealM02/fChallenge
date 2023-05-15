<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_number',
        'fiscal_data',
        'order_date',
        'delivery_address',
        'notes',
        'status',
    ];
    
    protected $dates = [
        'order_date',
        'deleted_at',
    ];
    
    public function evidence()
    {
        return $this->hasOne(OrderEvidence::class);
    }
}

