<?php

namespace App\Http\Controllers;

use App\Models\LoanQuestion;
use App\Models\LoanQuestionCategory;
use App\Models\LoanQuestionsOption;
use Illuminate\Http\Request;

class LoanQuestionsOptionsController extends Controller
{

    function index(){

        return view("pages.loan_questions_options.index",[
            "list"=>LoanQuestionsOption::all()->map(function ($l){

                $l->question = LoanQuestion::find($l->question_id);

                return $l;
            })
        ]);

    }

    function create(){
        return view("pages.loan_questions_options.create",[
            "questions"=>LoanQuestion::where("question_type","=","SINGLE")->get()->map(function ($question){
                $question->category = LoanQuestionCategory::find($question->loan_questions_category_id);
                return $question;
            })
        ]);
    }

    function store(Request $request){

        LoanQuestionsOption::create([
            "question_id"=>$request->input("question_id"),
            "option_name"=>$request->input("option_name"),
        ]);

        return redirect("/question/options");
    }
    function update(Request $request,$id){
        $option = LoanQuestionsOption::find($id);
        $option->question_id = $request->input("question_id");
        $option->option_name = $request->input("option_name");


        $option->save();

        return redirect("/question/options");
    }
    function delete(Request $request,$id){

        $question = LoanQuestionsOption::find($id);
        $question->delete();

        return redirect("/question/options");
    }
    function edit($id){

        $option = LoanQuestionsOption::find($id);

        return view("pages.loan_questions_options.edit",[
            "questions"=>LoanQuestion::where("question_type","=","SINGLE")->get()->map(function ($question){
                $question->category = LoanQuestionCategory::find($question->loan_questions_category_id);
                return $question;
            }),
            "option" => $option
        ]);
    }

    function questionOptions($question_id){

    }

    function saveQuestionOptions($question_id){

    }

    function deleteQuestionOptions($question_id){

    }
    function editQuestionOptions($question_id){

    }


}
