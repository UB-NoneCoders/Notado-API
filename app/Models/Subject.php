<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "status",
        "teacher_id",
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, "teacher_id");
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class,
        "subject_users",
        "subject_id",
        "student_id")
        ->withTimestamps();
    }

    public function addStudent($ids)
    {
        foreach ($ids as $id) {
            $this->students()->syncWithoutDetaching([$id]);
        }
    }

    public function removeStudent($id)
    {
        $this->students()->detach($id);
    }
  
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }

    public function addTest($id)
    {
        $this->tests()->tests()->syncWithoutDetaching($id);
    }

    public function removeTest($id)
    {
        $this->tests()->tests()->detach($id);
    }
}
