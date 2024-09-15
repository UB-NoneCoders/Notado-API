<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bimonthly',
        'maximum_score',
        'subject_id',
    ];

    public function score(): HasOne
    {
        return $this->hasOne(Score::class);
    }
}

