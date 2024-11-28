<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class student extends Model
{
    use HasFactory;
    protected $fillable = ['Nama', 'grade_id', 'Email', 'Alamat'];
    protected $with = ['grade'];
    public function Grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
    public function Department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}