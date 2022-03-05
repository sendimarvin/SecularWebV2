<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        "title",
        "amount",
        "payment_method",
        "payment_ref",
        "data",
        "user_id",
        "status"
    ];

    use HasFactory;
}
