<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costs extends Model
{
    use HasFactory;
    public $table = 'costs';
    public $primaryKey = 'id';
    public $fillable =
    ['company_name',
    'sst',
    'totalcost',
    'profile',
    'size',
    'factorRate',
    'role_sub',
    'service_sub',
    'event_sub',
    'hotel_sub',
    'trans_sub',
    'infras_sub',
    'market_sub',
    'is_checked'
];

    public function roles()
    {
        return $this->hasMany(role_cost::class);
    }

    public function role_costs()
    {
        return $this->hasMany('App\Models\role_cost');
    }
    public function role_cost()
    {
        return $this->hasMany('App\Models\role_cost', 'cost_id');
    }
}
