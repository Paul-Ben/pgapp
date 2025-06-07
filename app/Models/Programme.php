<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'duration',
        'faculty_id',
        'department_id',
        'created_by',
        'updated_by',
    ];

    // public function faculty()
    // {
    //     return $this->belongsTo(Faculty::class);
    // }

    // public function department()
    // {
    //     return $this->belongsTo(Department::class);
    // }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}
