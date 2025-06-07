<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['code', 'f_code', 'name'];
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'f_code', 'code');
    }
}
