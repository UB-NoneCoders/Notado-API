<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function createRole(array $data)
    {
        return self::create($data);
    }

    public function updateRole(array $data)
    {
        $this->update($data);
        return $this;
    }
}

