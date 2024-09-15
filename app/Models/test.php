<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bimonthly',
        'maximum_score',
        'subject_id',
    ];
}

