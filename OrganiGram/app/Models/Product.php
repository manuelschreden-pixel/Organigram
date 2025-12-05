<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderInfo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock_quantity',
        'category_id'
    ];

    public function category() 
    {
        return $this -> belongsTo(Category::class, 'category_id', 'category_id');
    }

    
    public function orderInfos()
    {
        return $this->hasMany(OrderInfo::class, 'product_id', 'product_id');
    }

     public function orders()
    {
        return $this->belongsToMany(Order::class, 'orderinfo', 'product_id', 'order_id')->withPivot('quantity', 'note')->withTimestamps();
    }
}
