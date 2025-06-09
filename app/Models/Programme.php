<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'department_id', 'name', 'min_score', 'archive', 'category'];

    // A programme belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
