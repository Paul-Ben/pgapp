<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $guarded = [];

     protected $primaryKey = 'appno';
    public $incrementing = false; // if appno is not auto-incrementing
    protected $keyType = 'string';


    public function applicantsReferees()
    {
        return $this->hasMany(ApplicantsReferee::class, 'applicants_id', 'appno');
    }
    public function applicantInstitutionDetails()
    {
        return $this->hasMany(ApplicantInstitutionDetail::class, 'applicants_id', 'appno');
    }
}
