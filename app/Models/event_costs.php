<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event_costs extends Model
{
    use HasFactory;
    public $table ='event_costs';
    public $primaryKey = 'id';
    public $fillable = ['cost_id','event', 'pax', 'day', 'cost', 'total', 'remark'];
}
