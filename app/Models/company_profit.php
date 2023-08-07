<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company_profit extends Model
{
    use HasFactory;

    public $table ='company_profit';
    public $primaryKey = 'id';
    public $fillable = ['otherFactor', 'company_profit'];

}
