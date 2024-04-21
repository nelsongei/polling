<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PollController extends Controller
{
    //
    public function index()
    {
        $polls = Poll::with('questions.options')->get();
        return Inertia::render('Polls/Index',[
            'polls'=>$polls
        ]);
    }
    public function create(){
        return Inertia::render('Polls/Create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'questions' => 'required|array',
            'questions.*.title' => 'required|string',
            'questions.*.options' => 'required|array',
            'questions.*.options.*.option_name' => 'required|string',
        ]);

        // Create a new poll
        $poll = new Poll();
        $poll->user_id = Auth::user()->id;
        $poll->name = $validatedData['title'];
        $poll->start_date = $validatedData['start_date'];
        $poll->end_date = $validatedData['end_date'];
        $poll->save();

        // Save questions and options
        foreach ($validatedData['questions'] as $questionData) {
            $question = $poll->questions()->create([
                'title' => $questionData['title'],
            ]);
            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option' => $optionData['option_name'],
                ]);
            }
        }
        // Return a response
        return response()->json(['message' => 'Poll stored successfully'], 200);
    }
    public function view($id){
        $loggedInUserId = Auth::user()->id;
        $poll = Poll::with('questions.options.vote')->findOrFail($id);
        return Inertia::render('Polls/View',[
            'poll'=>$poll,
            'loggedInUserId'=>$loggedInUserId
        ]);
    }
}
