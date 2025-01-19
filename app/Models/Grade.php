<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\student;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    protected $fillable = ['Name', 'department_id'];

    use HasFactory;
    public function students()
    {
        return $this->hasMany(Student::class);
    }


    public function Department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}