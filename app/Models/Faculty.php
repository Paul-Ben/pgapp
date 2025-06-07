<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['code', 'name'];

    /**
     * Get all departments that belong to this faculty.
     */
    public function departments()
    {
        return $this->hasMany(Department::class, 'f_code', 'code');
    }
}
