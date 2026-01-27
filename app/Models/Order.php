<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product;
use App\Models\OrderStatus;
use App\Models\OrderInfo;
use App\Models\Customer;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'customer_id',
        'orderstatus_id',
        'order_date',
        'delivery_date',
        'PickupLocation',
        'price',
        'note'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'orderstatus_id', 'orderstatus_id');
    }

    
    public function orderInfos()
    {
        return $this->hasMany(OrderInfo::class, 'order_id', 'order_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orderinfo','order_id', 'product_id')->withPivot('quantity', 'note')->withTimestamps();
    }
}
