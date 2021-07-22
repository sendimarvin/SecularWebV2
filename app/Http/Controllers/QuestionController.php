<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QuestionController extends Controller
{

    public function categories () {
        $categories = DB::table('loan_questions_category')->get();
        return view('pages/question_categories', compact('categories'));
    }

    public function create_category () {
        DB::table('loan_questions_category')->insert([
            'category' => request('category')
        ]);
        return redirect()->route('/question/categories');
    }

    public function edit_category($id)
    {
        $category = DB::table('loan_questions_category')->where('id', $id)->first();
        return view('pages/new_question_category', compact('category'));
    }


    public function update_category(Request $request, $id)
    {
        DB::table('loan_questions_category')
            ->where('id', $id)
            ->update([
                'category' => $request->category
                ]);
        
        return redirect()->route('/question/categories');
    }

    public function delete_category($id){
        DB::table('loan_questions_category')->delete($id);
        return redirect()->route('/question/categories');
    }

    public function questions () {
        $questions = DB::table('loan_questions')
            ->select('loan_questions.id', 'loan_questions_category.category AS category', 'loan_questions.question AS question', 'question_type AS type')
            ->join('loan_questions_category', 'loan_questions_category.id', '=', 'loan_questions.loan_questions_category_id')
            ->get();
        return view('pages/questions', compact('questions'));
    }
    
    public function new_question () {
        $categories = DB::table('loan_questions_category')->get();
        $question_types = DB::table('question_types')->get();
        return view('pages/new_question', compact('categories', 'question_types'));
    }

    public function create_question () {
        DB::table('loan_questions')->insert([
            'loan_questions_category_id' => request('category'),
            'question' => request('question'),
            'question_type' => request('question_type')
        ]);
        return redirect()->route('/question/questions');
    }


    public function edit_question($id)
    {
        $categories = DB::table('loan_questions_category')->get();
        $question_types = DB::table('question_types')->get();
        $question = DB::table('loan_questions')->where('id', $id)->first();
        return view('pages/new_question', compact('question', 'categories', 'question_types'));
    }

    public function update_question(Request $request, $id)
    {
        DB::table('loan_questions')
            ->where('id', $id)
            ->update([
                'loan_questions_category_id' => $request->category,
                'question' => $request->question,
                'question_type' => $request->question_type
            ]);
        
        return redirect()->route('/question/questions');
    }

    public function delete_question($id){
        DB::table('loan_questions')->delete($id);
        return redirect()->route('/question/questions');
    }




    public function question_mappings () {
        $mappings = 
        DB::table('loanquestioncategory_loansubpackage')
            ->select('loanquestioncategory_loansubpackage.id', 'loan_questions_category.category AS category', 'loan_sub_packages.sub_loan AS sub_loan')
            ->join('loan_questions_category', 'loan_questions_category.id', '=', 'loanquestioncategory_loansubpackage.loan_questions_category_id')
            ->join('loan_sub_packages', 'loan_sub_packages.id', '=', 'loanquestioncategory_loansubpackage.loan_sub_package_id')
            ->get();
        return view('pages/question_mappings', compact('mappings'));
    }


    public function new_question_mapping () {
        $categories = DB::table('loan_questions_category')->get();
        $sub_packages = DB::table('loan_sub_packages')->get();
        return view('pages/new_question_mapping', compact('categories', 'sub_packages'));
    }

    public function create_question_mapping  () {
        DB::table('loanquestioncategory_loansubpackage')->where([
            'loan_questions_category_id' => request('category'), 
            'loan_sub_package_id' => request('subpackage'), 
            ])->delete();
        DB::table('loanquestioncategory_loansubpackage')->insert([
            'loan_questions_category_id' => request('category'),
            'loan_sub_package_id' => request('subpackage')
        ]);
        return redirect()->route('/question/question_mappings');
    }


    public function delete_question_mapping  ($id) {
        DB::table('loanquestioncategory_loansubpackage')->delete($id);
        return redirect()->route('/question/question_mappings');
    }

    public function edit_question_mapping ($id) {
        $categories = DB::table('loan_questions_category')->get();
        $sub_packages = DB::table('loan_sub_packages')->get();
        $mapping = DB::table('loanquestioncategory_loansubpackage')->where('id', $id)->first();
        return view('pages/new_question_mapping', compact('sub_packages', 'categories', 'mapping'));
    }

    public function update_question_mapping (Request $request, $id)
    {
        DB::table('loanquestioncategory_loansubpackage')
            ->where('id', $id)
            ->update([
                'loan_questions_category_id' => $request->category,
                'loan_sub_package_id' => $request->subpackage
            ]);
        
        return redirect()->route('/question/question_mappings');
    }



}
