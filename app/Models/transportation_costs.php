<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transportation_costs extends Model
{
    use HasFactory;
    public $table ='transportation_costs';
    public $primaryKey = 'id';
    public $fillable = ['cost_id','transportations', 'pax', 'trip', 'cost', 'total', 'remark'];
}
