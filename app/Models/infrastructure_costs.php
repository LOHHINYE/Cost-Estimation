<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infrastructure_costs extends Model
{
    use HasFactory;
    public $table ='infrastructure_costs';
    public $primaryKey = 'id';
    public $fillable = ['cost_id','infrastructures', 'item', 'year', 'cost', 'total', 'remark'];
}
