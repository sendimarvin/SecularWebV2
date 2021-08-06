<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KadaamaApplicationReview extends Model
{
    use HasFactory;

    protected $table = "kadaama_application_reviews";

    protected $fillable = ["admin_id","application_id","state","review"];
}
