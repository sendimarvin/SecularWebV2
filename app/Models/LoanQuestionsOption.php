<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanQuestionsOption extends Model
{
    use HasFactory;

    protected $table = "loan_question_options";

    protected $fillable = ["question_id","option_name"];

    public $timestamps = false;
}
