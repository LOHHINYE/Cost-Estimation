<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_cost extends Model
{
    use HasFactory;
    public $table ='role_cost';
    public $primaryKey = 'id';
    public $fillable = ['cost_id','role', 'salary_per_day', 'qty', 'day'];

}
