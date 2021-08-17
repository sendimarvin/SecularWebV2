<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplicationDisbursement extends Model
{
    use HasFactory;

    protected $table = "loan_application_disbursement";

    protected $fillable = ["amount","type","application_id"];
}
