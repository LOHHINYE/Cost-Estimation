<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infrastructures extends Model
{
    use HasFactory;
    public $table = 'infrastructures';
    public $primaryKey = 'infrastructure_id';
    public $fillable = ['infrastructure_desc'];
}
