<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
      use HasFactory;

    protected $fillable = [
        'ticket_number',
        'issue_type',
        'matric_number',
        'user_name',
        'payment_reference',
        'payment_item',
        'amount_paid',
        'description',
        'status',
    ];

    protected $casts = [
        'amount_paid' => 'decimal:2',
    ];
}
