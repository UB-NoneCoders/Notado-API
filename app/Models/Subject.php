<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "status",
        "user_id",
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, "teacher_id");
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class,
        "user_subject",
        "subject_id",
        "student_id")
        ->withTimestamps();
    }

    public function addStudent($id)
    {
        $this->students()->syncWithoutDetaching([$id]);
    }

    public function removeStudent($id)
    {
        $this->students()->detach($id);
    }

}
