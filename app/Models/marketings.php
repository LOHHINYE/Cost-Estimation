<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marketings extends Model
{
    use HasFactory;
    public $table = 'marketings';
    public $primaryKey = 'marketing_id';
    public $fillable = ['marketing_desc'];
}
