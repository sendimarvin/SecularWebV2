<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifetimeBeneficiaries extends Model
{
    protected $table = "lifetime_beneficiaries";

    protected $fillable = ["beneficiary_id","hospital_id","amount","year",];

    use HasFactory;
}
