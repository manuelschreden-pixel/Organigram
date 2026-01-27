<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;


class Adress extends Model
{
    use HasFactory;

    protected $table = 'adresses';
    protected $primaryKey = 'adress_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'street',
        'housenumber',
        'plz',
        'town'
    ];

    public function customer() 
    {
        return $this -> hasMany(Customer::class, 'adress_id', 'adress_id');
    }

    public function getFullAddressAttribute()
    {
        return "{$this->street} {$this->housenumber}, {$this->plz} {$this->town}";
    }

}
