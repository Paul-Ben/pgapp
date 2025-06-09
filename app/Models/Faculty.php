<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name'];

    // A faculty can have many departments
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
