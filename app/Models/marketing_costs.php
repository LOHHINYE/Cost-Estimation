<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marketing_costs extends Model
{
    use HasFactory;
    public $table ='marketing_costs';
    public $primaryKey = 'id';
    public $fillable = ['cost_id','marketings', 'item', 'cost', 'total', 'remark'];
}
