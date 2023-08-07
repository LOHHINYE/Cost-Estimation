<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transportations extends Model
{
    use HasFactory;
    public $table = 'transportations';
    public $primaryKey = 'transportation_id';
    public $fillable = ['transportation_desc'];
}
