<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotels extends Model
{
    use HasFactory;
    public $table = 'hotels';
    public $primaryKey = 'hotel_id';
    public $fillable = ['hotel_desc'];
}
