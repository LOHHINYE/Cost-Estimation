<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_costs extends Model
{
    use HasFactory;
    public $table ='service_costs';
    public $primaryKey = 'id';
    public $fillable = ['cost_id','services', 'price', 'cost', 'total', 'remark'];
}
