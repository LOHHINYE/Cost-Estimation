<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    public $table ='roles';
    public $primaryKey = 'roles_id';
    public $fillable = ['role', 'salary', 'salary_per_day'];
}
