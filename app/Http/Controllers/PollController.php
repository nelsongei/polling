<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PollController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Polls/Index');
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
        // Return a response (optional)
        return response()->json(['message' => 'Poll stored successfully'], 200);
    }
}
