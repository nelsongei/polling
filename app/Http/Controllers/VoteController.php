<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    //
    public function store(Request $request)
    {
        $votes = Vote::where('question_id',$request->question_id)->where('user_id',Auth::user()->id)->count();
        if ($votes>0)
        {
            Vote::where('question_id',$request->question_id)->where('user_id',Auth::user()->id)->update([
                'votes'=>1,
                'answer_id'=>$request->option_id
            ]);
        }
        else{
            $vote = new Vote();
            $vote->question_id = $request->question_id;
            $vote->user_id = Auth::user()->id;
            $vote->votes = 1;
            $vote->answer_id = $request->option_id;
            $vote->save();
        }
        return response()->json(['message'=>'Voted'],200);
    }
}
