<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantsReferee extends Model
{
    protected $guarded = ['id'];

    protected $table = 'applicantsreferees';
    protected $primaryKey = 'id';

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicants_id', 'appno');
    }
}
