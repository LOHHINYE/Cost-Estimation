<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotel_costs extends Model
{
    use HasFactory;
    public $table ='hotel_costs';
    public $primaryKey = 'id';
    public $fillable = ['cost_id','hotel', 'pax', 'night', 'cost', 'total', 'remark'];
}
