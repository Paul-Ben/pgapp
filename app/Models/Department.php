<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'faculty_id', 'name'];

    // A department belongs to a faculty
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    // A department can have many programmes
    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }
}
