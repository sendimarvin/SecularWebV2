<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplicationFeePayment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "application_id",
        "amount",
        "payment_method",
        "payment_date",
        "payment_ref",
        "status",
        "payment_id"];

    protected $table = "loan_application_fee_payments";
}
