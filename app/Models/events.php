<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class events extends Model
{
    use HasFactory;
    public $table = 'events';
    public $primaryKey = 'event_id';
    public $fillable = ['event_desc'];
}
