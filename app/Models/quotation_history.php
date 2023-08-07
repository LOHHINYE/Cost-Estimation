<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quotation_history extends Model
{
    use HasFactory;

    public $table = 'quotation_histories';
    public $primaryKey = 'id';
    public $fillable = ['quotation_id', 'previous_total_cost'];
}
