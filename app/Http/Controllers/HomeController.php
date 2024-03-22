<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\Answers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function questions(Request $req){

        if(!$req->ajax()){
            abort('404');
        }

        $validator = Validator::make($req->all(), [
            'question' => 'required|string|min:2|max:200'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors() 
            ]);
        }

        $user_id = Auth::user()->id;

        $question = Questions::updateOrCreate(
            ['question' => $req->input('question'),
            'user_id' => $user_id],
            ['count' =>Questions::raw("IF(ISNULL(count),1,count+1)")]
        );

        $user_count = Questions::where('user_id', $user_id)->where('question', $req->input('question'))->value('count');
        $others_count = Questions::whereNot('user_id', $user_id)->where('question', $req->input('question'))->sum('count');
        $answer = Answers::inRandomOrder()->value('answer');

        return response()->json(['user_count' => $user_count, 'others_count' => $others_count, 'answer' => $answer]);
    }

}
