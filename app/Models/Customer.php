<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Adress;


class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'surname',
        'prename',
        'adress_id',
        'telephonenumber',
        'email'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->prename} {$this->surname}";
    }


    public function adress()
    {
        return $this -> belongsTo(Adress::class, 'adress_id', 'adress_id');
    }

    public function orders()
    {
        return $this -> hasMany(Order::class, 'customer_id', 'customer_id');
    }

}
