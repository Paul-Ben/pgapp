<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantInstitutionDetail extends Model
{
    protected $guarded = [];
    // protected $table = 'applicant_institution_details';
    // protected $primaryKey = 'id';

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicants_id', 'id');
    }
}
