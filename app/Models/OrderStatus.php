<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;

class OrderStatus extends Model
{
    use HasFactory;
    
    protected $table = 'orderstatus';
    protected $primaryKey = 'orderstatus_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'status_name'
    ];

    public function orders()
    {
        return $this -> hasMany(Order::class, 'orderstatus_id', 'orderstatus_id');
    }
}
